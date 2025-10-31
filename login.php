<?php
session_start();
$pageTitle = "CA Login | Admin Panel";
$pageDescription = "Secure login for CA Associates admin panel to manage client inquiries and services.";
include 'includes/header.php';

// Redirect if already logged in
if (isset($_SESSION['ca_logged_in']) && $_SESSION['ca_logged_in'] === true) {
    header('Location: admin/inquiries.php');
    exit;
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Simple hardcoded credentials (in real app, use database with hashed passwords)
    $valid_username = 'caadmin';
    $valid_password = 'ca@2024';
    
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['ca_logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['login_time'] = time();
        
        header('Location: admin/inquiries.php');
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                        <h3>CA Admin Login</h3>
                        <p class="text-muted">Access your client inquiries dashboard</p>
                    </div>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?php echo $_POST['username'] ?? ''; ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            For demo use: username: <strong>caadmin</strong> / password: <strong>ca@2024</strong>
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="index.php" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-2"></i>Back to Website
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>