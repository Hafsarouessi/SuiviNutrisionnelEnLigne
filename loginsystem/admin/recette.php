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
            background-color: rgba(255, 255, 255, 0); /* Couleur de fond semi-transparente pour l'effet de cadre fumé */

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
    exit();
} else {
   
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des Recettes</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Liste des Recettes</h1><hr>
                    
                    <div class="card mb-4" style=" background-color: rgba(255, 255, 255, 0.1); ">
                        <div class="card-body">
                        <a class = "btn btn-success" href = "add-recette.php"><i class = "glyphicon glyphicon-plus"></i> Add Recette</a>
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Calories</th>
                                    <th>Glucides (g)</th>
                                    <th>Lipides (g)</th>
                                    <th>Protéines (g)</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM recette";
                                $result = mysqli_query($con, $query);
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row['nom']); ?></td>
                                        <td><?php echo htmlentities($row['description']); ?></td>
                                        <td><img src="images/<?php echo htmlentities($row['image_url']); ?>" width="100"
                                                 height="100"></td>

                                        <td><?php echo htmlentities($row['calories']); ?></td>
                                        <td><?php echo htmlentities($row['glucides']); ?></td>
                                        <td><?php echo htmlentities($row['lipides']); ?></td>
                                        <td><?php echo htmlentities($row['proteines']); ?></td>
                                       
                                        <td>
                                        <center>
                                            <a  class="btn btn-warning btn-sm d-inline-block" href="edit_recipe.php?id=<?php echo $row['id']; ?>">
                                                <i class="fas fa-edit" ></i> Modifier
                                            </a>
                                            <a  class="btn btn-danger btn-sm d-inline-block" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');" href="delete_recipe.php?id=<?php echo $row['id']; ?>">
                                                <i class="fas fa-trash" ></i> Supprimer
                                            </a>
                                        </center>
                                    </td>                                       
                                    </tr>
                                    <?php $cnt++;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../includes/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    </body>
    </html>
    <?php       } ?>
    