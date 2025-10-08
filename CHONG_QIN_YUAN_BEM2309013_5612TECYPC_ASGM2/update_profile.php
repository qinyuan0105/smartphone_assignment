<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit;
}

$users = json_decode(file_get_contents('data/user.json'), true);
$userIndex = null;

// Find current user
foreach ($users as $index => $user) {
    if ($user['id'] === $_SESSION['userID']) {
        $userIndex = $index;
        break;
    }
}

if ($userIndex !== null) {
    // Update basic information
    $users[$userIndex]['username'] = $_POST['username'];
    $users[$userIndex]['email'] = $_POST['email'];

    // Handle password update
    if (!empty($_POST['new_password']) && $_POST['new_password'] === $_POST['confirm_password']) {
        $users[$userIndex]['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file_extension = strtolower(pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_extension, $allowed_extensions)) {
            $new_filename = uniqid() . '.' . $file_extension;
            $upload_path = 'image/' . $new_filename;

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
                // Delete old profile picture if it exists and isn't the default
                if ($users[$userIndex]['pp'] !== 'default.png') {
                    @unlink('image/' . $users[$userIndex]['pp']);
                }
                $users[$userIndex]['pp'] = $new_filename;
            }
        }
    }

    // Save changes
    file_put_contents('data/user.json', json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION['username'] = $_POST['username'];

    header('Location: profile.php?success=1');
} else {
    header('Location: profile.php?error=1');
}
?>
