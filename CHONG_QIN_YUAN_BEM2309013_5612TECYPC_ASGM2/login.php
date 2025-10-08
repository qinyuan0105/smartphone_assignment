<?php
require_once("api/reg_master.inc.php");
displayHeader3("Login"); 
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $users = json_decode(file_get_contents("data/user.json"), true);

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            // Store user data in session
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['f_name'] = $user['first_name'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['userID'] = $user['id'];

            // Load favorites from fav.json
            $favorites = json_decode(file_get_contents("data/fav.json"), true);
            $_SESSION['favsmartphone'] = isset($favorites[$user['id']]) ? $favorites[$user['id']] : [];

            // Redirect to the home page
            header("Location: home.php");
            exit;
        }
    }

    $error = "Invalid username or password.";
}
?>

<div class="container mt-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 400px; border-radius: 15px;">
        <h3 class="text-center mb-4" style="color: #2b2b2b;">L o g i n</h3>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="mx-auto">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input name="username" class="form-control" placeholder="Enter your username" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input name="password" type="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>
            <button class="btn btn-primary w-100" type="submit" style="background-color: #cbdef1;">Login</button>
            <div class="link-section mt-4">
                <div class="text-center mb-3">
                    <div class="d-flex justify-content-between px-4">
                        <a href="guest.php" class="link-item" style="color: #3d4852; text-decoration: none;">
                            <i class="fa-solid fa-user"></i> Guest Mode
                        </a>
                        <a href="fpass.php" class="link-item" style="color: #3d4852; text-decoration: none;">
                            <i class="fas fa-key"></i> Reset Password
                        </a>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="sign_up.php" class="link-item" style="color: #3d4852; text-decoration: none;">
                        <i class="fas fa-user-plus"></i> Create New Account
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php displayFooter(); ?>