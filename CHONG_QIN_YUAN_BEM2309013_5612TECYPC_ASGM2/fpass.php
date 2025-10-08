<?php
require_once("api/reg_master.inc.php");
displayHeader3("Forgot Password"); 

$error = "";
$disable_input = "disabled";
$step = $_POST['step'] ?? 1; // Persist the step value across form submissions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $users = json_decode(file_get_contents("data/user.json"), true);

    if ($step == 1) {
        // Step 1: Validate username and email
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['email'] === $email) {
                $disable_input = null; // Enable password fields
                $step = 2; // Move to Step 2
                break;
            }
        }

        if ($step == 1) {
            $error = "Invalid username or email.";
        }
    } elseif ($step == 2) {
        // Step 2: Validate new password and confirm password
        if ($password === $confirm_password && !empty($password)) {
            // Update the user's password in user.json
            foreach ($users as &$user) {
                if ($user['username'] === $username && $user['email'] === $email) {
                    $user['password'] = $password;
                    break;
                }
            }
            file_put_contents("data/user.json", json_encode($users, JSON_PRETTY_PRINT));

            // Redirect to the login page
            header("Location: login.php");
            exit;
        } else {
            $error = "Passwords do not match or are empty.";
        }
    }
}
?>

<div class="container mt-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 400px; border-radius: 15px;">
        <h3 class="text-center mb-4" style="color: #2b2b2b;">Forgot Password</h3>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="step" value="<?= $step ?>">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input name="username" class="form-control" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" <?= $step == 2 ? 'readonly' : '' ?> placeholder="Enter your username" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input name="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" <?= $step == 2 ? 'readonly' : '' ?> placeholder="Enter your registered email" required>
                </div>
            </div>
            <?php if ($step == 2): ?>
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input name="password" type="password" class="form-control" placeholder="Create a new password" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Re-confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input name="confirm_password" type="password" class="form-control" placeholder="Re-enter your new password" required>
                    </div>
                </div>
            <?php endif; ?>
            <button class="btn btn-primary w-100" type="submit" style="background-color: #cbdef1;"><?= $step == 1 ? 'Next' : 'Reset Password' ?></button>
            <div class="text-center mt-3">
                <a href="guest.php" style="color: #3d4852;">Continue as Guest</a>
            </div>
            <div class="text-center mt-2">
                <span>Don't have an account? <a href="sign_up.php" style="color: #3d4852;">
                    <br>Sign Up</a> | <a href="login.php" style="color: #3d4852;">Login</a></span>
            </div>
        </form>
    </div>
</div>

<?php displayFooter(); ?>