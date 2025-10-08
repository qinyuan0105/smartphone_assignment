<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('api/oo_master.inc.php');

// Check if displayHeader function exists before calling it
if (function_exists('displayHeader')) {
    displayHeader("Privacy Policy");
} else {
    echo "<h1>Privacy Policy</h1>";
}
?>

<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <noscript>
                <p style="color: red;">JavaScript is disabled or not working. Please enable JavaScript to view the content properly.</p>
            </noscript>
            <h1 class="mb-4 text-primary">Privacy Policy</h1>
            
            <section class="mb-4">
                <h2 class="text-custom">Information We Collect</h2>
                <p class="text-secondary">We collect information that you provide directly to us, including:</p>
                <ul class="text-secondary">
                    <li>Name and username</li>
                    <li>Email address</li>
                    <li>Profile picture</li>
                    <li>Favorite smartphone selections</li>
                </ul>
            </section>

            <section class="mb-4">
                <h2 class="text-custom">How We Use Your Information</h2>
                <p class="text-secondary">We use the information we collect to:</p>
                <ul class="text-secondary">
                    <li>Provide, maintain, and improve our services</li>
                    <li>Process your favorite selections</li>
                    <li>Send you technical notices and support messages</li>
                    <li>Respond to your comments and questions</li>
                </ul>
            </section>

            <section class="mb-4">
                <h2 class="text-custom">Information Security</h2>
                <p class="text-secondary">We implement appropriate security measures to protect your personal information, including:</p>
                <ul class="text-secondary">
                    <li>Password encryption</li>
                    <li>Secure storage of user data</li>
                    <li>Regular security updates</li>
                </ul>
            </section>

            <section class="mb-4">
                <h2 class="text-custom">Updates to This Policy</h2>
                <p class="text-secondary">We may update this privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page.</p>
            </section>

            <section class="mb-4">
                <h2 class="text-custom">Contact Us</h2>
                <p class="text-secondary">If you have any questions about this privacy policy, please contact us at:</p>
                <p class="text-info">Email: chong.qinyuan@ypccollege.edu.my<br>
                Phone: +60 12-345 6789</p>
            </section>
        </div>
    </div>
</div>

<?php
// Check if displayFooter function exists before calling it
if (function_exists('displayFooter')) {
    displayFooter();
} else {
    echo "<footer>Footer content goes here.</footer>";
}
?>
