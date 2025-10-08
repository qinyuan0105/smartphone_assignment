<?php
require_once('api/oo_master.inc.php');
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit;
}

$users = json_decode(file_get_contents('data/user.json'), true);
$currentUser = null;

foreach ($users as $user) {
    if ($user['id'] === $_SESSION['userID']) {
        $currentUser = $user;
        break;
    }
}

displayHeader("Edit Profile");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-custom text-white">
                    <h3 class="card-title mb-0">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="text-center mb-4">
                            <img src="image/<?= htmlspecialchars($currentUser['pp']) ?>" 
                                 alt="Profile Picture" 
                                 class="rounded-circle profile-pic-large mb-3">
                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Change Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= htmlspecialchars($currentUser['username']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($currentUser['email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="profile.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
displayFooter();
?>
