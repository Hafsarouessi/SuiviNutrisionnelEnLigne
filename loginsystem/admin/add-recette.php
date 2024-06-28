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
    </style>  <?php
        session_start();
        include_once('../includes/config.php');

        if (strlen($_SESSION['adminid']) == 0) {
            header('location:logout.php');
            exit(); // Ajoutez un exit() après une redirection pour arrêter l'exécution du script
        } else {
            if (isset($_POST['submit'])) {
                $recipe_name = $_POST['recipe-name'];
                $recipe_description = $_POST['recipe-description'];
                $recipe_image = $_FILES['photo']['name'];
                $temp_name = $_FILES['photo']['tmp_name'];
                $recipe_calories = $_POST['recipe-calories'];
                $recipe_carbs = $_POST['recipe-carbs'];
                $recipe_fat = $_POST['recipe-fat'];
                $recipe_protein = $_POST['recipe-protein'];
                $ingredients = $_POST['ingredients'];
                
                // Déplacer le fichier téléchargé vers l'emplacement souhaité
                $upload_directory = "images/"; // Assurez-vous que ce dossier existe et a les bonnes permissions
                move_uploaded_file($temp_name, $upload_directory.$recipe_image);

                // Utiliser le chemin complet de l'image téléchargée dans la base de données
                $recipe_image_url = $upload_directory.$recipe_image;

                // Exécuter la requête SQL avec le chemin complet de l'image et la méthode de préparation
                $sql = "INSERT INTO recette (nom, description, image_url, calories, glucides, lipides, proteines, ingredient) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssssssss", $recipe_name, $recipe_description, $recipe_image_url, $recipe_calories, $recipe_carbs, $recipe_fat, $recipe_protein, $ingredients);
                    $result = mysqli_stmt_execute($stmt);
                    if ($result) {
                        echo "<script>alert('Nouvelle recette ajoutée avec succès.');</script>";
                        echo "<script type='text/javascript'> document.location = 'recette.php'; </script>";
                        exit();
                    } else {
                        echo "<script>alert('Une erreur s\'est produite lors de l\'ajout de la recette.');</script>";
                    }
                } else {
                    echo "<script>alert('Erreur de préparation de la requête SQL.');</script>";
                }
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
            <title>Admin Dashboard | Registration and Login System </title>
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
            <link href="../css/styles.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        </head>
        <body class="sb-nav-fixed">
        <?php include_once('includes/navbar.php');?>
            <div id="layoutSidenav">
            <?php include_once('includes/sidebar.php');?>
                <div id="layoutSidenav_content">
                    <main>
                    <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 style="color: #C71585;">Ajouter une nouvelle recette</h2><hr>
                    <form id="form-new-recipe" enctype="multipart/form-data" method="POST">
                        <div class="mb-3">
                            <label for="recipe-name" class="form-label">Nom de la recette</label>
                            <input type="text" class="form-control" id="recipe-name" name="recipe-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipe-description" class="form-label">Description</label>
                            <textarea class="form-control" id="recipe-description" name="recipe-description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="preview" class="form-label">L'image</label>
                            <div id="preview" style="width:150px; height :150px; border:1px solid #000;">
                                <img id="image-preview" src="#" alt="[Photo]" style="width:100%; height:100%;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="file" class="form-control" id="photo" name="photo" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="recipe-calories" class="form-label">Calories</label>
                            <input type="number" class="form-control" id="recipe-calories" name="recipe-calories" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipe-carbs" class="form-label">Glucides (g)</label>
                            <input type="number" class="form-control" id="recipe-carbs" name="recipe-carbs" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipe-fat" class="form-label">Lipides (g)</label>
                            <input type="number" class="form-control" id="recipe-fat" name="recipe-fat" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipe-protein" class="form-label">Protéines (g)</label>
                            <input type="number" class="form-control" id="recipe-protein" name="recipe-protein" required>
                        </div>
                        <!-- Champs pour les ingrédients -->
                        <div class="mb-3">
                            <label for="ingredients">Ingrédients (un par ligne)</label>
                            <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required></textarea>
                        </div>
                       
                        <button  style="   background: #BDB76B;" type="submit" name="submit" class="btn btn-primary">Ajouter la recette</button>
                    </form>
                </div>
            </div>
        </div>
                    </main>
                <?php include_once('../includes/footer.php'); ?>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
            <script src="../js/datatables-simple-demo.js"></script>
            <script src="../js/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#photo").change(function(){
                        readURL(this);
                    });
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#image-preview').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]); // Lecture de l'image en tant qu'URL de données
                    }
                }
            </script>
        </body>
        </html>
