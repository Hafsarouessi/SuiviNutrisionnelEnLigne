<?php
session_start();
include_once('includes/config.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('location: logout.php'); // Rediriger vers la page de déconnexion si l'utilisateur n'est pas connecté
    exit();
}

$userId = $_SESSION['id'];

// Initialisation de $imagePath
$imagePath = ''; 

// Requête pour récupérer l'image de l'utilisateur depuis la base de données
$query = "SELECT `image` FROM `users` WHERE id = ?";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-Tl4Fvg1dKbg3EjNHETD5h2Q9M7FDJg6pibxr2GDZuN3WqETN04sWckd/ArTJOGWkw6nsWfFNMCjJJegpv0ykRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    .user-avatar {
        width: 40px; /* Taille de l'image */
        height: 40px;
        border-radius: 50%; /* Pour la forme circulaire */
        object-fit: cover; /* Redimensionner l'image pour qu'elle remplisse le cercle */
        margin-right: 10px; /* Espacement à droite */
        border: 2px solid #fff; /* Bordure blanche autour de l'image */
        margin-left: 10px; /* Déplace l'image vers la droite */
    }
</style>

</head>
<body>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Afficher l'image de profil -->
    <?php if (!empty($imagePath)) : ?>
        <img src="<?php echo $imagePath; ?>" alt="User Photo" class="user-avatar">
      <?php endif; ?>

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">User Page</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="Sidebar.php"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
         &nbsp;
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../">Accueil</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="./logout.php">Se déconnecter</a></li>
            </ul>
        </li>
    </ul>
</nav>

</body>
</html>
