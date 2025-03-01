<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Barangay San Vicente</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="register-style.css">

</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <img src="/images/barangay-logo.png" alt="Barangay Logo" class="logo">
            <h2>Register</h2>
            <form action="/backend/registration.php" method="POST" enctype="multipart/form-data">
                <div class="name-container">
                    <div class="input-group">
                        <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Register</button>
                <p class="sign-in-link">Already have an account? <a href="/front-website/login.php">Sign in</a></p>
            </form>
        </div>
    </div>
</body>
</html>