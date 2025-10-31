<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'CA Associates - Chartered Accountants'; ?></title>
    <link rel="icon" type="image/x-icon/png" href="assets/images/budget.png">
    <meta name="description" content="<?php echo $pageDescription ?? 'Professional Chartered Accountancy and Tax Consultation Services in Mumbai'; ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 100px 0;
        }
        .service-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
        }
        .whatsapp-float:hover {
            background-color: #128C7E;
        }
    </style>
    
    <!-- Schema Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "CA Associates",
        "description": "Chartered Accountants & Tax Consultants in Mumbai",
        "url": "https://gst-billing-system.free.nf",
        "telephone": "+91-9876543210",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "123 Business Tower",
            "addressLocality": "Mumbai",
            "postalCode": "400001",
            "addressCountry": "IN"
        },
        "areaServed": ["Mumbai", "Thane", "Navi Mumbai"],
        "serviceType": ["Tax Consultation", "GST Filing", "Audit Services", "Company Registration"]
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-balance-scale"></i> CA Associates
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-lock me-1"></i>CA Login</a></li>
                </ul>
            </div>
        </div>
    </nav>