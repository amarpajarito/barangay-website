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
    <link rel="stylesheet" href="admin-manage-users-style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
    <script src="/backend/script.js" defer></script>
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
            <li><a href="manage-equipment-request"><i class="fas fa-toolbox"></i> Equipment Request</a></li>
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
            <h2><i class="fas fa-users"></i> Manage Users</h2>
            <div class="header-controls">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchBox" placeholder="Search users">
                </div>
                <button id="addUserBtn" class="manage-user-add-user-btn">Add New User</button>
            </div>
        </div>

        <table id="manageUsersTable">
            <thead>
                <tr>
                    <th>ID <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Name <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Email <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Role <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Added <span class="sort-icon"><i class="fa fa-sort"></i></span></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT id, CONCAT(first_name, ' ', last_name) AS name, email, 
                CASE WHEN is_admin = 1 THEN 'Admin' ELSE 'User' END AS user_role,
                created_at FROM users ORDER BY id ASC";

                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Query Failed: " . mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    $roleBadge = ($row['user_role'] == 'Admin') 
                        ? "<span class='role-badge role-admin'>Admin</span>" 
                        : "<span class='role-badge role-user'>User</span>";

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . $roleBadge . "</td>";
                    echo "<td>" . date("Y-m-d", strtotime($row['created_at'])) . "</td>"; 
                    echo "<td>
                        <button class='edit-btn'  onclick='openEditModal(" . $row['id'] . ", \"" . addslashes($row['name']) . "\", \"" . addslashes($row['email']) . "\", \"" . ($row['user_role'] == 'Admin' ? 'admin' : 'user') . "\")'>
                            <i class='fas fa-edit'></i> Edit
                        </button>
                        <form action='/admin-backend/delete-user.php' method='post'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                            <button type='submit' class='delete-btn' onclick='return confirm(\"Are you sure?\");'>
                                <i class='fas fa-trash'></i> Delete
                            </button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </section>
    
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-users"></i> Add New User</h2>
                <button class="close">&times;</button>
            </div>
            <div class="modal-body">
                <form action="/admin-backend/edit-user.php" method="post">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="role">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="add-user-btn">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="editUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-user-edit"></i> Edit User</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form action="/admin-backend/edit-user.php" method="post">
                <input type="hidden" id="edit_user_id" name="id" value="<?= $id ?>">
                
                <div class="form-group">
                    <label for="edit_first_name">First Name:</label>
                    <input type="text" id="edit_first_name" name="first_name" value="<?= $first_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit_last_name">Last Name:</label>
                    <input type="text" id="edit_last_name" name="last_name" value="<?= $last_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit_email">Email:</label>
                    <input type="email" id="edit_email" name="email" value="<?= $email ?>" required>
                </div>
                <div class="form-group">
                    <label for="edit_role">Role:</label>
                    <select id="edit_role" name="is_admin">
                        <option value="0" <?= $is_admin == 0 ? 'selected' : '' ?>>User</option>
                        <option value="1" <?= $is_admin == 1 ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="edit-user-btn">Edit User</button>
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
