<style> body {
            background-image: url('images/image11.jpg'); /* Chemin vers votre image d'arrière-plan */
            background-size: cover; /* Pour s'assurer que l'image couvre tout l'arrière-plan */
            background-repeat: no-repeat; /* Pour empêcher la répétition de l'image */
            background-attachment: fixed; /* Pour fixer l'image en arrière-plan lorsque l'utilisateur fait défiler */
            background-position: center; /* Positionner l'image au centre */
            padding-top: 56px; /* Ajustement pour le navbar */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.6); /* Couleur de fond semi-transparente pour l'effet de cadre fumé */

            backdrop-filter: blur(10px); /* Flou de l'arrière-plan avec un rayon de 10px */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordure légère */
        }

        .card-body {
            color: #000; /* Couleur du texte */
        }</style><?php
session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
} else {
    $userid = $_GET['uid'];

    // Requête pour récupérer les progrès de l'utilisateur
    $query_progress = mysqli_query($con, "SELECT * FROM progress WHERE id_utilisateur='$userid'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Progress | Registration and Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">User Progress</h1>
                    <hr />
                    <div class="card mb-4" style=" background-color: rgba(255, 255, 255, 0.1);">
                        <div class="card-body">
                            <a href="user-profile.php?uid=<?php echo $userid; ?>" class="btn btn-secondary mb-3">Retour au profil</a>
                            <?php if (mysqli_num_rows($query_progress) > 0) { ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Poids</th>
                                            <th>Tour de taille</th>
                                            <th>Tour de hanches</th>
                                            <th>Tour de poitrine</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($progress_row = mysqli_fetch_assoc($query_progress)) { ?>
                                            <tr>
                                                <td><?php echo $progress_row['date']; ?></td>
                                                <td><?php echo $progress_row['poids']; ?></td>
                                                <td><?php echo $progress_row['tour_taille']; ?></td>
                                                <td><?php echo $progress_row['tour_hanches']; ?></td>
                                                <td><?php echo $progress_row['tour_poitrine']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p>Aucun progrès enregistré pour cet utilisateur.</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('../includes/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>
</html>

<?php } ?>
