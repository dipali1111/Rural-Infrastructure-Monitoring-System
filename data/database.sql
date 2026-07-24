-- ============================================================================
-- RURAL INFRASTRUCTURE MONITORING SYSTEM
-- Client: Ahmednagar District Administration
-- Database: MySQL 8.x  |  Charset: utf8mb4  |  Engine: InnoDB
-- Version: 1.0
-- ============================================================================

DROP DATABASE IF EXISTS rural_infra_monitoring;
CREATE DATABASE rural_infra_monitoring
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE rural_infra_monitoring;

SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================================
-- SECTION 1: MASTER / LOOKUP TABLES
-- ============================================================================

-- ---------------------------------------------------------------------------
-- roles : the 5 system roles (Admin, District CEO, Taluka Officer, Engineer,
--         Gram Panchayat User). Drives role-based access control everywhere.
-- ---------------------------------------------------------------------------
CREATE TABLE roles (
    role_id         INT AUTO_INCREMENT PRIMARY KEY,
    role_name       VARCHAR(50)  NOT NULL UNIQUE,
    role_description VARCHAR(255) NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- departments : implementing departments (PWD, Water Supply, Education, ...)
-- ---------------------------------------------------------------------------
CREATE TABLE departments (
    department_id   INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL UNIQUE,
    department_description VARCHAR(255) NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- districts : top of the geographic hierarchy (kept as a table, not a
--             hardcoded value, so the schema survives future multi-district
--             rollout without any structural change)
-- ---------------------------------------------------------------------------
CREATE TABLE districts (
    district_id     INT AUTO_INCREMENT PRIMARY KEY,
    district_name   VARCHAR(100) NOT NULL UNIQUE,
    state_name      VARCHAR(100) NOT NULL DEFAULT 'Maharashtra',
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- talukas : belongs to a district
-- ---------------------------------------------------------------------------
CREATE TABLE talukas (
    taluka_id       INT AUTO_INCREMENT PRIMARY KEY,
    district_id     INT NOT NULL,
    taluka_name     VARCHAR(100) NOT NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_taluka_district FOREIGN KEY (district_id) REFERENCES districts(district_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT uq_taluka UNIQUE (district_id, taluka_name)
) ENGINE=InnoDB;
CREATE INDEX idx_taluka_district ON talukas(district_id);

-- ---------------------------------------------------------------------------
-- gram_panchayats : village-level unit; belongs to a taluka
-- ---------------------------------------------------------------------------
CREATE TABLE gram_panchayats (
    gp_id           INT AUTO_INCREMENT PRIMARY KEY,
    taluka_id       INT NOT NULL,
    gp_name         VARCHAR(150) NOT NULL,
    gp_code         VARCHAR(20) NOT NULL UNIQUE,
    population      INT NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_gp_taluka FOREIGN KEY (taluka_id) REFERENCES talukas(taluka_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT uq_gp UNIQUE (taluka_id, gp_name)
) ENGINE=InnoDB;
CREATE INDEX idx_gp_taluka ON gram_panchayats(taluka_id);

-- ---------------------------------------------------------------------------
-- work_categories : Village Road, School Building, Water Supply, etc.
-- ---------------------------------------------------------------------------
CREATE TABLE work_categories (
    category_id     INT AUTO_INCREMENT PRIMARY KEY,
    category_name   VARCHAR(100) NOT NULL UNIQUE,
    category_description VARCHAR(255) NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- document_types : Sanction Letter, Estimate, Drawing, Completion Cert, ...
-- ---------------------------------------------------------------------------
CREATE TABLE document_types (
    doc_type_id     INT AUTO_INCREMENT PRIMARY KEY,
    type_name       VARCHAR(100) NOT NULL UNIQUE,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- notification_types : Status Change, Verification Update, Fund Allocation..
-- ---------------------------------------------------------------------------
CREATE TABLE notification_types (
    notif_type_id   INT AUTO_INCREMENT PRIMARY KEY,
    type_name       VARCHAR(100) NOT NULL UNIQUE,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------------
-- project_status_master : the fixed workflow states of a project
-- ---------------------------------------------------------------------------
CREATE TABLE project_status_master (
    status_id       INT AUTO_INCREMENT PRIMARY KEY,
    status_name     VARCHAR(50) NOT NULL UNIQUE,
    sequence_order  INT NOT NULL,
    status_description VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================================
-- SECTION 2: USERS & ACCESS CONTROL
-- ============================================================================

-- ---------------------------------------------------------------------------
-- users : every login. Jurisdiction columns are nullable because they mean
--         different things per role (GP user -> gp_id, Taluka Officer ->
--         taluka_id, District CEO -> district_id, Admin -> none required).
--         An engineer's actual working villages are in engineer_assignments.
-- ---------------------------------------------------------------------------
CREATE TABLE users (
    user_id         INT AUTO_INCREMENT PRIMARY KEY,
    role_id         INT NOT NULL,
    district_id     INT NULL,
    taluka_id       INT NULL,
    gp_id           INT NULL,
    department_id   INT NULL,
    full_name       VARCHAR(150) NOT NULL,
    username        VARCHAR(50)  NOT NULL UNIQUE,
    email           VARCHAR(150) NOT NULL UNIQUE,
    phone           VARCHAR(15)  NULL,
    password_hash   VARCHAR(255) NOT NULL,
    profile_photo   VARCHAR(255) NULL,
    preferred_language ENUM('en','mr') NOT NULL DEFAULT 'en',
    status          ENUM('active','inactive','suspended') NOT NULL DEFAULT 'active',
    last_login_at   TIMESTAMP NULL,
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at      TIMESTAMP NULL,
    CONSTRAINT fk_user_role       FOREIGN KEY (role_id) REFERENCES roles(role_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_user_district   FOREIGN KEY (district_id) REFERENCES districts(district_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_user_taluka     FOREIGN KEY (taluka_id) REFERENCES talukas(taluka_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_user_gp         FOREIGN KEY (gp_id) REFERENCES gram_panchayats(gp_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_user_department FOREIGN KEY (department_id) REFERENCES departments(department_id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;
CREATE INDEX idx_user_role ON users(role_id);
CREATE INDEX idx_user_gp ON users(gp_id);
CREATE INDEX idx_user_taluka ON users(taluka_id);
CREATE INDEX idx_user_status ON users(status);

-- ---------------------------------------------------------------------------
-- user_sessions : server-side session tracking for timeout / audit
-- ---------------------------------------------------------------------------
CREATE TABLE user_sessions (
    session_id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    session_token   VARCHAR(255) NOT NULL UNIQUE,
    ip_address      VARCHAR(45) NULL,
    login_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_activity_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    expires_at      TIMESTAMP NOT NULL,
    logout_at       TIMESTAMP NULL,
    CONSTRAINT fk_session_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE INDEX idx_session_user ON user_sessions(user_id);

-- ---------------------------------------------------------------------------
-- engineer_assignments : many-to-many, which engineer covers which GP(s)
-- ---------------------------------------------------------------------------
CREATE TABLE engineer_assignments (
    assignment_id   INT AUTO_INCREMENT PRIMARY KEY,
    engineer_id     INT NOT NULL,
    gp_id           INT NOT NULL,
    assigned_by     INT NOT NULL,
    assigned_date   DATE NOT NULL,
    status          ENUM('active','inactive') NOT NULL DEFAULT 'active',
    remarks         VARCHAR(255) NULL,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ea_engineer FOREIGN KEY (engineer_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_ea_gp       FOREIGN KEY (gp_id) REFERENCES gram_panchayats(gp_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_ea_assigner FOREIGN KEY (assigned_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT uq_engineer_gp UNIQUE (engineer_id, gp_id)
) ENGINE=InnoDB;

-- ============================================================================
-- SECTION 3: PROJECTS / WORKS (the core entity)
-- ============================================================================

CREATE TABLE projects (
    project_id          INT AUTO_INCREMENT PRIMARY KEY,
    project_code        VARCHAR(30) NOT NULL UNIQUE,
    title               VARCHAR(200) NOT NULL,
    description         TEXT NULL,
    work_category_id    INT NOT NULL,
    department_id       INT NULL,
    gp_id               INT NOT NULL,
    taluka_id           INT NOT NULL,
    district_id         INT NOT NULL,
    estimated_cost      DECIMAL(14,2) NOT NULL,
    sanctioned_cost      DECIMAL(14,2) NULL,
    start_date          DATE NULL,
    expected_end_date   DATE NULL,
    actual_end_date     DATE NULL,
    current_status_id   INT NOT NULL DEFAULT 1,
    created_by          INT NOT NULL,
    assigned_engineer_id INT NULL,
    remarks             VARCHAR(500) NULL,
    created_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at          TIMESTAMP NULL,
    CONSTRAINT fk_proj_category FOREIGN KEY (work_category_id) REFERENCES work_categories(category_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_proj_department FOREIGN KEY (department_id) REFERENCES departments(department_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_proj_gp FOREIGN KEY (gp_id) REFERENCES gram_panchayats(gp_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_proj_taluka FOREIGN KEY (taluka_id) REFERENCES talukas(taluka_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_proj_district FOREIGN KEY (district_id) REFERENCES districts(district_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_proj_status FOREIGN KEY (current_status_id) REFERENCES project_status_master(status_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_proj_creator FOREIGN KEY (created_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_proj_engineer FOREIGN KEY (assigned_engineer_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT chk_proj_estimated_cost CHECK (estimated_cost >= 0),
    CONSTRAINT chk_proj_sanctioned_cost CHECK (sanctioned_cost IS NULL OR sanctioned_cost >= 0)
) ENGINE=InnoDB;
CREATE INDEX idx_proj_gp ON projects(gp_id);
CREATE INDEX idx_proj_taluka ON projects(taluka_id);
CREATE INDEX idx_proj_district ON projects(district_id);
CREATE INDEX idx_proj_status ON projects(current_status_id);
CREATE INDEX idx_proj_engineer ON projects(assigned_engineer_id);
CREATE INDEX idx_proj_category ON projects(work_category_id);

-- ---------------------------------------------------------------------------
-- project_status_history : append-only audit trail of every status change
-- ---------------------------------------------------------------------------
CREATE TABLE project_status_history (
    history_id      INT AUTO_INCREMENT PRIMARY KEY,
    project_id      INT NOT NULL,
    status_id       INT NOT NULL,
    changed_by      INT NOT NULL,
    remarks         VARCHAR(500) NULL,
    changed_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_psh_project FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_psh_status  FOREIGN KEY (status_id) REFERENCES project_status_master(status_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_psh_user    FOREIGN KEY (changed_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
CREATE INDEX idx_psh_project ON project_status_history(project_id);

-- ============================================================================
-- SECTION 4: PROGRESS, VERIFICATION, EVIDENCE
-- ============================================================================

CREATE TABLE progress_updates (
    progress_id         INT AUTO_INCREMENT PRIMARY KEY,
    project_id          INT NOT NULL,
    updated_by          INT NOT NULL,
    progress_percentage DECIMAL(5,2) NOT NULL,
    stage_description   VARCHAR(255) NULL,
    remarks             TEXT NULL,
    update_date         DATE NOT NULL,
    verification_status ENUM('pending','verified','rejected') NOT NULL DEFAULT 'pending',
    created_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at          TIMESTAMP NULL,
    CONSTRAINT fk_pu_project FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_pu_user    FOREIGN KEY (updated_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT chk_pu_percentage CHECK (progress_percentage BETWEEN 0 AND 100)
) ENGINE=InnoDB;
CREATE INDEX idx_pu_project ON progress_updates(project_id);

CREATE TABLE verification_reports (
    verification_id     INT AUTO_INCREMENT PRIMARY KEY,
    project_id           INT NOT NULL,
    progress_id          INT NULL,
    engineer_id           INT NOT NULL,
    inspection_date       DATE NOT NULL,
    quantity_verified     VARCHAR(255) NULL,
    quality_rating         ENUM('excellent','good','satisfactory','poor') NULL,
    verification_result   ENUM('approved','rejected','needs_revision') NOT NULL,
    remarks                TEXT NULL,
    created_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at             TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_vr_project  FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_vr_progress FOREIGN KEY (progress_id) REFERENCES progress_updates(progress_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_vr_engineer FOREIGN KEY (engineer_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
CREATE INDEX idx_vr_project ON verification_reports(project_id);

CREATE TABLE documents (
    document_id     INT AUTO_INCREMENT PRIMARY KEY,
    project_id      INT NOT NULL,
    doc_type_id     INT NOT NULL,
    uploaded_by     INT NOT NULL,
    file_name       VARCHAR(255) NOT NULL,
    file_path       VARCHAR(500) NOT NULL,
    file_size_kb    INT NULL,
    remarks         VARCHAR(255) NULL,
    uploaded_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at      TIMESTAMP NULL,
    CONSTRAINT fk_doc_project FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_doc_type    FOREIGN KEY (doc_type_id) REFERENCES document_types(doc_type_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_doc_user    FOREIGN KEY (uploaded_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
CREATE INDEX idx_doc_project ON documents(project_id);

CREATE TABLE photos (
    photo_id        INT AUTO_INCREMENT PRIMARY KEY,
    project_id      INT NOT NULL,
    progress_id     INT NULL,
    uploaded_by     INT NOT NULL,
    file_path       VARCHAR(500) NOT NULL,
    latitude        DECIMAL(10,7) NULL,
    longitude       DECIMAL(10,7) NULL,
    captured_at     TIMESTAMP NULL,
    remarks         VARCHAR(255) NULL,
    uploaded_at     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at      TIMESTAMP NULL,
    CONSTRAINT fk_photo_project  FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_photo_progress FOREIGN KEY (progress_id) REFERENCES progress_updates(progress_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_photo_user     FOREIGN KEY (uploaded_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
CREATE INDEX idx_photo_project ON photos(project_id);

-- ============================================================================
-- SECTION 5: FINANCE
-- ============================================================================

CREATE TABLE fund_allocations (
    allocation_id    INT AUTO_INCREMENT PRIMARY KEY,
    project_id        INT NOT NULL,
    allocated_by      INT NOT NULL,
    financial_year    VARCHAR(9) NOT NULL,
    allocated_amount  DECIMAL(14,2) NOT NULL,
    allocation_date   DATE NOT NULL,
    remarks           VARCHAR(255) NULL,
    created_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_fa_project FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_fa_user    FOREIGN KEY (allocated_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT chk_fa_amount CHECK (allocated_amount >= 0)
) ENGINE=InnoDB;
CREATE INDEX idx_fa_project ON fund_allocations(project_id);

CREATE TABLE financial_utilizations (
    utilization_id    INT AUTO_INCREMENT PRIMARY KEY,
    project_id         INT NOT NULL,
    allocation_id       INT NULL,
    recorded_by         INT NOT NULL,
    amount_utilized      DECIMAL(14,2) NOT NULL,
    utilization_date     DATE NOT NULL,
    expenditure_head      VARCHAR(150) NULL,
    bill_reference         VARCHAR(100) NULL,
    remarks                VARCHAR(255) NULL,
    created_at              TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at              TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at              TIMESTAMP NULL,
    CONSTRAINT fk_fu_project    FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_fu_allocation FOREIGN KEY (allocation_id) REFERENCES fund_allocations(allocation_id) ON UPDATE CASCADE ON DELETE SET NULL,
    CONSTRAINT fk_fu_user       FOREIGN KEY (recorded_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT chk_fu_amount CHECK (amount_utilized >= 0)
) ENGINE=InnoDB;
CREATE INDEX idx_fu_project ON financial_utilizations(project_id);

-- ============================================================================
-- SECTION 6: NOTIFICATIONS, AUDIT, SETTINGS
-- ============================================================================

CREATE TABLE notifications (
    notification_id  INT AUTO_INCREMENT PRIMARY KEY,
    user_id           INT NOT NULL,
    notif_type_id      INT NOT NULL,
    project_id          INT NULL,
    title                VARCHAR(150) NOT NULL,
    message               VARCHAR(500) NOT NULL,
    is_read                TINYINT(1) NOT NULL DEFAULT 0,
    created_at              TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_notif_user    FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_notif_type    FOREIGN KEY (notif_type_id) REFERENCES notification_types(notif_type_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_notif_project FOREIGN KEY (project_id) REFERENCES projects(project_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;
CREATE INDEX idx_notif_user ON notifications(user_id, is_read);

CREATE TABLE audit_logs (
    log_id       INT AUTO_INCREMENT PRIMARY KEY,
    user_id       INT NULL,
    action         VARCHAR(100) NOT NULL,
    module          VARCHAR(100) NOT NULL,
    record_id        INT NULL,
    old_value          TEXT NULL,
    new_value            TEXT NULL,
    ip_address             VARCHAR(45) NULL,
    created_at               TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_audit_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;
CREATE INDEX idx_audit_module ON audit_logs(module, created_at);
CREATE INDEX idx_audit_user ON audit_logs(user_id);

CREATE TABLE system_settings (
    setting_id     INT AUTO_INCREMENT PRIMARY KEY,
    setting_key    VARCHAR(100) NOT NULL UNIQUE,
    setting_value   VARCHAR(500) NULL,
    description       VARCHAR(255) NULL,
    updated_by         INT NULL,
    updated_at           TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_setting_user FOREIGN KEY (updated_by) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================================
-- SECTION 7: MASTER DATA (STEP 6)
-- ============================================================================

INSERT INTO roles (role_name, role_description) VALUES
('Administrator',        'Full system access: user, master data, and settings management'),
('District CEO',         'District-wide supervision, approvals, dashboards and escalations'),
('Taluka Officer',       'Taluka-level monitoring of villages, delays, issues and fund utilization'),
('Engineer',             'Technical inspection and verification of quantity, quality and stage'),
('Gram Panchayat User',  'Creates works and uploads progress, documents and photos');

INSERT INTO departments (department_name, department_description) VALUES
('Public Works Department (PWD)',   'Roads, buildings and general civil works'),
('Rural Water Supply Department',   'Drinking water and supply schemes'),
('Education Department',            'School buildings and educational infrastructure'),
('Rural Development Department',    'General village-level development works');

INSERT INTO districts (district_name, state_name) VALUES
('Ahmednagar', 'Maharashtra');

INSERT INTO talukas (district_id, taluka_name) VALUES
(1,'Nagar'),(1,'Shrirampur'),(1,'Rahata'),(1,'Kopargaon'),(1,'Sangamner'),
(1,'Akole'),(1,'Rahuri'),(1,'Parner'),(1,'Shevgaon'),(1,'Pathardi'),
(1,'Newasa'),(1,'Shrigonda'),(1,'Karjat'),(1,'Jamkhed');

INSERT INTO gram_panchayats (taluka_id, gp_name, gp_code, population) VALUES
(1, 'Bhingar',        'AN-NGR-001', 18500),
(1, 'Wadgaon Gupta',  'AN-NGR-002', 6400),
(5, 'Ghulewadi',      'AN-SGM-001', 9200),
(5, 'Sakur',          'AN-SGM-002', 5100),
(7, 'Songaon',        'AN-RHR-001', 7300);

INSERT INTO work_categories (category_name, category_description) VALUES
('Village Road',            'Construction and repair of village internal/approach roads'),
('School Building',         'Construction, repair and upgrade of school infrastructure'),
('Water Supply',            'Drinking water supply schemes and distribution works'),
('Drainage',                'Storm water drains and sanitation works'),
('Public Facility',         'Community halls, public toilets and other public utilities'),
('Repair & Maintenance',    'Repair of existing rural infrastructure assets'),
('Other',                   'Works not covered under the above categories');

INSERT INTO document_types (type_name) VALUES
('Sanction Letter'),('Estimate'),('Technical Drawing'),
('Completion Certificate'),('Inspection Report'),('Other');

INSERT INTO notification_types (type_name) VALUES
('Status Change'),('Verification Update'),('Fund Allocation'),
('Deadline Alert'),('System Alert');

INSERT INTO project_status_master (status_name, sequence_order, status_description) VALUES
('Draft',                 1, 'Work created but not yet submitted'),
('Submitted',             2, 'Submitted by Gram Panchayat user for review'),
('Assigned',              3, 'Engineer assigned for technical inspection'),
('In Progress',           4, 'Execution underway, progress being recorded'),
('Verification Pending',  5, 'Progress submitted, awaiting engineer verification'),
('Verified',              6, 'Verified by engineer, pending administrative closure'),
('Completed',             7, 'Work completed and closed'),
('On Hold',                8, 'Temporarily paused'),
('Rejected',                9, 'Rejected/returned for correction');

-- ============================================================================
-- SECTION 8: SAMPLE DATA (STEP 7)
-- ============================================================================

-- Passwords below are placeholder bcrypt hashes for the literal string
-- "Password@123" -- regenerate real hashes with PHP password_hash() before
-- using this file outside local development.
INSERT INTO users (role_id, district_id, taluka_id, gp_id, department_id, full_name, username, email, phone, password_hash) VALUES
(1, NULL, NULL, NULL, NULL, 'System Administrator',  'admin',        'admin@ahmednagar.gov.in',      '9000000001', '$2y$10$examplehashexamplehashexamplehashexampleh'),
(2, 1,    NULL, NULL, NULL, 'Dr. Sanjay Kadam',       'ceo_ahmednagar','ceo@ahmednagar.gov.in',       '9000000002', '$2y$10$examplehashexamplehashexamplehashexampleh'),
(3, 1,    1,    NULL, NULL, 'Ravindra Pawar',         'to_nagar',     'to.nagar@ahmednagar.gov.in',   '9000000003', '$2y$10$examplehashexamplehashexamplehashexampleh'),
(4, 1,    1,    NULL, 1,    'Er. Vaibhav Shinde',      'eng_shinde',   'eng.shinde@ahmednagar.gov.in', '9000000004', '$2y$10$examplehashexamplehashexamplehashexampleh'),
(5, 1,    1,    1,    NULL, 'Sunita More (Bhingar GP)','gp_bhingar',   'gp.bhingar@ahmednagar.gov.in', '9000000005', '$2y$10$examplehashexamplehashexamplehashexampleh');

INSERT INTO engineer_assignments (engineer_id, gp_id, assigned_by, assigned_date) VALUES
(4, 1, 3, '2026-01-05'),
(4, 2, 3, '2026-01-05');

INSERT INTO projects (project_code, title, description, work_category_id, department_id, gp_id, taluka_id, district_id, estimated_cost, sanctioned_cost, start_date, expected_end_date, current_status_id, created_by, assigned_engineer_id, remarks) VALUES
('AHM-2026-0001', 'Internal Road - Bhingar Ward 3', 'Concrete road connecting Ward 3 to main highway', 1, 1, 1, 1, 1, 1250000.00, 1200000.00, '2026-02-01', '2026-06-30', 4, 5, 4, 'Approved in gram sabha resolution'),
('AHM-2026-0002', 'Zilla Parishad School Repair - Wadgaon Gupta', 'Roof and classroom repair for primary school', 2, 3, 2, 1, 1, 480000.00, 450000.00, '2026-03-01', '2026-05-15', 3, 5, 4, NULL);

INSERT INTO project_status_history (project_id, status_id, changed_by, remarks) VALUES
(1, 1, 5, 'Work created'),
(1, 2, 5, 'Submitted for review'),
(1, 3, 3, 'Engineer assigned'),
(1, 4, 4, 'Execution started'),
(2, 1, 5, 'Work created'),
(2, 2, 5, 'Submitted for review'),
(2, 3, 3, 'Engineer assigned');

INSERT INTO progress_updates (project_id, updated_by, progress_percentage, stage_description, remarks, update_date, verification_status) VALUES
(1, 5, 35.00, 'Sub-base and levelling completed', 'Work progressing as per schedule', '2026-03-10', 'verified'),
(1, 5, 60.00, 'Concrete laying in progress', NULL, '2026-04-05', 'pending');

INSERT INTO verification_reports (project_id, progress_id, engineer_id, inspection_date, quantity_verified, quality_rating, verification_result, remarks) VALUES
(1, 1, 4, '2026-03-12', '210 meters sub-base verified', 'good', 'approved', 'Matches submitted estimate');

INSERT INTO documents (project_id, doc_type_id, uploaded_by, file_name, file_path, file_size_kb) VALUES
(1, 1, 5, 'sanction_letter_ahm_2026_0001.pdf', '/uploads/documents/AHM-2026-0001/sanction_letter.pdf', 512),
(1, 2, 5, 'estimate_ahm_2026_0001.pdf',        '/uploads/documents/AHM-2026-0001/estimate.pdf', 340);

INSERT INTO photos (project_id, progress_id, uploaded_by, file_path, latitude, longitude, captured_at) VALUES
(1, 1, 5, '/uploads/photos/AHM-2026-0001/progress1_1.jpg', 19.0948, 74.7480, '2026-03-10 10:15:00');

INSERT INTO fund_allocations (project_id, allocated_by, financial_year, allocated_amount, allocation_date, remarks) VALUES
(1, 3, '2025-2026', 1200000.00, '2026-01-20', 'First installment released');

INSERT INTO financial_utilizations (project_id, allocation_id, recorded_by, amount_utilized, utilization_date, expenditure_head, bill_reference) VALUES
(1, 1, 4, 420000.00, '2026-03-15', 'Material and labour', 'BILL/2026/0451');

INSERT INTO notifications (user_id, notif_type_id, project_id, title, message) VALUES
(4, 2, 1, 'Progress Update Awaiting Verification', 'A new progress update on AHM-2026-0001 needs your review.'),
(5, 3, 1, 'Fund Allocated', 'Rs. 12,00,000 allocated to your project AHM-2026-0001.');

INSERT INTO system_settings (setting_key, setting_value, description, updated_by) VALUES
('session_timeout_minutes', '30', 'Idle session timeout in minutes', 1),
('default_language', 'en', 'Default portal language', 1),
('portal_name', 'Rural Infrastructure Monitoring System - Ahmednagar', 'Displayed portal title', 1);
