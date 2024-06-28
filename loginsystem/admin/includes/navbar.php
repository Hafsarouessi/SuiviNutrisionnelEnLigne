<?php

$sql = "SELECT photo_profil FROM admin ";
$result = mysqli_query($con, $sql);

// Vérifier s'il y a une correspondance
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $photo_profil = $row['photo_profil'];
} 
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="dashboard.php">Nutritionniste Page</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            &nbsp;
        </div>
    </form>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-5 my-5 my-md-0" method="post" action="search-result.php">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search User by name , email and contact number" title="Search User by name , email and contact number" aria-describedby="btnNavbarSearch" name="searchkey" />
            <button  style="   background: #C71585;" class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images\<?php echo $photo_profil; ?>" alt="Photo de profil" class="rounded-circle" style="width: 30px; height: 30px;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../../">Accueil</a></li>
                <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
