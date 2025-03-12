<?php
session_start();
require('../backend/db-connect.php');

$sql = "SELECT is_admin FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$is_admin = isset($user['is_admin']) ? $user['is_admin'] : 0; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Manage Users | Barangay San Vicente San Pedro City Laguna</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin-resident-enlist-style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
    <script src="../backend/script.js" defer></script>
    <script src="../backend/resident-add.js" defer></script>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="header-content">
            <a href="/admin-website/admin-manage-users.php">
                <div class="logo">
                    <img src="/images/barangay-logo.png" alt="Barangay San Vicente Logo">
                </div>
                <div class="header-title">
                    <h2>Barangay San Vicente</h2>
                    <h3>San Pedro City Laguna</h3>
                    <h4>Admin Dashboard</h4>
                </div>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="admin-manage-users.php"><i class="fas fa-users"></i> Manage Users</a></li>
            <li><a href="admin-document-request.php"><i class="fas fa-file-alt"></i> Document Request</a></li>
            <li><a href="admin-equipment-request.php"><i class="fas fa-toolbox"></i> Equipment Request</a></li>
            <li><a href="admin-resident-enlist.php"><i class="fas fa-house"></i> Resident Enlist</a></li>
        </ul>

        <?php
        if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
            $full_name = htmlspecialchars($_SESSION['first_name'] . " " . $_SESSION['last_name']);
        } else {
            $full_name = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : "Guest";
        }

        $profile_pic = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : "/images/barangay-logo.png";
        ?>

        <div class="profile-dropdown">
            <button class="profile-btn">
                <img src="<?= htmlspecialchars($profile_pic) ?>" alt="Profile" class="profile-pic">
                <span><?= htmlspecialchars($full_name) ?></span>
                <i class="fas fa-angle-down"></i>
            </button>
            <div class="submenu">
                <a href="profile.php">Edit Profile</a>
                <a href="/backend/logout.php">Logout</a>
            </div>
        </div>
    </nav>
</header>

<main>
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert success-alert">
        <strong>Success!</strong> <?= htmlspecialchars($_SESSION['message']) ?>
        <span class="alert-close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert error-alert">
        <strong>Error!</strong> <?= htmlspecialchars($_SESSION['error']) ?>
        <span class="alert-close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

    <section class="manage-users">
        <div class="manage-users-header">
            <h2><i class="fas fa-house"></i> Resident Enlist</h2>
            <div class="header-controls">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchBox" placeholder="Search Resident Enlists">
                </div>
                <button id="addUserBtn" class="manage-user-add-resident-btn">Add New Resident</button>
            </div>
        </div>

        <table id="manageUsersTable">
            <thead>
                <tr>
                    <th>ID <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Name <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Address <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Contact Number <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Civil Status <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Purpose <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Added <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Actions</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT id, first_name, last_name, address, contact_number, civil_status, purpose, created_at, status FROM enlistments ORDER BY id ASC";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last_name']) . " " . htmlspecialchars($row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['civil_status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['purpose']) . "</td>";
                    echo "<td>" . date("Y-m-d", strtotime($row['created_at'])) . "</td>"; 
                    echo "<td>
                    <button class='approve-btn' onclick='updateStatus(" . $row["id"] . ", \"Approved\")'>
                    <i class='fas fa-check'></i> Confirm
                    </button>
                    <button class='reject-btn' onclick='updateStatus(" . $row["id"] . ", \"Rejected\")'>
                    <i class='fas fa-times'></i> Reject
                    </button>
                    </td>";
        
                    $status = htmlspecialchars($row['status']);
                    $status_class = $status === 'Approved' ? 'status-approved' : ($status === 'Rejected' ? 'status-rejected' : 'status-pending');
                    echo "<td class='$status_class'>$status</td>";
        
                    echo "</tr>";
                
                }
                ?>
            </tbody>
        </table>
    </section>
    
    <div id="addResidentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-users"></i> Add New Resident</h2>
            <button class="close">&times;</button>
        </div>
        <div class="modal-body">
            <form action="/admin-backend/add-residents.php" method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="civil_status">Civil Status:</label>
                    <select id="civil_status" name="civil_status" required>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="purpose">Purpose:</label>
                    <input type="text" id="purpose" name="purpose" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="add-resident-btn">Add Resident</button>
                   </div>
               </form>
           </div>
       </div>
    </div>

</main>


<footer class="footer-panel">
    <div class="footer-bottom">
        <p>Copyright © 2024 <strong>The Official Website of Barangay San Vicente</strong>. All Rights Reserved.</p>
        <p>Barangay Multi-Purpose Hall, Barangay San Vicente, San Pedro, Laguna, Philippines 4023</p>
        <p>Call Us Today: (088) 888 8888</p>
    </div>
</footer>

</body>
</html>