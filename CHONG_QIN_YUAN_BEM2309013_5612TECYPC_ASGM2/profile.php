<?php
require_once 'api/oo_master.inc.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit;
}

// Get user data
$users = json_decode(file_get_contents("data/user.json"), true);
$currentUser = null;
foreach ($users as $user) {
    if ($user['id'] === $_SESSION['userID']) {
        $currentUser = $user;
        break;
    }
}

displayHeader("User Profile");
?>

<link href=css/profile.css rel="stylesheet">

<div class="wrapper">
    <div class="content">
        <div class="container-fluid px-4 my-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="image/<?= htmlspecialchars($currentUser['pp'] ?? 'default.png') ?>" 
                                 alt="Profile Picture" 
                                 class="rounded-circle mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <h3 class="card-title"><?= htmlspecialchars($currentUser['username']) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profile Information</h4>
                            <div class="mb-3">
                                <label class="text-muted">Email</label>
                                <p class="lead"><?= htmlspecialchars($currentUser['email']) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Username</label>
                                <p class="lead"><?= htmlspecialchars($currentUser['username']) ?></p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted">Member Since</label>
                                <p class="lead"><?= isset($currentUser['created_at']) ? date('F j, Y', strtotime($currentUser['created_at'])) : 'N/A' ?></p>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="edit_profile.php" class="btn btn-primary me-md-2">Edit Profile</a>
                                <a href="home.php" class="btn btn-secondary">Back to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
 ?>
<?php displayFooter();?>