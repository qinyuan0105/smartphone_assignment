<?php
require_once("api/oo_master.inc.php");
session_start();

// Load all smartphones
$smartphones = json_decode(file_get_contents("data/phone.json"), true);

// Load favorites from fav.json
$favorites = json_decode(file_get_contents("data/fav.json"), true);
$userId = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

// Get the user's favorite IDs
$favIds = isset($favorites[$userId]) ? $favorites[$userId] : [];

displayHeader("Home");
?>
<link href="css/site.css" rel="stylesheet">

<div class="container-fluid px-4"> <!-- Ensure full width -->
<h1 class="text-center my-4" style="font-size: 4rem;">Popular Smartphone!</h1>
    <h4 class="text-center mb-5" style="font-size: 1.8rem;">Making smartphone technology simple and fun to explore.</h4>

    <div class="row g-4"> <!-- Added gutter spacing -->
        <?php foreach ($smartphones as $phone): ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6"> <!-- Responsive columns -->
                <div class="card phone-card h-100 shadow-sm"> <!-- Added shadow -->
                    <div class="text-center py-3"> <!-- Centered image container -->
                        <a href="smartphone.php?id=<?= htmlspecialchars($phone['id']) ?>">
                            <img src="image/<?= htmlspecialchars($phone['image']) ?>" 
                                class="card-img-top img-fluid phone-image"
                                alt="<?= htmlspecialchars($phone['model']) ?>"
                                style="cursor: pointer;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="font-size: 1.8rem;"><?= htmlspecialchars($phone['model']) ?></h5>
                        <p class="card-text" style="font-size: 1.4rem;"><strong>Brand:</strong> <?= htmlspecialchars($phone['manufacturer']) ?></p>
                        <div class="mt-auto d-flex justify-content-end">
                            <button class="love-icon <?= in_array($phone['id'], $favIds) ? 'favorited' : '' ?>"
                                data-item-id="<?= htmlspecialchars($phone['id']) ?>"
                                style="border: none; background: none; font-size: 2.5rem;">
                                <?= in_array($phone['id'], $favIds) ? '❤️' : '🤍' ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    /* Add wrapper styles for sticky footer */
    html, body {
        height: 100%;
        margin: 0;
    }
    
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    
    .container-fluid {
        flex: 1 0 auto;
    }
    
    footer {
        flex-shrink: 0;
    }

    /* Your existing styles */
    .phone-image:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
</style>

<?php displayFooter(); ?>