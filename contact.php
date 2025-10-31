<?php
$pageTitle = "Contact CA Mumbai | Free Consultation";
$pageDescription = "Contact our Chartered Accountants in Mumbai for GST filing, tax consultation, audit services. Get free expert advice today.";
include 'includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'includes/db.php';
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $service = $_POST['service'];
    $message = $_POST['message'];
    
    // Server-side validation
    $errors = [];
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($mobile) || strlen($mobile) < 10) $errors[] = "Valid mobile number is required";
    if (empty($service)) $errors[] = "Please select a service";
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, mobile, service, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $mobile, $service, $message]);
            $success = "Thank you! Your inquiry has been submitted successfully. We'll contact you within 24 hours.";
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center mb-4">Contact Our CA Experts</h1>
            <p class="text-center lead mb-5">Get professional consultation for all your accounting and tax needs</p>
            
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form method="POST" onsubmit="return validateForm()">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               value="<?php echo $_POST['name'] ?? ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" required
                               value="<?php echo $_POST['email'] ?? ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number *</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" required
                               value="<?php echo $_POST['mobile'] ?? ''; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="service" class="form-label">Service Interested In *</label>
                        <select class="form-select" id="service" name="service" required>
                            <option value="">Select a service</option>
                            <option value="GST Filing" <?php echo ($_POST['service'] ?? '') == 'GST Filing' ? 'selected' : ''; ?>>GST Filing</option>
                            <option value="Tax Consultation" <?php echo ($_POST['service'] ?? '') == 'Tax Consultation' ? 'selected' : ''; ?>>Tax Consultation</option>
                            <option value="Company Registration" <?php echo ($_POST['service'] ?? '') == 'Company Registration' ? 'selected' : ''; ?>>Company Registration</option>
                            <option value="Audit Services" <?php echo ($_POST['service'] ?? '') == 'Audit Services' ? 'selected' : ''; ?>>Audit Services</option>
                            <option value="Accounting" <?php echo ($_POST['service'] ?? '') == 'Accounting' ? 'selected' : ''; ?>>Accounting Services</option>
                            <option value="Other" <?php echo ($_POST['service'] ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" 
                                  placeholder="Tell us about your requirements..."><?php echo $_POST['message'] ?? ''; ?></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Inquiry</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>