<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 text-center">
                <div class="card shadow floating-card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Successfully Logged Out</h2>
                        <p class="card-text">Thank you for using us! You have been successfully logged out:></p>
                        <div class="mt-4">
                            <a href="login.php" class="btn btn-primary me-2">Log In Again</a>
                            <a href="sign_up.php" class="btn btn-secondary">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
