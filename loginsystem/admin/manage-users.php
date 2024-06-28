<style>
        /* CSS pour le corps (body) avec une image d'arrière-plan et un effet de flou */
        body {
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
        }
    </style><?php
session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
} else {
    // for deleting user
    if (isset($_GET['id'])) {
        $adminid = $_GET['id'];
        // Commencer une transaction
        mysqli_begin_transaction($con);

        try {
            // Supprimer les enregistrements dans plans_nutritionnels associés à l'utilisateur
            $deletePlans = mysqli_query($con, "DELETE FROM plans_nutritionnels WHERE id_utilisateur='$adminid'");
            if (!$deletePlans) {
                throw new Exception("Erreur lors de la suppression des plans nutritionnels: " . mysqli_error($con));
            }

            // Supprimer les enregistrements dans paiements associés à l'utilisateur
            $deletePayments = mysqli_query($con, "DELETE FROM paiements WHERE utilisateur_id='$adminid'");
            if (!$deletePayments) {
                throw new Exception("Erreur lors de la suppression des paiements: " . mysqli_error($con));
            }

            // Supprimer l'utilisateur
            $deleteUser = mysqli_query($con, "DELETE FROM users WHERE id='$adminid'");
            if (!$deleteUser) {
                throw new Exception("Erreur lors de la suppression de l'utilisateur: " . mysqli_error($con));
            }

            // Valider la transaction
            mysqli_commit($con);
            echo "<script>alert('Données supprimées avec succès');</script>";
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            mysqli_rollback($con);
            echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
        }
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
    <title>Manage Users | Registration and Login System</title>
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
                    <h1 class="mt-4" style="color: #C71585;">Manager les Patients</h1><hr>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php" style="color: #93ddc8;">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manager les Patients</li>
                    </ol>

                    <div class="card mb-4" style=" background-color: rgba(255, 255, 255, 0.6);">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Patients Details
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Programme Suivi</th>
                                        <th>Telephone num.</th>
                                        <th>Date Enrt.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = mysqli_query($con, "SELECT users.id, users.fname, users.lname, users.contactno, users.posting_date, paiements.programme FROM users LEFT JOIN paiements ON users.id = paiements.utilisateur_id");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['fname']; ?></td>
                                            <td><?php echo $row['lname']; ?></td>
                                            <td><?php echo $row['programme']; ?></td>
                                            <td><?php echo $row['contactno']; ?></td>
                                            <td><?php echo $row['posting_date']; ?></td>
                                            <td>
                                                <a style="color: #fd3f92;" href="user-profile.php?uid=<?php echo $row['id']; ?>">
                                                    <i class="fas fa-edit"></i></a>
                                                <a style="color: #fd3f92;" href="manage-users.php?id=<?php echo $row['id']; ?>" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    <?php $cnt = $cnt + 1;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('../includes/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>
<?php } ?>
