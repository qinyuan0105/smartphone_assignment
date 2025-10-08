<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("api/oo_master.inc.php");


$users = json_decode(file_get_contents("data/user.json"), true);
$smartphones = json_decode(file_get_contents("data/phone.json"), true);
$id = $_GET['id'] ?? null;

// Find the phone that matches the id
$phone = null;
foreach ($smartphones as $item) {
    if ($item['id'] === $id) {
        $phone = $item;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['userID'])) {
        $error = "Please login to submit a review.";
    } else {
        $username = $_SESSION['username'];
        $rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
        $comment = trim($_POST['comment'] ?? '');

        if (!$rating && !$comment) {
            $error = "Please provide both a rating and a comment.";
        } else if (!$rating) {
            $error = "Please select a rating before submitting your review.";
        } else if (!$comment) {
            $error = "Please write a comment for your review.";
        } else {
            $reviewsFile = 'data/review.json';
            $reviews = json_decode(file_get_contents($reviewsFile), true) ?? [];

            $newReview = [
                'reviewID' => uniqid(),
                'smartphoneID' => $id,
                'userID' => $_SESSION['userID'] ?? 'guest', // Use session userID or fallback to 'guest'
                'username' => $username,
                'rating' => $rating,
                'comment' => $comment,
                'reviewdate' => date('Y-m-d')
            ];

            array_unshift($reviews, $newReview); // Add the new review to the top of the array

            // Save back to the file
            file_put_contents($reviewsFile, json_encode($reviews, JSON_PRETTY_PRINT));

            // Redirect to avoid form resubmission warning
            header("Location: smartphone.php?id=$id");
            exit;
        }
    }
}

displayHeader("Smartphone Details");

$favIds = $_SESSION['favsmartphone'] ?? [];

if (!$phone): ?>
    <div class="alert alert-danger text-center mt-5">
        <h4>Smartphone not found</h4>
        <a href="home.php" class="btn btn-secondary mt-3">Back to Home</a>
    </div>
