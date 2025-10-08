<?php
require_once("api/reg_master.inc.php");

$smartphones = json_decode(file_get_contents("data/phone.json"), true);
displayHeader2("Guest Home");
?>

<div class="container-fluid px-4">
    <h1 class="text-center my-4" style="font-size: 3.5rem;">Popular Smartphone!</h1>
    <h4 class="text-center mb-5">Making smartphone technology simple and fun to explore.</h4>

    <div class="row g-4">
        <?php foreach ($smartphones as $phone): ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="card phone-card h-100 shadow-sm">
                    <div class="text-center py-3">
                        <a href="#" onclick="showToast(); return false">
                            <img src="image/<?= htmlspecialchars($phone['image']) ?>" 
                                class="card-img-top img-fluid phone-image"
                                alt="<?= htmlspecialchars($phone['model']) ?>"
                                style="cursor: pointer;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($phone['model']) ?></h5>
                        <p class="card-text"><strong>Brand:</strong> <?= htmlspecialchars($phone['manufacturer']) ?></p>
                        <div class="mt-auto d-flex justify-content-end">
                            <button class="love-icon" onclick="showToast(); return false"
                                style="border: none; background: none;">
                                🤍
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
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