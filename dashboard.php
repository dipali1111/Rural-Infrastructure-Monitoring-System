<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
require 'includes/db.php';

$total_users = $conn->query('SELECT COUNT(*) as c FROM users')->fetch_assoc()['c'];
$admin_name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Ahmednagar Connect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<style>

:root{
  --ink:#0F2A2C;
  --teal-deep:#133336;
  --teal-mid:#285F6B;
  --teal-bright:#367D8A;
  --teal-pale:#DCEAEC;
  --bg:#F4F7F8;
  --paper:#FFFFFF;
  --amber:#C97A2E;
  --amber-soft:#FBEEDF;
  --green:#3E8259;
  --green-soft:#E5F2E9;
  --red:#B14C4C;
  --red-soft:#F7E7E7;
  --line:#E4EAEA;
  --muted:#5C7477;
}

*{margin:0;padding:0;box-sizing:border-box;}

body{
  font-family:'Poppins',sans-serif;
  background:var(--bg);
  color:var(--ink);
  font-size:14.5px;
}

.mono{font-family:'JetBrains Mono',monospace;}

.shell{display:flex;min-height:100vh;}

.sidebar{
  width:250px;
  background:var(--teal-deep);
  color:#EAF3F3;
  position:fixed;
  left:0;top:0;height:100%;
  display:flex;
  flex-direction:column;
  padding:28px 18px;
}

.brand{
  display:flex;
  align-items:center;
  gap:12px;
  padding:0 8px 26px 8px;
  border-bottom:1px solid rgba(255,255,255,.1);
  margin-bottom:22px;
}

.brand-mark{
  width:38px;height:38px;
  border-radius:9px;
  background:linear-gradient(155deg,var(--teal-bright),var(--teal-mid));
  display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:15px;
  flex-shrink:0;
  color:#fff;
}

