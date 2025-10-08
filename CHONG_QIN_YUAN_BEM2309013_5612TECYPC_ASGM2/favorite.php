<?php

require_once("api/oo_master.inc.php");
displayHeader("Your Favorite Phones");
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Load phone data
$smartphones = json_decode(file_get_contents("data/phone.json"), true);

// Get favorite phone IDs from the session
$favIds = isset($_SESSION['favsmartphone']) ? $_SESSION['favsmartphone'] : [];

// Find the favorite phones
$favPhones = [];
foreach ($smartphones as $phone) {
    if (in_array($phone['id'], $favIds)) {
        $favPhones[] = $phone;
    }
}

?>
<link href="css/site.css" rel="stylesheet">

<div class="container-fluid px-4">
    <h1 class="text-center my-4" style="font-size: 3.5rem;">Your Favorite Smartphones!</h1>
    <h4 class="text-center mb-5">Your personal collection of amazing phones.</h4>

    <?php if (empty($favPhones)): ?>
        <div class="alert alert-warning text-center" style="max-width: 500px; margin: 0 auto;">
            You have not added any favorite phones yet :<
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($favPhones as $phone): ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="card phone-card h-100 shadow-sm">
                        <div class="text-center py-3">
                            <a href="smartphone.php?id=<?= htmlspecialchars($phone['id']) ?>">
                                <img src="image/<?= htmlspecialchars($phone['image']) ?>" 
                                    class="card-img-top img-fluid phone-image"
                                    alt="<?= htmlspecialchars($phone['model']) ?>"
                                    style="cursor: pointer;">
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($phone['model']) ?></h5>
                            <p class="card-text"><strong>Brand:</strong> <?= htmlspecialchars($phone['manufacturer']) ?></p>
                            <p class="card-text"><strong>Price:</strong> <?= htmlspecialchars($phone['price']) ?></p>
                            <div class="mt-auto d-flex justify-content-end">
                                <button class="love-icon favorited" data-item-id="<?= htmlspecialchars($phone['id']) ?>"
                                    style="border: none; background: none; font-size: 2.5rem;">
                                    ❤️
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
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

    .phone-image:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
</style>

<?php displayFooter(); ?>