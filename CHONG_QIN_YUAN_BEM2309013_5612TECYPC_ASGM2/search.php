<?php
require_once("api/oo_master.inc.php");
session_start();

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$smartphones = json_decode(file_get_contents("data/phone.json"), true);

// Filter smartphones based on search query
$searchResults = array_filter($smartphones, function($phone) use ($searchQuery) {
    return stripos($phone['model'], $searchQuery) !== false ||
           stripos($phone['manufacturer'], $searchQuery) !== false;
});

displayHeader("Search Results");
?>

<div class="min-vh-100 d-flex flex-column">
    <div class="container-fluid px-4 flex-grow-1">
        <h2 class="mb-4">Search Results for "<?= htmlspecialchars($searchQuery) ?>"</h2>
        
        <div class="row g-4">
            <?php if (empty($searchResults)): ?>
                <div class="col-12">
                    <p>No smartphones found matching your search.</p>
                </div>
            <?php else: ?>
                <?php foreach ($searchResults as $phone): ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <!-- Use the same card structure as in home.php -->
                        <div class="card phone-card h-100 shadow-sm">
                            <div class="text-center py-3">
                                <a href="smartphone.php?id=<?= htmlspecialchars($phone['id']) ?>">
                                    <img src="image/<?= htmlspecialchars($phone['image']) ?>" 
                                        class="card-img-top img-fluid phone-image"
                                        alt="<?= htmlspecialchars($phone['model']) ?>"
                                        style="cursor: pointer;">
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($phone['model']) ?></h5>
                                <p class="card-text"><strong>Brand:</strong> <?= htmlspecialchars($phone['manufacturer']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php displayFooter(); ?>