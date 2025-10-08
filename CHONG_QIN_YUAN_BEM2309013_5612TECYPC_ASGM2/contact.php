<?php
require_once('api/oo_master.inc.php');
displayHeader("Contact Us");
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-custom text-white">
                    <h1 class="h3 mb-0">Contact Us</h1>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 contact-info">
                            <h4 class="info-label"><i class="fas fa-map-marker-alt me-2"></i>Our Location</h4>
                            <p class="info-text">123 Jalan Yuan<br>Kuala Lumpur, 50000<br>Malaysia</p>
                            
                            <h4 class="info-label"><i class="fas fa-phone me-2"></i>Phone</h4>
                            <p class="info-text">+60 12-345 6789</p>
                            
                            <h4 class="info-label"><i class="fas fa-envelope me-2"></i>Email</h4>
                            <p class="info-text">chong.qinyuan@ypccollege.edu.my</p>
                        </div>
                        <div class="col-md-6">
                            <form id="contactForm" action="process_contact.php" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
displayFooter();
?>
