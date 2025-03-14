<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Barangay San Vicente San Pedro City Laguna</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="home-style.css">
    <script src="/user-website/script.js"></script>
    <script src="/user-website/slide.js"></script>
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
<main>
    <div class="home-banner-container">
        <img src="/images/Council.png" alt="Barangay San Vicente Banner">
    </div>
    <div class="home-second-container">
    <div class="image-wrapper">
        <div class="text-overlay">
            <h2>Barangay San Vicente,</h2>
            <h3>SAN PEDRO LAGUNA.</h3>
            <br/>
            <p>
        Recognized as one of the lowest local government units in 
        <strong>San Pedro, Laguna</strong>, Barangay San Vicente operates 
        under the leadership of <strong>Hon. Dr. Apolinario A. Alzona</strong>. 
        Alongside his dedicated Barangay Councilors, he strives to maintain peace 
        and order, safeguarding local residents from harm and providing the best 
        possible services for everyone.
      </p>

      <p>
        Settled in the quiet <strong>City of San Pedro Laguna</strong>, Barangay San Vicente 
        sits in the <strong>1st district</strong>, where it focuses on promoting effective 
        governance and enhancing administrative efficiency.
      </p>

      <p>
        With its bustling streets and thriving community, Barangay San Vicente 
        stands out among the <strong>28 urbanized barangays</strong> in San Pedro Laguna. 
        Modern infrastructure, commercial enterprises, and residential areas all converge here, 
        playing a vital role in advancing the city’s broader urban development goals.
      </p>
      
        </div>
    </div>
</div>
    <div class="group">
        <p class="text">BARANGAY SAN VICENTE, SAN PEDRO LAGUNA - OFFICIAL WEBSITE</p>
    </div>
<div class="home-third-container">
    <div class="gallery-wrapper">
        <div class="gallery-slide">
            <img src="/images/sv-projects.png" alt="Gallery Image 1">
            <img src="/images/sv-projects.png" alt="Gallery Image 2">
            <img src="/images/sv-projects.png" alt="Gallery Image 3">
            <img src="/images/sv-projects.png" alt="Gallery Image 4">
        </div>
    </div>
    
    <div class="text-overlay-2">
        <h2>Barangay San Vicente Projects:</h2>
        <h3>Headed By: Hon. Dr. Apolinario A. Alzona</h3>
        <p>
            Barangay San Vicente continues to flourish as a community-driven, urbanized 
            barangay in <strong>San Pedro, Laguna</strong>. With ongoing development projects, 
            it ensures the residents benefit from sustainable infrastructure and accessible 
            public services.
        </p>
        </br>
        <p>
            The barangay upholds a mission to create a safe and inclusive environment, 
            spearheaded by <strong>Hon. Dr. Apolinario A. Alzona</strong> and the dedicated Barangay Council. 
            Through strategic urban planning and governance, San Vicente remains a model of local progress.
        </p>
    </div>
</div>
<div class="home-fourth-container">
    <h1>Our Services</h1>
    <div class="row">
    <a href="enlistment-page.php " class="service">
        <i class="fa-solid fa-fingerprint"></i>
        <h2>Register</h2>
        <p>Enlist now in our Barangay</p>
    </a>
    <a href="equip-req.php" class="service">
        <i class="fa-solid fa-toolbox"></i>
        <h2>Equipment Request</h2>
        <p>Request Available Equipments</p>
    </a>
    <a href="docu-req.php" class="service">
        <i class="fa-solid fa-file-invoice"></i>
        <h2>Document Request</h2>
        <p>Request Important Documents</p>
    </a>
    <a href="contacts.php" class="service">
        <i class="fa-solid fa-id-card-clip"></i>
        <h2>Contact Us</h2>
        <p>Send a message to us</p>
    </a>
</div>

</div>        



</main>

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
                        <li><a href="https://op-proper.gov.ph/">Office of the President</a></li>
                        <li><a href="https://www.congress.gov.ph/">Office of the Vice President</a></li>
                        <li><a href="https://legacy.senate.gov.ph/">Senate of the Philippines</a></li>
                        <li><a href="https://www.congress.gov.ph/">House of Representatives</a></li>
                        <li><a href="https://sc.judiciary.gov.ph/">Supreme Court</a></li>
                        <li><a href="https://ca.judiciary.gov.ph/">Court of Appeals</a></li>
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