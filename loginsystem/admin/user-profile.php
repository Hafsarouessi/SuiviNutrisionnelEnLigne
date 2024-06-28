
<style>
    /* Styles pour le fond d'écran et le contenu */
    body {
        background-image: url('images/image11.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Assurez-vous que l'image reste fixe lors du défilement */
        font-family: Arial, sans-serif; /* Exemple de police */
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    /* Styles pour le contenu de la page */
    .card {
        background: #fff;
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
    }

    table.table {
        margin-top: 20px;
    }

    table.table th {
        width: 30%;
        background-color: #f0f0f0;
        text-align: left;
        padding: 10px;
    }

    table.table td {
        padding: 10px;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
    .card {
    background: #fff;
    border: none;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    position: relative; /* Permet de positionner le bouton à l'intérieur de la carte */
}
.card-body a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    margin-left: 10px;
}

.card-body a:hover {
    text-decoration: underline;
}
.card {
            background-color: rgba(255, 255, 255, 0.6); /* Couleur de fond semi-transparente pour l'effet de cadre fumé */

            backdrop-filter: blur(10px); /* Flou de l'arrière-plan avec un rayon de 10px */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordure légère */
        }

        .card-body {
            color: #000; /* Couleur du texte */
        }

</style>
<?php
session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
} else {
    $userid = $_GET['uid'];

    // Requête pour récupérer les détails de l'utilisateur
    $query_user = mysqli_query($con, "SELECT * FROM users WHERE id='$userid'");
    $user_data = mysqli_fetch_assoc($query_user);

    // Requête pour récupérer les détails du plan nutritionnel
    $query_plan = mysqli_query($con, "SELECT * FROM plans_nutritionnels WHERE id_utilisateur='$userid'");
    $plan_data = mysqli_fetch_assoc($query_plan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User Profile | Registration and Login System</title>
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
                    
                    <h1 class="mt-4" style="color: #C71585; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);"><?php echo $user_data['fname']; ?>'s Profile</h1>
                    <hr />
                    <div class="card mb-4" style=" background-color: rgba(255, 255, 255, 0.6);">
                        <div class="card-body">
                        <a href="edit-profile.php?uid=<?php echo $user_data['id']; ?>" style="color: #BDB76B; font-weight: bold;">Edit</a>
                        <a href="user-progress.php?uid=<?php echo $user_data['id']; ?>" class="btn btn-primary" style="   background: #BDB76B;">Voir le progrès</a>
                             <table class="table table-bordered">
                                <tr>
                                    <th>Prénom</th>
                                    <td><?php echo $user_data['fname']; ?></td>
                                </tr>
                                <tr>
                                    <th>Nom</th>
                                    <td><?php echo $user_data['lname']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td colspan="3"><?php echo $user_data['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Téléphone</th>
                                    <td colspan="3"><?php echo $user_data['contactno']; ?></td>
                                </tr>
                                <tr>
                                    <th>Date enregistrement</th>
                                    <td colspan="3"><?php echo $user_data['posting_date']; ?></td>
                                </tr>
                                <!-- Vérifier si les données du plan nutritionnel existent avant de les afficher -->
                                <?php if ($plan_data && isset($plan_data['age'])) { ?>
                                    <tr>
                                        <th>Age</th>
                                        <td><?php echo $plan_data['age']; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($plan_data && isset($plan_data['sexe'])) { ?>
                                    <tr>
                                        <th>Sexe</th>
                                        <td><?php echo $plan_data['sexe']; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($plan_data && isset($plan_data['poids'])) { ?>
                                    <tr>
                                        <th>Poids</th>
                                        <td><?php echo $plan_data['poids']; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($plan_data && isset($plan_data['taille'])) { ?>
                                    <tr>
                                        <th>Taille</th>
                                        <td><?php echo $plan_data['taille']; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($plan_data && isset($plan_data['objectifs'])) { ?>
                                    <tr>
                                        <th>Objectifs</th>
                                        <td><?php echo $plan_data['objectifs']; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php if ($plan_data && isset($plan_data['restrictions_alimentaires'])) { ?>
                                    <tr>
                                        <th>Restrictions alimentaires</th>
                                        <td><?php echo $plan_data['restrictions_alimentaires']; ?></td>
                                    </tr>
                                <?php } ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
</body>
</html>

<?php } ?>
