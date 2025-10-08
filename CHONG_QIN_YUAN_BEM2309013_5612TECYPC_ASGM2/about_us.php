<?php
require_once("api/oo_master.inc.php");
displayHeader("About Us");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="css/site.css" rel="stylesheet">
<link href="css/aboutus.css" rel="stylesheet">


<div class="container my-5">
    <h2 class="text-center mb-5 display-4 fw-bold">About <span class="text-primary">Yuan Smartphone</span></h2>
    
    <div class="row g-4">
        <!-- Mission Card -->
        <div class="col-lg-4 col-md-6">
            <div class="about-card mission-card h-100 p-4 shadow-sm">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-bullseye feature-icon"></i>
                    <h3 class="mb-0">Our Mission</h3>
                </div>
                <p class="lead">
                    To cut through <span class="text-primary fw-bold">tech overwhelm</span> with honest, 
                    <span class="text-primary fw-bold">human-friendly</span> smartphone insights.
                </p>
                <p>
                    We make every recommendation feel like advice from your most tech-savvy friend, 
                    without the confusing jargon.
                </p>
            </div>
        </div>
        
        <!-- Vision Card -->
        <div class="col-lg-4 col-md-6">
            <div class="about-card vision-card h-100 p-4 shadow-sm">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-eye feature-icon"></i>
                    <h3 class="mb-0">Our Vision</h3>
                </div>
                <p class="lead">
                    To make <span class="text-success fw-bold">choosing your next phone</span> 
                    as effortless and enjoyable as browsing your favorite magazine.
                </p>
                <p>
                    We combine cutting-edge technology with simple, intuitive design to 
                    revolutionize how people discover smartphones.
                </p>
            </div>
        </div>
        
        <!-- Project Card -->
        <div class="col-lg-4 col-md-12">
            <div class="about-card brand-card h-100 p-4 shadow-sm">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-laptop feature-icon"></i>
                    <h3 class="mb-0">The Project</h3>
                </div>
                <p>
                    Developed for <strong>Web Development (5612TECYPC)</strong>, this prototype demonstrates:
                </p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> PHP & JSON data handling</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> File-based storage system</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Bootstrap responsiveness</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> Session-based personalization</li>
                </ul>
            </div>
        </div>
    </div>

<!-- Then modify the Tech Highlights Section -->
<div class="highlight-box mt-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h3 class="text-primary mb-4 tech-excellence">Technical Excellence</h3>
            <p class="lead tech-excellence tech-excellence-delay-1">
                Built with <span class="fw-bold">object-oriented PHP</span> and innovative 
                <span class="fw-bold">file-based architecture</span> that delivers database-like 
                functionality without the complexity.
            </p>
            <p class="tech-excellence tech-excellence-delay-2">
                The project showcases full-stack capabilities including data access layers, 
                responsive design patterns, and secure session management - all while maintaining 
                clean, maintainable code.
            </p>
        </div>
        <div class="col-md-6">
            <img src="image/illuatraction.png" alt="Technology Illustration" class="img-fluid rounded tech-excellence tech-excellence-delay-1" style="max-width: 100%; height: auto;">
        </div>
    </div>
</div>
    
    <!-- Features Grid -->
<div class="row mt-5 g-4">
    <div class="col-md-4">
        <div class="feature-card feature-1 p-4 shadow-sm text-center h-100 feature-delay-1">
            <i class="bi bi-phone text-primary" style="font-size: 2rem;"></i>
            <h4 class="my-3">Smart Comparisons</h4>
            <p>Side-by-side feature analysis that highlights what really matters</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-card feature-2 p-4 shadow-sm text-center h-100 feature-delay-2">
            <i class="bi bi-person-check text-primary" style="font-size: 2rem;"></i>
            <h4 class="my-3">Personalized</h4>
            <p>Recommendations tailored to your preferences and budget</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="feature-card feature-3 p-4 shadow-sm text-center h-100 feature-delay-3">
            <i class="bi bi-device-ssd text-primary" style="font-size: 2rem;"></i>
            <h4 class="my-3">Lightweight</h4>
            <p>File-based system that's fast and efficient</p>
        </div>
    </div>
</div>

<?php displayFooter(); ?>