<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['ca_logged_in']) || $_SESSION['ca_logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}

// Include database connection
include '../includes/db.php';

// Handle inquiry deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM inquiries WHERE id = ?");
    $stmt->execute([$delete_id]);
    $success = "Inquiry deleted successfully!";
}

// Handle status update
if (isset($_GET['update_status'])) {
    $inquiry_id = $_GET['id'];
    $new_status = $_GET['update_status'];
    $stmt = $pdo->prepare("UPDATE inquiries SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $inquiry_id]);
    $success = "Status updated successfully!";
}

// Get all inquiries
$stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Statistics
$total_inquiries = count($inquiries);
$new_inquiries = 0;
$contacted_inquiries = 0;
foreach ($inquiries as $inquiry) {
    if ($inquiry['status'] === 'new') $new_inquiries++;
    if ($inquiry['status'] === 'contacted') $contacted_inquiries++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CA Admin - Client Inquiries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            background: #1e3c72;
            color: white;
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover {
            background: #2a5298;
        }
        .sidebar .nav-link.active {
            background: #2a5298;
            font-weight: bold;
        }
        .status-new { background-color: #e3f2fd; }
        .status-contacted { background-color: #e8f5e8; }
        .status-completed { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center p-3">
                        <h5><i class="fas fa-balance-scale"></i> CA Admin</h5>
                        <small>Chartered Accountants</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="inquiries.php">
                                <i class="fas fa-inbox me-2"></i>Client Inquiries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-2"></i>Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link text-warning" href="../logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Client Inquiries</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <span class="me-3 text-muted">Welcome, <?php echo $_SESSION['username']; ?></span>
                        <a href="../logout.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </div>
                </div>

                <?php if (isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $total_inquiries; ?></h4>
                                        <p>Total Inquiries</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-inbox fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $new_inquiries; ?></h4>
                                        <p>New Inquiries</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo $contacted_inquiries; ?></h4>
                                        <p>Contacted</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-check fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><?php echo date('M d, Y'); ?></h4>
                                        <p>Today's Date</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-calendar fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inquiries Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>All Client Inquiries
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($inquiries)): ?>
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5>No inquiries yet</h5>
                                <p class="text-muted">Client inquiries will appear here when they submit the contact form.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Service</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($inquiries as $inquiry): ?>
                                            <tr class="status-<?php echo $inquiry['status'] ?? 'new'; ?>">
                                                <td><?php echo $inquiry['id']; ?></td>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($inquiry['name']); ?></strong>
                                                </td>
                                                <td>
                                                    <div><i class="fas fa-envelope me-1"></i><?php echo htmlspecialchars($inquiry['email']); ?></div>
                                                    <div><i class="fas fa-phone me-1"></i><?php echo htmlspecialchars($inquiry['mobile']); ?></div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary"><?php echo htmlspecialchars($inquiry['service']); ?></span>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $message = htmlspecialchars($inquiry['message']);
                                                    echo strlen($message) > 50 ? substr($message, 0, 50) . '...' : $message;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo date('M d, Y', strtotime($inquiry['created_at'])); ?>
                                                    <br><small class="text-muted"><?php echo date('h:i A', strtotime($inquiry['created_at'])); ?></small>
                                                </td>
                                                <td>
                                                    <?php 
                                                    $status = $inquiry['status'] ?? 'new';
                                                    $statusColors = [
                                                        'new' => 'warning',
                                                        'contacted' => 'success', 
                                                        'completed' => 'secondary'
                                                    ];
                                                    $color = $statusColors[$status] ?? 'secondary';
                                                    ?>
                                                    <span class="badge bg-<?php echo $color; ?>">
                                                        <?php echo ucfirst($status); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <!-- Status Update Dropdown -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                <i class="fas fa-cog"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="?update_status=new&id=<?php echo $inquiry['id']; ?>">Mark as New</a></li>
                                                                <li><a class="dropdown-item" href="?update_status=contacted&id=<?php echo $inquiry['id']; ?>">Mark as Contacted</a></li>
                                                                <li><a class="dropdown-item" href="?update_status=completed&id=<?php echo $inquiry['id']; ?>">Mark as Completed</a></li>
                                                            </ul>
                                                        </div>
                                                        
                                                        <!-- View Details -->
                                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $inquiry['id']; ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        
                                                        <!-- Delete -->
                                                        <a href="?delete_id=<?php echo $inquiry['id']; ?>" class="btn btn-outline-danger" 
                                                           onclick="return confirm('Are you sure you want to delete this inquiry?')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>

                                                    <!-- View Modal -->
                                                    <div class="modal fade" id="viewModal<?php echo $inquiry['id']; ?>" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Inquiry Details #<?php echo $inquiry['id']; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-6">
                                                                            <strong>Name:</strong><br>
                                                                            <?php echo htmlspecialchars($inquiry['name']); ?>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <strong>Service:</strong><br>
                                                                            <span class="badge bg-primary"><?php echo htmlspecialchars($inquiry['service']); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-6">
                                                                            <strong>Email:</strong><br>
                                                                            <?php echo htmlspecialchars($inquiry['email']); ?>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <strong>Mobile:</strong><br>
                                                                            <?php echo htmlspecialchars($inquiry['mobile']); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <strong>Message:</strong><br>
                                                                        <?php echo nl2br(htmlspecialchars($inquiry['message'])); ?>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <strong>Submitted:</strong><br>
                                                                        <?php echo date('F j, Y \a\t h:i A', strtotime($inquiry['created_at'])); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>" class="btn btn-primary">
                                                                        <i class="fas fa-envelope me-1"></i>Reply via Email
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>