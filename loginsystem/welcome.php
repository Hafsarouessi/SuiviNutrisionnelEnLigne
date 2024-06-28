<?php 
session_start();

include_once('includes/config.php');

if (strlen($_SESSION['id'] == 0)) {
    header('location: logout.php');
    exit();
}

$userid = $_SESSION['id'];

// Initialisation de $result
$result = null;

// Requête pour récupérer les informations de l'utilisateur
if ($stmt = $con->prepare("SELECT * FROM users WHERE id = ?")) {
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard | Registration and Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<style>
        /* CSS pour le corps (body) avec une image d'arrière-plan */
        body {
            background-image: url('images/image11.jpg'); /* Chemin vers votre image d'arrière-plan */
            background-size: cover; /* Pour s'assurer que l'image couvre tout l'arrière-plan */
            background-repeat: no-repeat; /* Pour empêcher la répétition de l'image */
            background-attachment: fixed; /* Pour fixer l'image en arrière-plan lorsque l'utilisateur fait défiler */
            background-position: center; /* Positionner l'image au centre */
        }
        </style>
<?php include_once('includes/navbar.php'); ?>
<div id="layoutSidenav">
    <?php include_once('includes/sidebar.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4" style =" font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Dashboard</h1>
                <hr />
                <ol class="breadcrumb mb-4">
                    <li style =" font-weight: bold; " class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="row">
                    <div class="col-xl-5 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body" style ="background-color: #696969;">
                                <?php if ($result): ?>
                                    Welcome Back <?php echo htmlspecialchars($result['fname']) . ' ' . htmlspecialchars($result['lname']); ?>
                                <?php else: ?>
                                    User not found.
                                <?php endif; ?>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between" style ="background-color: #696969;">
                                <a class="small text-white stretched-link" href="profile.php">View Profile</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include('includes/footer.php'); ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
