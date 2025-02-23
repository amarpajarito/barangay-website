<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Barangay San Vicente</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="/images/barangay-logo.png" alt="Barangay Logo" class="logo">
            <h2>BDRMS</h2>
            <h3>Barangay San Vicente Resident and Management System</h3>
            <p>San Pedro City Laguna</p>
            <form action="/backend/authenticate.php" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email-username" placeholder="Email or username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="options">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>


