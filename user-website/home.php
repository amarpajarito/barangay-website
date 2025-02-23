<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Vicente San Pedro City Laguna | Home Page</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="home-style.css">
</head>
<body>

<!-- HEADER -->
<header>
    <nav class="navbar">
        <div class="header-content">
            <a href="index.php" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                <div class="logo">
                    <img src="/images/barangay-logo.png" alt="Barangay San Vicente Logo">
                </div>
                <div class="header-title">
                    <h2>Barangay San Vicente</h2>
                    <h3>San Pedro City Laguna</h3>
                </div>
            </a>
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="request-item">
                <a href="request.php">Request <i class="fas fa-angle-down"></i></a>
                <div class="submenu">
                    <a href="document-request.php">Document Request <i class="fas fa-angle-right"></i></a>
                    <a href="equipment-request.php">Equipment Request <i class="fas fa-angle-right"></i></a>
                </div>
            </li>
            <li><a href="enlist.html">Register</a></li>
            <li><a href="contacts.html">Contact</a></li>
        </ul>

        <div class="nav-buttons">
            <?php
            if (isset($_SESSION['user_name'])) {
                // User is logged in, show profile dropdown
                echo '<div class="profile-dropdown">
                        <button class="profile-btn">
                            <img src="/images/default-profile.png" alt="Profile" class="profile-pic">
                            <span>' . htmlspecialchars($_SESSION['user_name']) . '</span>
                            <i class="fas fa-angle-down"></i>
                        </button>
                        <div class="submenu">
                            <a href="logout.php">Logout</a>
                        </div>
                      </div>';
            } else {
                // User is not logged in, show Sign-in and Register buttons
                echo '<a href="login.php" class="btn sign-in">Sign in</a>';
                echo '<a href="register.php" class="btn register">Register</a>';
            }
            ?>
        </div>
    </nav>
</header>

<!-- FOOTER -->
<footer class="footer-panel">
    <div class="footer-top">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="/images/republika.png" alt="Logo">
            </div>
            <div class="footer-links">
                <div>
                    <h3>REPUBLIC OF THE PHILIPPINES</h3>
                    <p>All content is in the public domain unless otherwise stated.</p>
                </div>
                <div>
                    <h3>ABOUT GOVPH</h3>
                    <p>Learn more about the Philippine government, its structure, how government works, and the people behind it.</p>
                    <ul>
                        <li><a href="#">GOV.PH</a></li>
                        <li><a href="#">Open Data Portal</a></li>
                        <li><a href="#">Official Gazette</a></li>
                    </ul>
                </div>
                <div>
                    <h3>GOVERNMENT LINKS</h3>
                    <ul>
                        <li><a href="#">Office of the President</a></li>
                        <li><a href="#">Office of the Vice President</a></li>
                        <li><a href="#">Senate of the Philippines</a></li>
                        <li><a href="#">House of Representatives</a></li>
                        <li><a href="#">Supreme Court</a></li>
                        <li><a href="#">Court of Appeals</a></li>
                        <li><a href="#">Sandiganbayan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Copyright © 2024 <strong>The Official Website of Barangay San Vicente</strong>. All Rights Reserved.</p>
        <p>Barangay Multi-Purpose Hall, Barangay San Vicente, San Pedro, Laguna, Philippines 4023</p>
        <p>Call Us Today: (088) 888 8888</p>
    </div>
</footer>

</body>
</html>