.brand-text h1{font-size:15px;font-weight:700;letter-spacing:.2px;}
.brand-text p{font-size:11px;color:#8FB3B8;margin-top:1px;}

.nav-group-label{
  font-size:10.5px;
  text-transform:uppercase;
  letter-spacing:1.2px;
  color:#6C9297;
  padding:14px 12px 8px;
}

.nav{list-style:none;}

.nav li a{
  display:flex;
  align-items:center;
  gap:12px;
  padding:10px 12px;
  border-radius:9px;
  color:#C3DADC;
  text-decoration:none;
  font-size:13.5px;
  font-weight:500;
  margin-bottom:2px;
  transition:.15s;
  position:relative;
}

.nav li a:hover{background:rgba(255,255,255,.06);color:#fff;}

.nav li.active a{
  background:var(--teal-mid);
  color:#fff;
}

.nav li a i{width:18px;text-align:center;font-size:14px;}

.nav-badge{
  margin-left:auto;
  background:var(--amber);
  color:#fff;
  font-size:10.5px;
  font-weight:700;
  padding:1px 7px;
  border-radius:20px;
}

.sidebar-foot{
  margin-top:auto;
  padding-top:16px;
  border-top:1px solid rgba(255,255,255,.1);
}

.admin-chip{
  display:flex;
  align-items:center;
  gap:10px;
  padding:8px;
  border-radius:10px;
}

.admin-chip .avatar{
  width:34px;height:34px;
  border-radius:9px;
  background:var(--teal-bright);
  display:flex;align-items:center;justify-content:center;
  font-weight:700;font-size:13px;color:#fff;
  flex-shrink:0;
}

.admin-chip .who{line-height:1.25;}
.admin-chip .who strong{font-size:12.5px;display:block;color:#fff;}
.admin-chip .who span{font-size:11px;color:#8FB3B8;}

.main{margin-left:250px;flex:1;padding-bottom:60px;}

.topbar{
  background:var(--paper);
  padding:18px 36px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  border-bottom:1px solid var(--line);
  position:sticky;top:0;z-index:50;
}

.topbar-title h2{font-size:19px;font-weight:700;}
.topbar-title p{font-size:12.5px;color:var(--muted);margin-top:2px;}

.topbar-right{display:flex;align-items:center;gap:18px;}

.search-box{
  display:flex;align-items:center;gap:9px;
  background:var(--bg);
  border:1px solid var(--line);
  padding:9px 14px;
  border-radius:9px;
  width:230px;
}
.search-box input{border:none;background:none;outline:none;font-size:13px;width:100%;font-family:'Poppins';}
.search-box i{color:var(--muted);font-size:13px;}

.icon-btn{
  width:38px;height:38px;
  border-radius:9px;
  background:var(--bg);
  border:1px solid var(--line);
  display:flex;align-items:center;justify-content:center;
  color:var(--teal-mid);
  cursor:pointer;
  position:relative;
}
.icon-btn .dot{
  position:absolute;top:7px;right:8px;
  width:6px;height:6px;border-radius:50%;
  background:var(--red);
}

.content{padding:28px 36px;}

.band{
  display:grid;
  grid-template-columns:1.6fr 1fr;
  gap:20px;
  margin-bottom:24px;
}

.greeting{
  background:linear-gradient(135deg,var(--teal-mid),var(--teal-deep));
  color:#fff;
  border-radius:16px;
  padding:26px 30px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  position:relative;
  overflow:hidden;
}

.greeting::after{
  content:"";
  position:absolute;
  right:-40px;top:-60px;
  width:200px;height:200px;
  border-radius:50%;
  background:rgba(255,255,255,.05);
}

.greeting .eyebrow{
  font-size:11.5px;
  letter-spacing:1px;
  text-transform:uppercase;
  color:#A9D2D6;
  margin-bottom:8px;
}

.greeting h2{font-size:22px;font-weight:700;margin-bottom:6px;}
.greeting p{font-size:13px;color:#D3E6E8;max-width:440px;line-height:1.55;}

.district-meter{
  background:var(--paper);
  border:1px solid var(--line);
  border-radius:16px;
  padding:20px 24px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}

.district-meter .label{font-size:12px;color:var(--muted);font-weight:500;margin-bottom:10px;}
.district-meter .value-row{display:flex;align-items:baseline;gap:8px;margin-bottom:12px;}
.district-meter .value-row .big{font-size:32px;font-weight:800;color:var(--teal-deep);}
.district-meter .value-row .of{font-size:13px;color:var(--muted);}

.meter-track{
  height:9px;
  background:var(--teal-pale);
  border-radius:20px;
  overflow:hidden;
}
.meter-fill{
  height:100%;
  background:linear-gradient(90deg,var(--teal-bright),var(--green));
  border-radius:20px;
}

.meter-legend{display:flex;justify-content:space-between;margin-top:8px;font-size:11.5px;color:var(--muted);}

.stats{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:18px;
  margin-bottom:24px;
}

.stat-card{
  background:var(--paper);
  border:1px solid var(--line);
  border-radius:14px;
  padding:20px 22px;
  transition:.2s;
}
.stat-card:hover{border-color:var(--teal-bright);transform:translateY(-2px);}

.stat-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;}

.stat-icon{
  width:38px;height:38px;
  border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-size:15px;
}
.stat-icon.teal{background:var(--teal-pale);color:var(--teal-mid);}
.stat-icon.amber{background:var(--amber-soft);color:var(--amber);}
.stat-icon.green{background:var(--green-soft);color:var(--green);}
.stat-icon.red{background:var(--red-soft);color:var(--red);}

.stat-trend{font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;}
.stat-trend.up{background:var(--green-soft);color:var(--green);}
.stat-trend.flag{background:var(--red-soft);color:var(--red);}

.stat-card h1{font-size:28px;font-weight:800;color:var(--teal-deep);margin-bottom:4px;}
.stat-card h3{font-size:12.5px;color:var(--muted);font-weight:500;}

.grid-2{
  display:grid;
  grid-template-columns:1.4fr 1fr;
  gap:18px;
  margin-bottom:18px;
}

.panel{
  background:var(--paper);
  border:1px solid var(--line);
  border-radius:14px;
  padding:24px;
}

.panel-head{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:20px;
}
.panel-head h2{font-size:15.5px;font-weight:700;}
.panel-head p{font-size:11.5px;color:var(--muted);margin-top:2px;}
.panel-link{font-size:12px;color:var(--teal-mid);font-weight:600;text-decoration:none;}

.cat-row{margin-bottom:16px;}
.cat-row:last-child{margin-bottom:0;}
.cat-label{
  display:flex;justify-content:space-between;
  font-size:12.5px;margin-bottom:6px;
}
.cat-label .name{display:flex;align-items:center;gap:8px;font-weight:500;}
.cat-label .name i{width:16px;color:var(--teal-bright);font-size:12px;}
.cat-label .count{color:var(--muted);}
.cat-track{height:8px;background:var(--bg);border-radius:20px;overflow:hidden;display:flex;}
.cat-seg{height:100%;}
.cat-seg.done{background:var(--green);}
.cat-seg.progress{background:var(--teal-bright);}
.cat-seg.delayed{background:var(--red);}

.cat-key{display:flex;gap:16px;margin-top:18px;padding-top:16px;border-top:1px solid var(--line);}
.cat-key span{font-size:11px;color:var(--muted);display:flex;align-items:center;gap:6px;}
.cat-key i{width:7px;height:7px;border-radius:50%;display:inline-block;}
.cat-key .done i{background:var(--green);}
.cat-key .progress i{background:var(--teal-bright);}
.cat-key .delayed i{background:var(--red);}

.queue-item{
  display:flex;
  align-items:center;
  gap:12px;
  padding:12px 0;
  border-bottom:1px solid var(--line);
}
.queue-item:last-child{border-bottom:none;padding-bottom:0;}

.queue-icon{
  width:36px;height:36px;
  border-radius:9px;
  background:var(--amber-soft);
  color:var(--amber);
  display:flex;align-items:center;justify-content:center;
  font-size:13px;
  flex-shrink:0;
}

.queue-info{flex:1;min-width:0;}
.queue-info .t{font-size:13px;font-weight:600;color:var(--ink);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.queue-info .s{font-size:11.5px;color:var(--muted);}

.queue-time{font-size:11px;color:var(--muted);flex-shrink:0;}

.grid-3{
  display:grid;
  grid-template-columns:1.4fr 1fr;
  gap:18px;
}

.activity-item{
  display:flex;
  gap:14px;
  padding:14px 0;
  border-bottom:1px solid var(--line);
}
.activity-item:last-child{border-bottom:none;}

.activity-dot{
  width:8px;height:8px;
  border-radius:50%;
  background:var(--teal-bright);
  margin-top:6px;
  flex-shrink:0;
}

.activity-text .t{font-size:13px;color:var(--ink);}
.activity-text .t b{font-weight:600;}
.activity-text .time{font-size:11px;color:var(--muted);margin-top:2px;}

.alert-item{
  display:flex;gap:12px;
  padding:13px;
  border-radius:10px;
  margin-bottom:10px;
  border:1px solid var(--line);
}
.alert-item:last-child{margin-bottom:0;}
.alert-item.critical{background:var(--red-soft);border-color:#EAC9C9;}
.alert-item.warn{background:var(--amber-soft);border-color:#EFD7B5;}

.alert-item i{font-size:14px;margin-top:2px;}
.alert-item.critical i{color:var(--red);}
.alert-item.warn i{color:var(--amber);}

.alert-item .t{font-size:12.5px;font-weight:600;}
.alert-item .s{font-size:11.5px;color:var(--muted);margin-top:2px;}

@media(max-width:1200px){
  .stats{grid-template-columns:repeat(2,1fr);}
  .grid-2,.grid-3,.band{grid-template-columns:1fr;}
}

@media(max-width:768px){
  .sidebar{width:76px;padding:22px 12px;}
  .brand-text,.nav-group-label,.nav li a span,.admin-chip .who{display:none;}
  .nav li a{justify-content:center;}
  .main{margin-left:76px;}
  .topbar{padding:16px 20px;}
  .search-box{display:none;}
  .content{padding:20px;}
  .stats{grid-template-columns:1fr;}
}

</style>
</head>
<body>

<div class="shell">

  <aside class="sidebar">
    <div class="brand">
      <div class="brand-mark">RC</div>
      <div class="brand-text">
        <h1>Ahmednagar Connect</h1>
        <p>Rural Infra. Monitoring</p>
      </div>
    </div>

    <div class="nav-group-label">Overview</div>
    <ul class="nav">
      <li class="active"><a href="#"><i class="fa-solid fa-grid-2"></i><span>Dashboard</span></a></li>
    </ul>

    <div class="nav-group-label">Operations</div>
    <ul class="nav">
      <li><a href="#"><i class="fa-solid fa-diagram-project"></i><span>Project Master</span></a></li>
      <li><a href="#"><i class="fa-solid fa-clipboard-check"></i><span>Verification Queue</span><span class="nav-badge">15</span></a></li>
      <li><a href="#"><i class="fa-solid fa-indian-rupee-sign"></i><span>Financial Utilization</span></a></li>
      <li><a href="#"><i class="fa-solid fa-triangle-exclamation"></i><span>Alerts</span></a></li>
    </ul>

    <div class="nav-group-label">Administration</div>
    <ul class="nav">
      <li><a href="#"><i class="fa-solid fa-users-gear"></i><span>User Management</span></a></li>
      <li><a href="#"><i class="fa-solid fa-chart-line"></i><span>Reports &amp; Analytics</span></a></li>
      <li><a href="#"><i class="fa-solid fa-sliders"></i><span>Settings</span></a></li>
    </ul>

    <div class="sidebar-foot">
      <ul class="nav">
        <li><a href="#"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a></li>
      </ul>
      <div class="admin-chip">
        <div class="avatar"><?= strtoupper(substr($admin_name,0,2)) ?></div>
        <div class="who">
          <strong><?= htmlspecialchars($admin_name) ?></strong>
          <span>System Administrator</span>
        </div>
      </div>
    </div>
  </aside>

  <div class="main">

    <div class="topbar">
      <div class="topbar-title">
        <h2>District Overview</h2>
        <p>Ahmednagar &nbsp;·&nbsp; <?= date("l, d F Y") ?></p>
      </div>
      <div class="topbar-right">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Search project, village, ID…">
        </div>
        <div class="icon-btn"><i class="fa-regular fa-bell"></i><span class="dot"></span></div>
        <div class="icon-btn"><i class="fa-solid fa-globe"></i></div>
      </div>
    </div>

    <div class="content">

      <div class="band">
        <div class="greeting">
          <div class="eyebrow">Admin Console</div>
          <h2>Welcome back, Admin 👋</h2>
          <p>15 verifications are awaiting your approval and 3 projects have crossed their review deadline. District-wide fund utilization stands at 68% for FY 2025–26.</p>
        </div>
        <div class="district-meter">
          <div class="label">Fund Utilization — FY 2025–26</div>
          <div class="value-row">
            <span class="big">₹18.4 Cr</span>
            <span class="of">of ₹27.1 Cr sanctioned</span>
          </div>
          <div class="meter-track"><div class="meter-fill" style="width:68%"></div></div>
          <div class="meter-legend"><span>68% utilized</span><span>32% remaining</span></div>
        </div>
      </div>

      <div class="stats">
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon teal"><i class="fa-solid fa-map-location-dot"></i></div>
            <span class="stat-trend up">+4 new</span>
          </div>
          <h1>248</h1>
          <h3>Villages Covered</h3>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon green"><i class="fa-solid fa-diagram-project"></i></div>
            <span class="stat-trend up">62 active</span>
          </div>
          <h1>87</h1>
          <h3>Total Projects</h3>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon amber"><i class="fa-solid fa-clipboard-check"></i></div>
            <span class="stat-trend flag">3 overdue</span>
          </div>
          <h1>15</h1>
          <h3>Pending Approvals</h3>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <span class="stat-trend flag">2 critical</span>
          </div>
          <h1>6</h1>
          <h3>Registered Users</h3>
        </div>
      </div>

      <div class="grid-2">
        <div class="panel">
          <div class="panel-head">
            <div>
              <h2>Projects by Category</h2>
              <p>Status split across active work types</p>
            </div>
            <a class="panel-link" href="#">View all →</a>
          </div>

          <div class="cat-row">
            <div class="cat-label">
              <span class="name"><i class="fa-solid fa-road"></i>Village Roads</span>
              <span class="count">24 works</span>
            </div>
            <div class="cat-track">
              <div class="cat-seg done" style="width:50%"></div>
              <div class="cat-seg progress" style="width:38%"></div>
              <div class="cat-seg delayed" style="width:12%"></div>
            </div>
          </div>

          <div class="cat-row">
            <div class="cat-label">
              <span class="name"><i class="fa-solid fa-droplet"></i>Water Supply</span>
              <span class="count">19 works</span>
            </div>
            <div class="cat-track">
              <div class="cat-seg done" style="width:63%"></div>
              <div class="cat-seg progress" style="width:31%"></div>
              <div class="cat-seg delayed" style="width:6%"></div>
            </div>
          </div>

          <div class="cat-row">
            <div class="cat-label">
              <span class="name"><i class="fa-solid fa-school"></i>School Buildings</span>
              <span class="count">14 works</span>
            </div>
            <div class="cat-track">
              <div class="cat-seg done" style="width:71%"></div>
              <div class="cat-seg progress" style="width:29%"></div>
            </div>
          </div>

          <div class="cat-row">
            <div class="cat-label">
              <span class="name"><i class="fa-solid fa-water"></i>Drainage</span>
              <span class="count">17 works</span>
            </div>
            <div class="cat-track">
              <div class="cat-seg done" style="width:41%"></div>
              <div class="cat-seg progress" style="width:40%"></div>
              <div class="cat-seg delayed" style="width:19%"></div>
            </div>
          </div>

          <div class="cat-row">
            <div class="cat-label">
              <span class="name"><i class="fa-solid fa-building-shield"></i>Public Facilities</span>
              <span class="count">13 works</span>
            </div>
            <div class="cat-track">
              <div class="cat-seg done" style="width:55%"></div>
              <div class="cat-seg progress" style="width:45%"></div>
            </div>
          </div>

          <div class="cat-key">
            <span class="done"><i></i>Completed</span>
            <span class="progress"><i></i>In progress</span>
            <span class="delayed"><i></i>Delayed</span>
          </div>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div>
              <h2>Verification Queue</h2>
              <p>Awaiting your approval</p>
            </div>
            <a class="panel-link" href="#">See all →</a>
          </div>

          <div class="queue-item">
            <div class="queue-icon"><i class="fa-solid fa-road"></i></div>
            <div class="queue-info">
              <div class="t">Approach Road — Rahata</div>
              <div class="s">Submitted by Engineer · Stage 3</div>
            </div>
            <div class="queue-time">2h ago</div>
          </div>

          <div class="queue-item">
            <div class="queue-icon"><i class="fa-solid fa-school"></i></div>
            <div class="queue-info">
              <div class="t">School Building — Shevgaon</div>
              <div class="s">Submitted by Engineer · Final</div>
            </div>
            <div class="queue-time">5h ago</div>
          </div>

          <div class="queue-item">
            <div class="queue-icon"><i class="fa-solid fa-droplet"></i></div>
            <div class="queue-info">
              <div class="t">Water Tank — Kopargaon</div>
              <div class="s">Submitted by Engineer · Stage 2</div>
            </div>
            <div class="queue-time">1d ago</div>
          </div>

          <div class="queue-item">
            <div class="queue-icon"><i class="fa-solid fa-water"></i></div>
            <div class="queue-info">
              <div class="t">Drainage Work — Pathardi</div>
              <div class="s">Submitted by Engineer · Stage 1</div>
            </div>
            <div class="queue-time">1d ago</div>
          </div>

          <div class="queue-item">
            <div class="queue-icon"><i class="fa-solid fa-road"></i></div>
            <div class="queue-info">
              <div class="t">Internal Road — Newasa</div>
              <div class="s">Submitted by Engineer · Stage 2</div>
            </div>
            <div class="queue-time">2d ago</div>
          </div>
        </div>
      </div>

      <div class="grid-3">
        <div class="panel">
          <div class="panel-head">
            <div>
              <h2>Recent Activity</h2>
              <p>System-wide log</p>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot"></div>
            <div class="activity-text">
              <div class="t"><b>Admin</b> approved verification for Water Tank, Kopargaon</div>
              <div class="time">Today, 11:42 AM</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot"></div>
            <div class="activity-text">
              <div class="t"><b>Engineer R. Patil</b> uploaded progress photos for School Building, Shevgaon</div>
              <div class="time">Today, 10:15 AM</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot"></div>
            <div class="activity-text">
              <div class="t"><b>Gram Panchayat, Rahata</b> registered new work: Approach Road Repair</div>
              <div class="time">Yesterday, 4:30 PM</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot"></div>
            <div class="activity-text">
              <div class="t"><b>Taluka Officer</b> flagged delay in Drainage Work, Pathardi</div>
              <div class="time">Yesterday, 2:05 PM</div>
            </div>
          </div>

          <div class="activity-item">
            <div class="activity-dot"></div>
            <div class="activity-text">
              <div class="t"><b>Admin</b> generated monthly utilization report</div>
              <div class="time">2 days ago</div>
            </div>
          </div>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div>
              <h2>Alerts</h2>
              <p>Needs attention</p>
            </div>
          </div>

          <div class="alert-item critical">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <div class="t">Deadline crossed — Drainage Work, Pathardi</div>
              <div class="s">Stage 1 review pending 6 days</div>
            </div>
          </div>

          <div class="alert-item critical">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
              <div class="t">Budget overrun flagged — Road Work, Newasa</div>
              <div class="s">Utilization at 104% of sanctioned amount</div>
            </div>
          </div>

          <div class="alert-item warn">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
              <div class="t">No progress update — 12 days</div>
              <div class="s">Water Supply, Akole taluka</div>
            </div>
          </div>

          <div class="alert-item warn">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
              <div class="t">Document missing for stage-2 claim</div>
              <div class="s">School Building, Shevgaon</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

</body>
</html>
