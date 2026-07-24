<?php
session_start();
require 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login | RIMS</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#F4F7F8;display:flex;align-items:center;justify-content:center;min-height:100vh;}
.box{background:#fff;padding:40px;border-radius:6px;box-shadow:0 4px 15px rgba(0,0,0,.08);width:360px;border:1px solid #DDE6E7;}
.box h2{color:#133336;margin-bottom:6px;}
.box p{color:#5C7477;font-size:13px;margin-bottom:24px;}
input{width:100%;padding:12px;margin-bottom:14px;border:1px solid #DDE6E7;border-radius:4px;font-size:14px;}
button{width:100%;padding:12px;background:#285F6B;color:#fff;border:none;border-radius:4px;font-weight:600;cursor:pointer;}
button:hover{background:#133336;}
.err{background:#F7E7E7;color:#B14C4C;padding:10px;border-radius:4px;font-size:13px;margin-bottom:14px;}
</style>
</head>
<body>
<div class="box">
    <h2>RIMS Login</h2>
    <p>Ahmednagar Connect — Rural Infrastructure Monitoring</p>
    <?php if ($error) echo "<div class='err'>$error</div>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
