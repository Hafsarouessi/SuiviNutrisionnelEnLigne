<?php 
session_start();
include_once('./loginsystem/includes/config.php');

// Initialisation des variables
$fname = "";
$lname = "";
$image = "";
$role = "user"; // Par défaut, l'utilisateur est considéré comme un utilisateur normal
$username = ""; // Pour stocker le nom d'utilisateur de l'admin
$adminImage = ""; // Pour stocker la photo de profil de l'admin

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    
    // Requête pour récupérer les informations de l'utilisateur en tant qu'utilisateur normal
    if ($stmt = $con->prepare("SELECT id, fname, lname, image FROM users WHERE id = ?")) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($userId, $fname, $lname, $image);
        
        if ($stmt->fetch()) {
            // Utilisateur trouvé dans la table 'users', donc c'est un utilisateur normal
            $role = "user";
        }
        
        $stmt->close();
    }

    // Vérifier si l'utilisateur a des paiements
    $hasPayment = false;
    if ($stmt = $con->prepare("SELECT COUNT(*) FROM paiements WHERE utilisateur_id = ?")) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($count);
        if ($stmt->fetch() && $count > 0) {
            $hasPayment = true;
        }
        $stmt->close();
    }
}

// Vérifier si l'utilisateur est un administrateur
if (isset($_SESSION['adminid'])) {
    $adminId = $_SESSION['adminid'];
    
    // Requête pour récupérer les informations de l'administrateur
    if ($stmt = $con->prepare("SELECT username, photo_profil FROM admin WHERE id = ?")) {
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $stmt->bind_result($username, $photo_profil);
        
        if ($stmt->fetch()) {
            // Administrateur trouvé dans la table 'admin', donc c'est un administrateur
            $role = "admin";
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Weight Loss</title>

    <!-- Favicon -->
    <link rel="icon" href="img/logoDiet.webp">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/bootstrap.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/nice-select.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/font-awesome.min.css">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/icofont.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Slicknav -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/slicknav.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/owl-carousel.css">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/datepicker.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/animate.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/magnific-popup.css">
    <!-- Medipro CSS -->
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/normalize.css">
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/style.css">
    <link rel="stylesheet" href="http://localhost/SuiviNutrisionnel/css/responsive.css">
    

    <link href="http://localhost/SuiviNutrisionnel/templatemo-topic-listing.css" rel="stylesheet">
</head>
<body>

<!-- Preloader -->
<div class="preloader">
    <div class="loader">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>

        <div class="indicator">
            <svg width="16px" height="12px">
                <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
            </svg>
        </div>
    </div>
</div>
<!-- End Preloader -->

<!-- Header Area -->
<header class="header">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    <!-- Contact -->
                    <ul class="top-link">
                        <li><a href="#">A propos</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                    <!-- End Contact -->
                </div>

                <div class="col-lg-6 col-md-7 col-12">
                    <ul class="top-contact">
                        <?php if (isset($_SESSION['id'])): ?>
                            <li>
                                <?php if ($role === 'user'): ?>
                                    <img src="./loginsystem/<?php echo $image; ?>" alt="User Image" style="width: 30px; height: 30px; border-radius: 50%;">
                                    <?php if ($hasPayment): ?>
                                        <span><a href="./loginsystem/welcome.php"><?php echo $fname; ?> <?php echo $lname; ?> &nbsp</a></span>
                                    <?php else: ?>
                                        <span><?php echo $fname; ?> <?php echo $lname; ?> &nbsp</span>
                                    <?php endif; ?>
                                <?php elseif ($role === 'admin'): ?>
                                    <img src="././loginsystem/admin/images/<?php echo $photo_profil; ?>" alt="Admin Image" style="width: 30px; height: 30px; border-radius: 50%;">
                                    <span><a href="././loginsystem/admin/dashboard.php">Meriem berradi&nbsp</a></span>
                                <?php endif; ?>
                                <a href="./loginsystem/logout.php"><i class="fa fa-sign-out" style="color:#C71585;"></i></a>
                            </li>
                        <?php else: ?>
                            <li>
                                <i class="fa fa-user-plus" style="color:#C71585;"></i>
                                <a href="./loginsystem/login.php"> Se connecter &nbsp</a>
                            </li>
                        <?php endif; ?>
                        <li><i class="fa fa-phone" style="color:#C71585;"></i> +212 567 89 &nbsp</li>
                        <li><i class="fa fa-envelope" style="color:#C71585;"></i><a href="mailto:support@yourmail.com">WeightLoss@gmail.com &nbsp</a></li>
                    </ul>
                    <!-- End Top Contact -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-12">
                        <!-- Start Logo -->
                        <div class="logo" style="width: 150px; height: auto;margin-top: -5px;">
                            <a href="index.html"><img src="img/LOGO5.jpg" alt="#"></a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="col-lg-7 col-md-9 col-12">
                        <!-- Main Menu -->
                        <div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <li class="active"><a href="index.php">Accueil <i class="icofont-rounded-down"></i></a></li>
                                    <li><a href="index.php#why-choose">À Propos</a></li>
                                    <li><a href="programme.php">Programme </a></li>
                                    <li><a href="recette.php">Recettes </a></li>
                                    <li><a href="conseil.php">conseils </a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-2 col-12">
                        <?php if (!isset($_SESSION['id'])): ?>
                            <div class="get-quote">
                                <a href="./loginsystem/signup.php" class="btn">Rejoindre WeightLoss</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!-- End Header Area -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://localhost/SuiviNutrisionnel/js/jquery.min.js"></script>
<script src="http://localhost/SuiviNutrisionnel/js/popper.min.js"></script>
<script src="http://localhost/SuiviNutrisionnel/js/bootstrap.min.js"></script>
</body>
</html>
