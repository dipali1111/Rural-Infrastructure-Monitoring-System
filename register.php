<?php
require 'includes/db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, mobile, password, role) VALUES (?, ?, ?, ?, 'gram_panchayat')");
            $stmt->bind_param("ssss", $name, $email, $mobile, $hash);
            if ($stmt->execute()) {
                $success = "Registration successful! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | Ahmednagar Connect</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<style>
:root{
  --teal-deep:#133336; --teal-mid:#285F6B; --teal-bright:#367D8A; --teal-pale:#DCEAEC;
  --bg:#F4F7F8; --paper:#FFFFFF; --ink:#133336; --muted:#5C7477; --line:#DDE6E7;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Poppins',sans-serif;color:var(--ink);background:var(--bg);}
a{text-decoration:none;color:inherit;}

.gov-strip{background:var(--teal-deep);color:#CFE3E5;font-size:12px;padding:6px 40px;display:flex;justify-content:space-between;}
header{background:var(--paper);border-bottom:1px solid var(--line);}
.header-top{display:flex;align-items:center;justify-content:space-between;padding:16px 40px;}
.brand{display:flex;align-items:center;gap:14px;}
.brand .emblem{width:48px;height:48px;border-radius:6px;overflow:hidden;}
.brand .emblem img{width:100%;height:100%;object-fit:contain;}
.brand h1{font-size:19px;font-weight:700;color:var(--teal-deep);}
.brand p{font-size:12px;color:var(--muted);}
.btn-ghost{border:1px solid var(--teal-mid);color:var(--teal-mid);background:none;padding:9px 20px;border-radius:4px;font-size:13px;font-weight:600;cursor:pointer;}
.btn-ghost:hover{background:var(--teal-pale);}

.form-wrap{max-width:480px;margin:50px auto;background:var(--paper);border:1px solid var(--line);border-radius:6px;padding:40px;}
.form-wrap .eyebrow{font-size:11.5px;letter-spacing:1px;text-transform:uppercase;color:var(--teal-bright);font-weight:600;margin-bottom:8px;}
.form-wrap h2{font-size:22px;font-weight:700;color:var(--teal-deep);margin-bottom:6px;}
.form-wrap p.sub{font-size:13px;color:var(--muted);margin-bottom:28px;}
.form-group{margin-bottom:18px;}
.form-group label{display:block;font-size:12.5px;font-weight:600;margin-bottom:6px;}
.form-group input{width:100%;padding:11px 13px;border:1px solid var(--line);border-radius:4px;font-size:13.5px;font-family:'Poppins';}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.btn-submit{width:100%;background:var(--teal-mid);color:#fff;border:none;padding:13px;border-radius:4px;font-weight:600;font-size:14px;cursor:pointer;}
.btn-submit:hover{background:var(--teal-deep);}
.form-footer{text-align:center;margin-top:22px;font-size:13px;color:var(--muted);}
.form-footer a{color:var(--teal-mid);font-weight:600;}
.msg{padding:12px 14px;border-radius:4px;font-size:13px;margin-bottom:20px;}
.msg.error{background:#F7E7E7;color:#B14C4C;}
.msg.success{background:#E5F2E9;color:#3E8259;}
footer{background:var(--teal-deep);color:#8FB3B8;text-align:center;padding:22px;font-size:12px;margin-top:60px;}

@media(max-width:600px){
  .form-row{grid-template-columns:1fr;}
  .form-wrap{margin:30px 16px;padding:28px;}
}
</style>
</head>
<body>

<div class="gov-strip">
  <span>Government of Maharashtra &nbsp;|&nbsp; District Administration, Ahmednagar</span>
</div>

<header>
  <div class="header-top">
    <a href="index.html" class="brand">
      <div class="emblem"><img src="assets/logo.png.jpeg" alt="Ahmednagar Connect Logo"></div>
      <div>
        <h1>Ahmednagar Connect</h1>
        <p>Rural Infrastructure Monitoring System</p>
      </div>
    </a>
    <a href="index.html"><button class="btn-ghost"><i class="fa-solid fa-house"></i>&nbsp; Home</button></a>
  </div>
</header>

<div class="form-wrap">
  <div class="eyebrow">New User</div>
  <h2>Create Your Account</h2>
  <p class="sub">Register to access rural infrastructure project updates for Ahmednagar district.</p>

  <?php if ($error): ?>
    <div class="msg error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="msg success"><?= htmlspecialchars($success) ?></div>
  <?php else: ?>

  <form method="POST">
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="name" placeholder="Enter your full name" required>
    </div>
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" name="email" placeholder="you@example.com" required>
    </div>
    <div class="form-group">
      <label>Mobile Number</label>
      <input type="tel" name="mobile" placeholder="10-digit mobile number" required pattern="[0-9]{10}">
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Create password" required minlength="6">
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Re-enter password" required minlength="6">
      </div>
    </div>
    <button type="submit" class="btn-submit">Register</button>
  </form>

  <?php endif; ?>

<div class="form-footer">
    Already have an account? Contact your administrator.
  </div>
<footer>
  © 2026 Ahmednagar Connect | Rural Infrastructure Monitoring System · Version 1.0
</footer>

</body>
</html>
