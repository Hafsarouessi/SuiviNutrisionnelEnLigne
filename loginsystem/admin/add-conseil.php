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
    if (isset($_POST['submit'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $upload_directory = "images/";
        move_uploaded_file($temp_name, $upload_directory.$image);

        $image_url = $upload_directory.$image;

        $sql = "INSERT INTO conseils (titre, description, image_url, date_added) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $titre, $description, $image_url);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $conseil_id = mysqli_insert_id($con);

                $titres_paragraphes = isset($_POST['titre_paragraphe']) ? $_POST['titre_paragraphe'] : array();
                $paragraphes = isset($_POST['paragraphe']) ? $_POST['paragraphe'] : array();

                for ($i = 0; $i < count($titres_paragraphes); $i++) {
                    if (!empty($titres_paragraphes[$i]) && !empty($paragraphes[$i])) {
                        $titre_paragraphe = $titres_paragraphes[$i];
                        $paragraphe = $paragraphes[$i];

                        $sql_paragraphe = "INSERT INTO `paragraphs`(`conseil_id`, `titre`, `paragraphe`) VALUES (?, ?, ?)";
                        $stmt_paragraphe = mysqli_prepare($con, $sql_paragraphe);
                        if ($stmt_paragraphe) {
                            mysqli_stmt_bind_param($stmt_paragraphe, "iss", $conseil_id, $titre_paragraphe, $paragraphe);
                            $result_paragraphe = mysqli_stmt_execute($stmt_paragraphe);
                            if (!$result_paragraphe) {
                                echo "<script>alert('Erreur lors de l\'ajout d\'un paragraphe : " . mysqli_error($con) . "');</script>";
                                exit();
                            }
                        } else {
                            echo "<script>alert('Erreur lors de la préparation de la requête SQL pour le paragraphe : " . mysqli_error($con) . "');</script>";
                            exit();
                        }
                    }
                }

                echo "<script>alert('Nouveau conseil ajouté avec succès avec ses paragraphes.');</script>";
                echo "<script type='text/javascript'> document.location = 'conseil.php'; </script>";
                exit();
            } else {
                echo "<script>alert('Une erreur s\'est produite lors de l\'ajout du conseil : " . mysqli_error($con) . "');</script>";
            }
        } else {
            echo "<script>alert('Erreur de préparation de la requête SQL pour le conseil : " . mysqli_error($con) . "');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau conseil</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="../../img/logoDiet.webp">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                            <h2 class="card-title" style="color: #C71585;">Ajouter un nouveau conseil</h2>
                            <hr>
                            <form id="form-new-conseil" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre du conseil:</label>
                                    <input type="text" class="form-control" id="titre" name="titre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description du conseil:</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image:</label>
                                    <div id="preview" style="width:150px; height :150px; border:1px solid #000;">
                                        <img id="image-preview" src="#" alt="[Photo]" style="width:100%; height:100%;">
                                    </div>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>
                                <div id="paragraph-fields">
                                    <!-- Champs de paragraphe ajoutés dynamiquement -->
                                </div>
                                <button type="button" id="btn-add-paragraph" class="btn btn-secondary">Ajouter un paragraphe</button>
                                <button  style="   background: #BDB76B;" type="submit" name="submit" class="btn btn-primary">Ajouter le conseil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once('../includes/footer.php'); ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            // Compteur de paragraphes ajoutés
            var counter = 1;

            // Gestion de l'événement de clic sur le bouton "Ajouter un paragraphe"
            $('#btn-add-paragraph').click(function() {
                // Génération dynamique des champs de paragraphe
                var html = '<div class="mb-3">';
                html += '<label for="titre_paragraphe_' + counter + '" class="form-label">Titre du paragraphe:</label>';
                html += '<input type="text" class="form-control" id="titre_paragraphe_' + counter + '" name="titre_paragraphe[]">';
                html += '</div>';
                html += '<div class="mb-3">';
                html += '<label for="paragraphe_' + counter + '" class="form-label">Paragraphe:</label>';
                html += '<textarea class="form-control" id="paragraphe_' + counter + '" name="paragraphe[]" rows="3"></textarea>';
                html += '</div>';

                // Ajout des champs de paragraphe au formulaire
                $('#paragraph-fields').append(html);

                // Incrémenter le compteur
                counter++;
            });

            // Gestion de la prévisualisation de l'image
            $("#image").change(function(){
                readURL(this);
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
        });
    </script>
</body>
</html>
