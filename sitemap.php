<?php
$pageTitle = "Sitemap - CA Associates";
$pageDescription = "Complete sitemap of CA Associates website with all pages and services.";
include 'includes/header.php';
?>

<div class="container py-5">
    <h1 class="mb-4">Website Sitemap</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Main Pages</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home Page</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="services.php">Our Services</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Legal & Information</h5>
                    <ul class="list-unstyled">
                        <li><a href="terms.php">Terms & Conditions</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                        <li><a href="sitemap.php">Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>