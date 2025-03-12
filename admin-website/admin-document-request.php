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
    <title>Admin Dashboard | Document Request | Barangay San Vicente San Pedro City Laguna</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin-document-request-style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
    <script src="../backend/script.js" defer></script>
    <script src="../backend/view-document.js" defer></script>

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
            <h2><i class="fas fa-file-alt"></i> Document Request</h2>
            <div class="header-controls">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchBox" placeholder="Search Document Requests">
                </div>
            </div>
        </div>

        <table id="manageUsersTable">
    <thead>
        <tr>
            <th>ID <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
            <th>Name <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
            <th>Address <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
            <th>Document Type <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
            <th>Reason <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
            <th>Added <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
            <th>Actions</th>
            <th>Status <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT id, name, address, document_type, reason, request_date, status FROM document_requests ORDER BY id ASC";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query Failed: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['document_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
            echo "<td>" . date("Y-m-d", strtotime($row['request_date'])) . "</td>";

            echo "<td>
            <button class='view-btn' onclick='viewRequest(" . $row["id"] . ", \"" . htmlspecialchars($row["name"]) . "\", \"" . htmlspecialchars($row["address"]) . "\", \"" . htmlspecialchars($row["document_type"]) . "\", \"" . htmlspecialchars($row["reason"]) . "\", \"" . date("Y-m-d", strtotime($row['request_date'])) . "\", \"" . htmlspecialchars($row["status"]) . "\")'>
            <i class='fas fa-eye'></i> View
            </button>
            <button class='approve-btn' onclick='updateStatus(" . $row["id"] . ", \"Approved\")'>
            <i class='fas fa-check'></i> Approve
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

    <div id="viewRequestModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-eye"></i> View Equipment Request</h2>
            <button class="close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="view_name">Name:</label>
                <input type="text" id="view_name" readonly>
            </div>
            <div class="form-group">
                <label for="view_address">Address:</label>
                <input type="text" id="view_address" readonly>
            </div>
            <div class="form-group">
                <label for="view_document_type">Document Type:</label>
                <input type="text" id="view_document_type" readonly>
            </div>
            <div class="form-group">
                <label for="view_reason">Reason:</label>
                <textarea id="view_reason" readonly></textarea>
            </div>
            <div class="form-group">
                <label for="view_request_date">Request Date:</label>
                <input type="text" id="view_request_date" readonly>
            </div>
            <div class="form-group">
                <label for="view_status">Status:</label>
                <input type="text" id="view_status" readonly>
            </div>
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