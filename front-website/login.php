<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
$fieldError = isset($_SESSION['field']) ? $_SESSION['field'] : null;
unset($_SESSION['error'], $_SESSION['field']);

$rememberedUser = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Barangay San Vicente San Pedro City Laguna</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
<div class="login-container">
        <div class="login-box">
            <img src="/images/barangay-logo.png" alt="Barangay Logo" class="logo">
            <h2>BSVRMS</h2>
            <h3>Barangay San Vicente Resident and Management System</h3>
            <p>San Pedro City Laguna</p>

            <form action="/backend/authenticate.php" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email-username" placeholder="Email or username" value="<?php echo htmlspecialchars($rememberedUser); ?>" required>
                    <?php if ($fieldError == "username"): ?>
                        <label class="error-label"><?php echo $error; ?></label>
                    <?php endif; ?>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                    <?php if ($fieldError == "password"): ?>
                        <label class="error-label"><?php echo $error; ?></label>
                    <?php endif; ?>
                </div>
                
                <div class="options">
                    <label>
                        <input type="checkbox" name="remember" <?php echo !empty($rememberedUser) ? "checked" : ""; ?>> Remember Me
                    </label>
                    <a href="login.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Sign In</button>
                <p class="register-link">No account yet? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </div>
</body>
</html>