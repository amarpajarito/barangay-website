<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request | Barangay San Vicente San Pedro City Laguna</title>
    <link rel="stylesheet" href="req-style.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="contacts-style.css">
    <script src="/user-website/script.js"></script>
</head>
<body>
    <main>
    <header>
        <nav class="navbar">
            <div class="header-content">
                <a href="home.php">
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
                <li><a href="/user-website/home.php">Home</a></li>
                <li class="request-item">
                    <a href="request.php">Request <i class="fas fa-angle-down"></i></a>
                    <div class="submenu">
                        <a href="docu-req.php">Document Request <i class="fas fa-angle-right"></i></a>
                        <a href="equip-req.php">Equipment Request <i class="fas fa-angle-right"></i></a>
                    </div>
                </li>
                <li><a href="enlistment-page.php">Register</a></li>
                <li><a href="contacts.php">Contact</a></li>
            </ul>
    
            <?php
            if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
                $full_name = htmlspecialchars($_SESSION['first_name'] . " " . $_SESSION['last_name']);
            } else {
                $full_name = htmlspecialchars($_SESSION['user_name']);
            }
    
            $profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : "/images/barangay-logo.png";
    
            echo '<div class="profile-dropdown">
                <button class="profile-btn">
                    <img src="' . htmlspecialchars($profile_pic) . '" alt="Profile" class="profile-pic">
                    <span>' . $full_name . '</span>
                    <i class="fas fa-angle-down"></i>
                </button>
                <div class="submenu">
                    <a href="profile.php">Edit Profile</a>
                    <a href="/backend/logout.php">Logout</a>
                </div>
            </div>';
            ?>
        </nav>
    </header>

    <div class="document-request-title-container">
        <h2 class="document-request-title">Document Request Form</h2>
    </div>

    <div class="document-request-container">
        <form action="/user-website/user-backend/submit-document-request.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="document-type">Type of Document:</label>
            <select id="document-type" name="document-type" required>
                <option value="" disabled selected>Select Document Type</option>
                <option value="Barangay Clearance">Barangay Clearance</option>
                <option value="Indigency Certificate">Indigency Certificate</option>
                <option value="Business Permit">Business Permit</option>
            </select>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="reason">For What Reason:</label>
            <textarea id="reason" name="reason" required></textarea>

            <button type="submit">Submit Request</button>
        </form>
    </div>

    <footer class="footer-panel">
        <div class="footer-top">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="../images/republika.png" alt="Logo">
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
</main>
</body>
</html>