<?php else: ?>
    <div class="container my-5">
        <div class="row">
            <!-- Left Column - Carousel -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div id="carouselExampleIndicators" class="carousel slide carousel-custom shadow-lg">
                    <?php
                    $imageDir = 'image/' . $id . '/';
                    $images = glob($imageDir . '*.{png,jpg,jpeg,gif,webp}', GLOB_BRACE);

                    if (!empty($images)) {
                        // Indicators
                        echo '<div class="carousel-indicators">';
                        foreach ($images as $index => $imagePath) {
                            $activeClass = ($index === 0) ? 'active' : '';
                            echo <<<HTML
                            <button type="button" 
                                    data-bs-target="#carouselExampleIndicators" 
                                    data-bs-slide-to="$index" 
                                    class="$activeClass"
                                    aria-label="Slide {$index}">
                            </button>
                            HTML;
                        }
                        echo '</div>';

                        // Carousel Items
                        echo '<div class="carousel-inner h-100">';
                        foreach ($images as $index => $imagePath) {
                            $activeClass = ($index === 0) ? 'active' : '';
                            $filename = basename($imagePath);
                            echo <<<HTML
                            <div class="carousel-item $activeClass h-100">
                                <div class="d-flex h-100 justify-content-center align-items-center" style="overflow: hidden;">
                                    <img src="$imagePath" class="img-fluid zoom-image" alt="$filename" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imageModal" 
                                        data-fullsize="$imagePath"
                                        style="
                                            width: 100%;
                                            height: 100%;
                                            object-fit: cover;
                                            object-position: center;
                                            cursor: zoom-in;
                                        ">
                                </div>
                            </div>
                            HTML;
                        }
                        echo '</div>';

                        // Controls
                        echo <<<HTML
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        HTML;
                    } else {
                        echo '<div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                <div class="alert alert-warning m-0">No images available</div>
                              </div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Right Column - Specifications -->
            <div class="col-md-6">
                <div class="ps-md-4">
                    <h2 class="mb-4 d-flex align-items-center">
                        <?= htmlspecialchars($phone['model']) ?>
                        <button
                            class="love-icon ms-auto <?= in_array($phone['id'], $_SESSION['favsmartphone'] ?? []) ? 'favorited' : '' ?>"
                            data-item-id="<?= htmlspecialchars($phone['id']) ?>"
                            style="border: none; background: none; font-size: 2.5rem; cursor: pointer; transition: transform 0.3s;">
                            <?= in_array($phone['id'], $_SESSION['favsmartphone'] ?? []) ? '❤️' : '🤍' ?>
                        </button>
                    </h2>

                    <div class="specs-grid mb-4">
                        <div><strong>Brand:</strong></div>
                        <div><?= htmlspecialchars($phone['manufacturer']) ?></div>
                        <div><strong>OS:</strong></div>
                        <div><?= htmlspecialchars($phone['os']) ?></div>
                        <div><strong>Release Date:</strong></div>
                        <div><?= htmlspecialchars($phone['releasedate']) ?></div>
                        <div><strong>Screen Size:</strong></div>
                        <div><?= htmlspecialchars($phone['screensize']) ?> inches</div>
                        <div><strong>Dimensions:</strong></div>
                        <div><?= $phone['width'] ?> × <?= $phone['height'] ?> × <?= $phone['length'] ?> inches</div>
                        <div><strong>Weight:</strong></div>
                        <div><?= htmlspecialchars($phone['weight']) ?></div>
                        <div><strong>Battery:</strong></div>
                        <div><?= htmlspecialchars($phone['battery']) ?></div>
                        <div><strong>Memory:</strong></div>
                        <div><?= htmlspecialchars($phone['memory']) ?></div>
                        <div><strong>Price:</strong></div>
                        <div><?= htmlspecialchars($phone['price']) ?></div>
                    </div>

                    <?php
                    $reviews = json_decode(file_get_contents("data/review.json"), true);
                    $relatedReviews = array_filter($reviews, fn($r) => $r['smartphoneID'] === $id);

                    // Calculate the average rating
                    $averageRating = 0;
                    if (!empty($relatedReviews)) {
                        $totalRating = array_sum(array_column($relatedReviews, 'rating'));
                        $averageRating = round($totalRating / count($relatedReviews), 1); // Rounded to 1 decimal place
                    }
                    ?>

                    <div class="card bg-light p-3 mb-4 shadow-sm">
                        <h5 class="card-title">Recommendation</h5>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-success me-2"><?= $averageRating ?>/10</span>
                            <span>Rating</span>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($phone['recommendation_description']) ?></p>
                    </div>

                    <a href="home.php" class="btn btn-primary px-4 py-2 shadow-sm">Back to Home</a>
                    <a href="#" class="btn btn-primary px-4 py-2 float-end shadow-sm">Buy now</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$reviews = json_decode(file_get_contents("data/review.json"), true);
$relatedReviews = array_filter($reviews, fn($r) => $r['smartphoneID'] === $id);
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Write a Review</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form method="post" action="" class="p-4 shadow-lg rounded bg-light">
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="rating">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                    <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>" style="display: none;">
                    <label for="star<?= $i ?>" style="cursor: pointer;">☆</label>
                <?php endfor; ?>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ratingInputs = document.querySelectorAll('.rating input');
                const ratingLabels = document.querySelectorAll('.rating label');

                ratingInputs.forEach(input => {
                    input.addEventListener('change', function () {
                        const selectedValue = parseInt(this.value);

                        // Highlight stars up to the selected value
                        ratingLabels.forEach((label, index) => {
                            const starValue = 10 - index; // Reverse order for stars
                            label.style.color = starValue <= selectedValue ? '#ffe78f' : '#666';
                        });
                    });
                });
            });
        </script>
        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea class="form-control" name="comment" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit Review</button>
    </form><br>

    <h3 class="text-center mb-4">User Reviews</h3>
    <div class="reviews-container">
        <?php if (empty($relatedReviews)): ?>
            <p class="text-muted text-center">No reviews yet. Be the first to leave one!</p>
        <?php else: ?>
            <?php foreach ($relatedReviews as $review): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <img src="image/<?= htmlspecialchars($review['userID'] ?? 'default') ?>.png" 
                             alt="Profile Picture" 
                             class="review-user-image me-3">
                        <div>
                            <h6 class="card-title mb-1"><?= htmlspecialchars($review['username']) ?> 
                                <small class="text-muted"><?= $review['reviewdate'] ?></small>
                            </h6>
                            <p class="mb-1">⭐ <?= htmlspecialchars($review['rating']) ?>/10</p>
                            <p class="card-text"><?= htmlspecialchars($review['comment']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


<?php displayFooter(); ?>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 bg-white" data-bs-dismiss="modal"></button>
                <img src="" class="modal-image img-fluid w-100" alt="Full size image">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    const modalImage = modal.querySelector('.modal-image');
    
    document.querySelectorAll('.zoom-image').forEach(img => {
        img.addEventListener('click', function() {
            modalImage.src = this.getAttribute('data-fullsize');
        });
    });

    // Add zoom effect to modal image
    modalImage.addEventListener('click', function() {
        this.style.transform = this.style.transform === 'scale(1.5)' ? 'scale(1)' : 'scale(1.5)';
    });
});
</script>

