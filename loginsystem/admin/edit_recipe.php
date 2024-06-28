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
    exit();
} else {
    if (isset($_GET['id'])) {
        $recipe_id = $_GET['id'];

        // Récupérer les détails de la recette
        $query = "SELECT * FROM recette WHERE id=?";
        $stmt = mysqli_prepare($con, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $recipe_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $recipe = mysqli_fetch_assoc($result);
        } else {
            echo "<script>alert('Erreur de préparation de la requête SQL.');</script>";
            exit();
        }
    }

    if (isset($_POST['submit'])) {
        $recipe_name = $_POST['recipe-name'];
        $recipe_description = $_POST['recipe-description'];
        $recipe_calories = $_POST['recipe-calories'];
        $recipe_carbs = $_POST['recipe-carbs'];
        $recipe_fat = $_POST['recipe-fat'];
        $recipe_protein = $_POST['recipe-protein'];
        $ingredients = $_POST['ingredients'];
        $preparation = $_POST['preparation'];

        // Vérifier si une nouvelle image est téléchargée
        if (!empty($_FILES['photo']['name'])) {
            $recipe_image = $_FILES['photo']['name'];
            $temp_name = $_FILES['photo']['tmp_name'];
            $upload_directory = "../img/";
            move_uploaded_file($temp_name, $upload_directory.$recipe_image);
            $recipe_image_url = $upload_directory.$recipe_image;
        } else {
            // Si aucune nouvelle image n'est téléchargée, utiliser l'URL actuelle
            $recipe_image_url = $recipe['image_url'];
        }

        // Mettre à jour la recette
        $sql = "UPDATE recette SET nom=?, description=?, image_url=?, calories=?, glucides=?, lipides=?, proteines=?, ingredient=?, methode=? WHERE id=?";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssdddsii", $recipe_name, $recipe_description, $recipe_image_url, $recipe_calories, $recipe_carbs, $recipe_fat, $recipe_protein, $ingredients, $preparation, $recipe_id);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "<script>alert('Recette modifiée avec succès.');</script>";
                echo "<script>window.location.href='recette.php';</script>";
                exit();
            } else {
                echo "<script>alert('Erreur lors de la modification de la recette.');</script>";
            }
        } else {
            echo "<script>alert('Erreur de préparation de la requête SQL.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
</head>
<body class="sb-nav-fixed">
<?php include_once('includes/navbar.php'); ?>
<div id="layoutSidenav">
    <?php include_once('includes/sidebar.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Modifier la Recette</h1><hr>
                <div class="card mb-4" style=" background-color: rgba(255, 255, 255, 0.6);">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-3">
                                <label for="recipe-name" class="form-label" style="color: #C71585;">Nom de la recette</label>
                                <input type="text" class="form-control" id="recipe-name" name="recipe-name" value="<?php echo htmlentities($recipe['nom']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="recipe-description" class="form-label">Description</label>
                                <textarea class="form-control" id="recipe-description" name="recipe-description" rows="5" required><?php echo htmlentities($recipe['description']); ?></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="recipe-calories" class="form-label">Calories</label>
                                <input type="number" class="form-control" id="recipe-calories" name="recipe-calories" value="<?php echo htmlentities($recipe['calories']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="recipe-carbs" class="form-label">Glucides (g)</label>
                                <input type="number" class="form-control" id="recipe-carbs" name="recipe-carbs" value="<?php echo htmlentities($recipe['glucides']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="recipe-fat" class="form-label">Lipides (g)</label>
                                <input type="number" class="form-control" id="recipe-fat" name="recipe-fat" value="<?php echo htmlentities($recipe['lipides']); ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="recipe-protein" class="form-label">Protéines (g)</label>
                                <input type="number" class="form-control" id="recipe-protein" name="recipe-protein" value="<?php echo htmlentities($recipe['proteines']); ?>" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="ingredients">Ingrédients (un par ligne)</label>
                                <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required><?php echo htmlentities($recipe['ingredient']); ?></textarea>
                            </div>
                            
                                <div class="form-group mb-3">
                                <label for="preparations">Méthode de préparation</label>
                                <textarea class="form-control" id="preparation" name="preparation" rows="5" required><?php echo htmlentities($recipe['methode']); ?></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="photo" class="form-label">Image</label><br>
                                <img src="images/<?php echo htmlentities($recipe['image_url']); ?>" width="100" height="100" alt="Image actuelle" class="mt-2 border rounded">
                                <label for="photo" class="form-label">[Photos de la recette]</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <button  style="   background: #BDB76B;" type="submit" name="submit" class="btn btn-primary mt-3">Modifier</button>
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
</body>
</html>
