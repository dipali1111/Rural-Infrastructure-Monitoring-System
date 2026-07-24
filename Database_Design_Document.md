# Rural Infrastructure Monitoring System — Database Design Document
**Client:** Ahmednagar District Administration &nbsp;|&nbsp; **Stack:** PHP 8.x + MySQL 8.x (XAMPP) &nbsp;|&nbsp; **Version:** 1.0

---

## 1. SRS Analysis

The SRS defines a role-based portal that takes rural works (roads, schools, water
supply, drainage, public facilities, repairs) through a full lifecycle: **creation →
assignment → execution/progress → technical verification → financial tracking →
completion**, with evidence (photos, documents), notifications, reports, and an
audit trail — visible differently to five roles (Administrator, District CEO,
Taluka Officer, Engineer, Gram Panchayat User).

Two things drive the schema more than anything else:
1. **The geographic hierarchy** (District → Taluka → Gram Panchayat) is the backbone
   of both access control and reporting — every dashboard filters by it.
2. **The project lifecycle is stateful** — status isn't just a column, it needs
   history for the audit-trail requirement, so status changes get their own table.

No modules were invented beyond the SRS. Static content (Landing Page, Header,
Footer, language toggle) needs no tables — it's presentation only.

## 2. Modules → Data Requirement

| Module (from SRS) | Needs new tables? |
|---|---|
| Landing Page, Header, Footer | No — static/presentation |
| Role-Based Login / Authentication | `users`, `roles`, `user_sessions` |
| Dashboards (all 5 roles) | Read-only queries over existing tables, scoped by jurisdiction |
| Work / Project Master, New Work Registration | `projects`, `work_categories` |
| Project Assignment | `engineer_assignments`, `projects.assigned_engineer_id` |
| Project Progress / Status | `progress_updates`, `project_status_master`, `project_status_history` |
| Technical Inspection / Verification & Approval | `verification_reports` |
| Financial Utilization / Fund Allocation | `fund_allocations`, `financial_utilizations` |
| Photo & Document Upload | `photos`, `documents`, `document_types` |
| Alerts and Notifications | `notifications`, `notification_types` |
| Reports and Analytics | No new tables — aggregation views/queries over the above |
| User Management / Master Data Management | `users`, `roles`, `departments`, `districts`, `talukas`, `gram_panchayats` |
| Profile Settings | `users` |
| Audit Logs | `audit_logs` |
| System Settings | `system_settings` |

## 3. Entity Identification

**Geography:** `districts`, `talukas`, `gram_panchayats`
**People & access:** `roles`, `users`, `user_sessions`, `engineer_assignments`
**Master/lookup:** `departments`, `work_categories`, `document_types`, `notification_types`, `project_status_master`
**Core transaction:** `projects`, `project_status_history`
**Execution evidence:** `progress_updates`, `verification_reports`, `photos`, `documents`
**Finance:** `fund_allocations`, `financial_utilizations`
**System:** `notifications`, `audit_logs`, `system_settings`

23 tables in total — every one traces back to a specific SRS module; nothing was
added speculatively.

## 4. Database Architecture & Normalization Strategy

- **3NF throughout.** Geography, status, categories, document types and
  notification types are all lookup tables — nothing is stored as a free-text
  duplicate of a value that belongs in a master table.
- **Junction table for the only true many-to-many**: an engineer can cover
  several Gram Panchayats and a GP can (over time) have more than one engineer,
  so `engineer_assignments` breaks that relationship out rather than repeating
  engineer names inside `gram_panchayats`.
- **History kept separate from state.** `projects.current_status_id` gives the
  fast "what's the status now" answer every dashboard needs; `project_status_history`
  gives the append-only audit trail the SRS explicitly requires, without forcing
  every status query to scan a log table.
- **Soft deletes** (`deleted_at`) on records with real-world consequences if
  hard-deleted (users, projects, progress, documents, photos, financial
  utilization) — government records shouldn't disappear on a delete click.
- **Every table** carries `created_at` / `updated_at` (and `deleted_at` where
  relevant); transactional tables also carry `remarks` for free-text context.
