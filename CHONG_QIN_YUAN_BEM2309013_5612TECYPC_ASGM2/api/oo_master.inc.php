<?php
function displayHeader($pageTitle = "Smartphone App")
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $users = json_decode(file_get_contents("data/user.json"), true);
    ?>
    <!DOCTYPE html>
    <html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= htmlspecialchars($pageTitle) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="css/site.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="js/fav.js"></script>
   
    </head>

    <body>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-custom mb-4">
            <div class="container-fluid"> <!-- Changed to container-fluid for full width -->
                <a class="navbar-brand" href="home.php">
                    <img id="brand" src="image/logo.png" alt=""> Yuan Smartphone
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="home.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="favorite.php"><i class="fas fa-heart"></i> Favorites</a></li>
                        <li class="nav-item"><a class="nav-link" href="about_us.php"><i class="fas fa-info-circle"></i> About Us</a></li>
                    </ul>

           <!-- Add search form -->
    <form class="d-flex me-3" action="search.php" method="GET">
        <div class="input-group">
            <input type="search" class="form-control" placeholder="Search smartphones..." name="q" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
                    
                    <ul class="navbar-nav">
                        <div class="dropdown d-flex align-items-center">
                            <?php if (isset($_SESSION['username'])): ?>
                                <span class="text-white me-3"><?= htmlspecialchars($_SESSION['username']) ?></span>
                            <?php endif; ?>
                            <button class="btn profile-btn p-0 border-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php
                                $loggedInUser = null;
                                if (isset($_SESSION['userID'])) {
                                    foreach ($users as $user) {
                                        if ($user['id'] === $_SESSION['userID']) {
                                            $loggedInUser = $user;
                                            break;
                                        }
                                    }
                                }
                         
                                ?>
                                <img src="image/<?= htmlspecialchars($loggedInUser['pp'] ?? 'default.png') ?>"
                                    alt="Profile Picture" class="profile_pic">
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure you want to logout?');">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- <div class="container-fluid px-4"> Changed to container-fluid for full width -->
            <?php
}


function displayHeader2($pageTitle = "Smartphone App")
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= htmlspecialchars($pageTitle) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link href="css/site.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/script.js"></script>

    <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-custom mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="guest.php">
                    <img id="brand" src="image/logo.png" alt="Logo" class="me-2">
                    Yuan Smartphone
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="guest.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="favorite.php" onclick="showToast(); return false">
                            <i class="fas fa-heart"></i> Favorites</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php" onclick="showToast(); return false">
                            <i class="fas fa-info-circle"></i> About Us</a></li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="sign_up.php"><i class="fas fa-user-plus"></i> Sign Up</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <div class="dropdown">
                            <button class="btn btn-light p-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="image/anyn.png" alt="Profile Picture" class="profile_pic rounded-circle" style="width: 35px; height: 35px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                            </button>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid px-4">
            <!-- Toast Notification -->
            <div class="toast-container position-fixed top-50 start-50 translate-middle p-2">
                <div id="loginToast" class="toast align-items-center text-bg-warning border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            You need to log in to access this feature.
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <?php

}

function displayHeader3($pageTitle = "Smartphone App")
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= htmlspecialchars($pageTitle) ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="css/site.css" rel="stylesheet"> <!-- Uncomment this if you have custom CSS -->
        <script src="js/script.js"></script>
        <!-- <link href="css/reg.css" rel="stylesheet"> Custom CSS for registration -->
    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-custom mb-4">
            <div class="container-fluid justify-content-center"> <!-- Changed to container-fluid for full width -->
                <a class="navbar-brand" href="login.php">
                    <img id="brand" src="image/logo.png" alt=""> Yuan Smartphone
                </a>         
                </div>
        </nav>
        <div class="container-fluid px-4"> <!-- Changed to container-fluid for full width -->
            <!-- Toast Notification -->
            <div class="toast-container position-fixed top-50 start-50 translate-middle p-2">
                <div id="loginToast" class="toast align-items-center text-bg-warning border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            You need to log in to access this feature.
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <?php

}

function displayFooter()
{
    ?>
        </div> <!-- end container-fluid -->
        <footer class="bg-custom text-center py-4 ">
            <div class="container">
                <p class="mb-3 footer_color fw-bold">&copy; <?= date('Y') ?> Yuan Smartphone Reco App. All rights reserved.</p>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="about_us.php" class="text-white text-decoration-none hover-opacity">
                            <i class="fas fa-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="privacy_policy.php" class="text-white text-decoration-none mx-3">
                            <i class="fas fa-shield-alt me-1"></i>Privacy Policy
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="licensing.php" class="text-white text-decoration-none mx-3 hover-opacity">
                            <i class="fas fa-certificate me-1"></i>Licensing
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="contact.php" class="text-white text-decoration-none hover-opacity">
                            <i class="fas fa-envelope me-1"></i>Contact
                        </a>
                    </li>
                </ul>
                <div class="mt-3">
                    <a href="#" class="text-white mx-2 hover-opacity"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white mx-2 hover-opacity"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white mx-2 hover-opacity"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white mx-2 hover-opacity"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
        </footer>
    </body>

    </html>
    <?php
}