<style>
.modal-image {
    transition: transform 0.3s ease;
    cursor: zoom-in;
}

.zoom-image {
    transition: transform 0.3s ease, filter 0.3s ease;
}

.zoom-image:hover {
    filter: brightness(1.1);
    transform: scale(1.05);
}

/* Your original styles */
.specs-grid {
    display: grid;
    grid-template-columns: max-content 1fr;
    gap: 0.75rem 1.5rem;
    font-size: 1.2rem;  /* Increase font size */
}

.specs-grid strong {
    font-size: 1.2rem;  /* Match the text size */
}

/* Mobile-friendly tweaks ONLY for carousel */
.carousel-custom {
    max-width: 100%;
    height: 0;
    padding-bottom: 100%;
    /* 1:1 aspect ratio for mobile */
    position: relative;
    overflow: hidden;
    background-color: #f8f9fa;
    border-radius: 8px;
    cursor: zoom-in;
}

@media (min-width: 768px) {
    .carousel-custom {
        width: 500px;
        height: 500px;
        padding-bottom: 0;
    }
}

.carousel-inner {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

/* Update carousel image styles for zoom effect */
.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border: 3px solid transparent;
    animation: borderAnimation 2s infinite;
    border-radius: 8px;
    transition: transform 0.3s ease;
    cursor: zoom-in;
}

.carousel-item:hover img {
    transform: scale(1.2);  /* Increased zoom level */
}

/* Slightly larger controls for mobile */
@media (max-width: 767.98px) {

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 2rem;
        height: 2rem;
    }
}

/* Rating stars style */
.rating {
    display: flex;
    flex-direction: row-reverse;
    gap: 0.3rem;
    --rating-stroke: #666;
    --rating-fill: #ffd700; /* Changed from rgb value to hex for consistency */
}

.rating input {
    appearance: unset;
    -webkit-appearance: none;
    -moz-appearance: none;
    margin: 0;
    position: absolute;
    opacity: 0;
}

.rating label {
    cursor: pointer;
    font-size: 3rem;
    color: var(--rating-stroke); /* Using the CSS variable */
    text-shadow: 0 0 1px #666;
    transition: color 0.3s ease, transform 0.3s ease;
}

.rating label:hover,
.rating label:hover ~ label,
.rating input:checked ~ label {
    color: var(--rating-fill); /* Using the CSS variable */
    text-shadow: 0 0 2px #ff9500;
    filter: brightness(1.2);
}

/* Animated border for carousel images */
@keyframes borderAnimation {
    0% {
        border-color: #4285f4;
    }
    33% {
        border-color: #34a853;
    }
    66% {
        border-color: #fbbc05;
    }
    100% {
        border-color: #4285f4;
    }
}

/* Carousel transition animations */
.carousel-item {
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
}

.carousel-item:not(.active) {
    opacity: 0;
    transform: scale(0.98) translateX(10px);
}

.carousel-item.active {
    opacity: 1;
    transform: scale(1) translateX(0);
}

/* Add smooth transition for images */
.carousel-item img {
    transition: transform 0.3s ease;
}

.carousel-item:hover img {
    transform: scale(1.03);
}

/* Rating box with gradient animation */
.reviews-container form,
form.p-4.shadow-lg.rounded {
    background: linear-gradient(135deg, #f2c6de 0%, #f7d9c4 50%, #faedcb 100%);
    background-size: 200% 200%;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(15, 15, 15, 0.1);
    position: relative;
    overflow: hidden;
    animation: gradientShift 3s ease infinite;
    transition: transform 0.3s ease;
    font-size: 1.25rem;
}

/* Search form specific style */
.d-flex.me-3 form {
    background: transparent;
    animation: none;
}

/* Hover effect for scaling */
form:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* User review image styles */
.review-user-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #ddd;
}

/* Custom carousel indicators */
.carousel-indicators [data-bs-target] {
    width: 30px;
    height: 3px;
    border-radius: 0;
    background-color: #cbdef1;
    opacity: 0.5;
    transition: all 0.3s ease;
    margin: 0 3px;
}

.carousel-indicators .active {
    opacity: 1;
    background-color: #cbdef1;
    transform: scaleX(1.2);
}
</style>