- **Referential integrity**: `RESTRICT` on foreign keys that would silently
  orphan financial or verification records if a parent were removed; `CASCADE`
  only where the child record is meaningless without the parent (e.g. a
  project's own status history); `SET NULL` where the relationship is
  informational, not load-bearing (e.g. an unassigned engineer).

### Primary Relationships
- `districts (1) → (M) talukas → (M) gram_panchayats` — geographic hierarchy
- `roles (1) → (M) users`; `users (1) → (M) projects` (as creator), `users (1) → (M) projects` (as assigned engineer)
- `projects (1) → (M) progress_updates → (0..1) verification_reports`
- `projects (1) → (M) documents / photos / fund_allocations / financial_utilizations / notifications / project_status_history`
- `users (M) ↔ (M) gram_panchayats` via `engineer_assignments`

## 5. ER Diagram (text form)

```
 districts ──1:M── talukas ──1:M── gram_panchayats
     │                                    │ 1
     │ 1                                  │ M
     M                                    M
   users ───────────────────────── engineer_assignments
     │ 1  (creator / engineer)            │ M
     │                                    │
     M                                    1
  projects ──M:1── work_categories        │
     │  │  │                              engineers (users, role=Engineer)
     │  │  └──M:1── departments
     │  └─────M:1── project_status_master
     │
     ├──1:M── project_status_history ──M:1── users
     ├──1:M── progress_updates ──1:0..1── verification_reports ──M:1── users(engineer)
     ├──1:M── documents ──M:1── document_types
     ├──1:M── photos
     ├──1:M── fund_allocations ──1:M── financial_utilizations
     └──1:M── notifications ──M:1── notification_types

 users ──1:M── user_sessions
 users ──1:M── audit_logs
 users ──1:M── system_settings (updated_by)
```

## 6. Table Design, Complete SQL, Master Data & Sample Data

All DDL (tables, PKs, FKs, indexes, `CHECK` constraints, `ENUM`s) plus the
`INSERT` statements for master data (roles, departments, talukas, work
categories, document types, notification types, project status) and realistic
sample data (users, a project, progress, verification, documents, photos,
funds, notifications) are in **`database.sql`** — a single file the whole team
imports into phpMyAdmin to get an identical local database.

## 7. Page → Database Mapping

| Page | Tables Used | Operations | Key Relationships |
|---|---|---|---|
| Landing Page | — (static) | — | — |
| Login | `users`, `roles`, `user_sessions` | SELECT, INSERT (session) | users.role_id → roles |
| dashboard.php (role-aware) | `projects`, `project_status_master`, `fund_allocations`, `financial_utilizations`, `notifications` | SELECT | scoped by users.gp_id / taluka_id / district_id |
| new_work.php | `projects`, `work_categories`, `gram_panchayats`, `project_status_history` | INSERT | projects.gp_id, work_category_id |
| my_works.php | `projects`, `project_status_master`, `work_categories` | SELECT | projects.current_status_id |
| progress_update.php | `progress_updates`, `projects` | INSERT, SELECT | progress_updates.project_id |
| upload_photos.php | `photos`, `progress_updates` | INSERT, SELECT | photos.project_id, progress_id |
| upload_documents.php | `documents`, `document_types` | INSERT, SELECT | documents.project_id, doc_type_id |
| financial_details.php | `fund_allocations`, `financial_utilizations` | SELECT, INSERT | both link to projects.project_id |
| Engineer Dashboard / Verification | `projects`, `progress_updates`, `verification_reports`, `engineer_assignments` | SELECT, INSERT, UPDATE | verification_reports.progress_id, engineer_id |
| Taluka Officer Dashboard | `projects`, `progress_updates`, `fund_allocations` (filtered by taluka_id) | SELECT | projects.taluka_id |
| District CEO Dashboard | `projects`, all finance & verification tables (district-wide) | SELECT | projects.district_id |
| Administrator — User Management | `users`, `roles`, `districts`, `talukas`, `gram_panchayats` | SELECT, INSERT, UPDATE | users.role_id, jurisdiction FKs |
| Administrator — Master Data | `work_categories`, `document_types`, `notification_types`, `project_status_master`, `departments` | SELECT, INSERT, UPDATE | — |
| notifications.php | `notifications`, `notification_types` | SELECT, UPDATE (is_read) | notifications.user_id |
| profile.php | `users` | SELECT, UPDATE | — |
| Reports & Analytics | aggregate SELECTs across `projects`, `financial_utilizations`, `verification_reports` | SELECT | — |
| Audit Logs (admin) | `audit_logs` | SELECT | audit_logs.user_id |
| System Settings | `system_settings` | SELECT, UPDATE | — |

## 8. Recommended Folder Structure

```
rural-infra-monitoring/
├── config/
│   └── db.php
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── sidebar.php
│   └── auth_check.php
├── models/              # one file per entity, prepared-statement queries only
│   ├── User.php
│   ├── Project.php
│   ├── ProgressUpdate.php
│   ├── VerificationReport.php
│   └── ...
├── controllers/         # form handling / business logic per module
│   ├── ProjectController.php
│   ├── ProgressController.php
│   └── ...
├── pages/                # dashboard.php, new_work.php, my_works.php,
│                          # progress_update.php, upload_photos.php,
│                          # upload_documents.php, financial_details.php,
│                          # notifications.php, profile.php
├── database/
│   └── database.sql
├── uploads/
│   ├── documents/<project_code>/
│   └── photos/<project_code>/
└── assets/
    ├── css/
    ├── js/
    └── img/
```

## 9. Team Development Notes

- Commit `database/database.sql` on `feature/database`, merge into `dev`. Because
  the schema is one file imported wholesale, there's nothing to merge-conflict on
  the schema side — conflicts would only occur if two people edit `database.sql`
  itself in the same PR, so treat schema changes as sequential (one person adds a
  migration-style `ALTER` block at a time, not silent edits to existing `CREATE
  TABLE` statements once merged to `dev`).
- Once `dev` has been imported by the team, further changes should ship as
  additive `ALTER TABLE` scripts (e.g. `database/migrations/002_add_x.sql`)
  rather than edits to the original file, so everyone's local database can be
  brought up to date the same way.
- Sample data in `database.sql` uses placeholder password hashes — regenerate
  real ones with PHP's `password_hash()` before using any account.

## 10. Recommendations

- Wrap every project-status change through one function/stored procedure that
  writes to `projects.current_status_id` **and** inserts into
  `project_status_history` in the same transaction, so the two never drift apart.
- Enforce jurisdiction filtering (gp_id / taluka_id / district_id) at the query
  layer for every role below Administrator — the schema supports it, but the
  PHP controllers are what actually enforce it.
- Index usage above already covers the filters every dashboard needs
  (status, gp, taluka, district, engineer); revisit with `EXPLAIN` once real
  data volume is known rather than pre-optimizing further.
- Keep file uploads (`documents`, `photos`) storing a *path*, not the binary —
  matches the folder structure above and keeps the database import fast.
