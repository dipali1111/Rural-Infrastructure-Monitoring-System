<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gram Panchayat Work Monitoring System | Login</title>
    <meta name="description" content="Role-based login page for the Gram Panchayat Work Monitoring System.">
    <meta name="theme-color" content="#285F6B">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23FFFFFF'/%3E%3Crect x='10' y='10' width='44' height='44' rx='10' fill='%23367D8A'/%3E%3Cpath d='M22 42V22h8c6 0 10 2.8 10 8 0 3.7-2.2 6.6-5.6 7.5L42 42h-8l-8-10h-4v10h-6Zm6-6h2c3.2 0 5-1.8 5-4.5 0-2.6-1.8-4.5-5-4.5h-2v9Z' fill='%23101001'/%3E%3C/svg%3E">
    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body>
    <section class="login-layout">
        <div class="brand-panel">
            <div class="brand-hero">
                <img src="assets/images/logo.jpeg" alt="Ahmednagar Connect logo">
                <h1>Ahmednagar Connect</h1>
                <p>Secure portal access for village officials, engineers, taluka officers, district managers, and administrators.</p>
            </div>
            <ul class="brand-list">
                <li><i class="fas fa-user-shield"></i> Role-based enterprise access</li>
                <li><i class="fas fa-lock"></i> Secure login with validation</li>
                <li><i class="fas fa-chart-line"></i> District-wide monitoring workflows</li>
            </ul>
        </div>

        <div class="login-panel">
            <div class="login-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h2 id="headingTitle">Sign in to continue</h2>
                        <p class="lead" id="headingSubtitle">Choose your role and enter your credentials to access the work monitoring dashboard.</p>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Language switch">
                        <button type="button" class="btn btn-outline-secondary language-toggle active" data-lang="en" id="langEn">English</button>
                        <button type="button" class="btn btn-outline-secondary language-toggle" data-lang="mr" id="langMr">मराठी</button>
                    </div>
                </div>

                <form id="loginForm">
                    <div id="alertContainer" class="alert-placeholder"></div>
                    <div class="mb-3">
                        <label for="role" class="form-label" id="labelRole">Role</label>
                        <select id="role" class="form-select" aria-label="User role">
                            <option value="" selected data-text-en="Select your role" data-text-mr="आपली भूमिका निवडा">Select your role</option>
                            <option value="Village/Gram Panchayat User" data-text-en="Village/Gram Panchayat User" data-text-mr="गाव/ग्राम पंचायत वापरकर्ता">Village/Gram Panchayat User</option>
                            <option value="Engineer/Verifier" data-text-en="Engineer/Verifier" data-text-mr="अभियंता/प्रमाणक">Engineer/Verifier</option>
                            <option value="Taluka Officer" data-text-en="Taluka Officer" data-text-mr="तालुका अधिकारी">Taluka Officer</option>
                            <option value="District/CEO Authority" data-text-en="District/CEO Authority" data-text-mr="जिल्हा/सीईओ प्राधिकरण">District/CEO Authority</option>
                            <option value="System Administrator" data-text-en="System Administrator" data-text-mr="सिस्टम प्रशासक">System Administrator</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label" id="labelUsername">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username" autocomplete="username">
                    </div>
                    <div class="mb-3 password-group">
                        <label for="password" class="form-label" id="labelPassword">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" autocomplete="current-password">
                        <button type="button" id="togglePassword" class="password-toggle" aria-label="Show or hide password"><i class="bi bi-eye"></i></button>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe" id="labelRemember">Remember Me</label>
                    </div>
                    <button type="submit" id="loginButton" class="btn btn-primary btn-login">Login</button>
                </form>
                <div class="login-footer">
                    <a href="#" class="link-soft" id="forgotText">Forgot Password?</a>
                    <span class="text-muted" id="supportText">Support: support@ahmadnagarconnect.gov.in</span>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/login-translations.js"></script>
    <script src="assets/js/login.js"></script>
</body>
</html>
