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
    <link rel="stylesheet" href="contact-style.css">
    <script src="/user-website/script.js"></script>
</head>
<body>
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


    <!-- Contacts section of the website -->


<main>
    <div class="contact-titlebg-container">
	<h2 class="contact-titlebg">Contact Us</h2>
</div>
<section class="contact-section">
    <div class="contact-wrapper">
        <div class="contact-container">
            <div class="contact-left">

                <div class="contact-icon-wrapper">
                    <img src="/images/contact-us.png" alt="Contact Icon" class="contact-icon">
                </div>
                <form action="https://formsubmit.co/@.com" method="post" class="contact-form">
                    <div class="input-group">
                        <input type="text" name="first-name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="last-name" placeholder="Last Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="address" placeholder="Address" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="input-group">
                        <textarea name="message" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>

            </div>
        </div>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.2065650158656!2d121.0458109751015!3d14.357454386100573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d0cc35a8d41b%3A0x58cc05b88b0aeb6a!2sSan%20Vicente%20Barangay%20Hall!5e0!3m2!1sen!2sph!4v1740658937553!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

</main>



<!-- End -->



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
</body>
</html>