<?php
require_once("api/reg_master.inc.php");
displayHeader3("Sign Up");


$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $users = json_decode(file_get_contents("data/user.json"), true);

        // Check if username or email already exists
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $error = "Username already exists.";
                break;
            }
            if ($user['email'] === $email) {
                $error = "Email already exists.";
                break;
            }
        }

        if (!$error) {
            // Determine the next ID
            $maxId = 0;
            foreach ($users as $user) {
                $maxId = max($maxId, (int)$user['id']);
            }
            $newId = $maxId + 1;

            // Add new user
            $newUser = [
                "id" => (string)$newId,
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "first_name" => $first_name,
                "lname" => $last_name,
                "pp" => "default.png"
            ];
            $users[] = $newUser;
            file_put_contents("data/user.json", json_encode($users, JSON_PRETTY_PRINT));
            $success = "Account created successfully. <a href='login.php'>Login here</a>.";
        }
    }
}
?>


<div class="container mt-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 400px; border-radius: 15px;">
        <h3 class="text-center mb-4" style="color: #2b2b2b;">S i g n U p</h3>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php elseif ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input name="username" class="form-control" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" placeholder="Create a unique username" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="Enter your email address" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                    <input name="first_name" class="form-control" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" placeholder="Enter your first name" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                    <input name="last_name" class="form-control" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" placeholder="Enter your last name" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input name="password" type="password" class="form-control" placeholder="Create a strong password" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input name="confirm_password" type="password" class="form-control" placeholder="Re-enter your password" required>
                </div>
            </div>
            <button class="btn btn-primary w-100" type="submit" style="background-color: #cbdef1;">Sign Up</button>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="login.php" style="color: #3d4852;">Login</a></p>
            </div>
        </form>
    </div>
</div>

<?php displayFooter(); ?>


