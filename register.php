<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Barangay San Vicente</title>
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="/images/barangay-logo.png" alt="Barangay Logo" class="logo">
            <h2>Register</h2>
            <form action="register_process.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-image"></i>
                    <input type="file" name="profile_picture" accept="image/*" required>
                </div>
                <button type="submit" class="btn">Register</button>
                <p>Already have an account? <a href="login.php">Sign in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
