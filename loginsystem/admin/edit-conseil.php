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

// Vérification de la session adminid
if (empty($_SESSION['adminid'])) {
    header('Location: logout.php');
    exit();
}

// Initialisation des variables pour éviter les avertissements Undefined Index
$id = $titre = $description = $image_url = '';
$paragraphs = [];

// Vérifier si l'ID est défini et valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupérer les données existantes pour l'ID spécifié
    $query = "SELECT `ID`, `Titre`, `Description`, `Image_URL` FROM `conseils` WHERE ID=?";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        // Si la ligne est trouvée, assigner les valeurs aux variables
        if ($row) {
            $titre = $row['Titre'];
            $description = $row['Description'];
            $image_url = $row['Image_URL'];
        } else {
            die("ID de conseil non trouvé.");
        }
    } else {
        die("Erreur de préparation de la requête SQL : " . mysqli_error($con));
    }

    // Récupérer les paragraphes existants pour le conseil
    $paragraphs_query = "SELECT `paragraph_id`, `titre`, `paragraphe` FROM `paragraphs` WHERE `conseil_id`=?";
    $stmt_para = mysqli_prepare($con, $paragraphs_query);
    if ($stmt_para) {
        mysqli_stmt_bind_param($stmt_para, "i", $id);
        mysqli_stmt_execute($stmt_para);
        $result_para = mysqli_stmt_get_result($stmt_para);
        while ($paragraph_row = mysqli_fetch_assoc($result_para)) {
            $paragraphs[] = $paragraph_row;
        }
        mysqli_stmt_close($stmt_para);
    } else {
        die("Erreur de préparation de la requête SQL : " . mysqli_error($con));
    }

    // Traitement du formulaire de mise à jour
    if (isset($_POST['update'])) {
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $image_url = $row['Image_URL']; // Conserver l'URL de l'image existante par défaut

        // Gestion du téléchargement de l'image si une nouvelle image est fournie
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];
            $upload_directory = "images/";
            move_uploaded_file($temp_name, $upload_directory . $image);
            $image_url = $upload_directory . $image;
        }

        // Mettre à jour les données du conseil dans la base de données
        $update_query = "UPDATE `conseils` SET `Titre`=?, `Description`=?, `Image_URL`=? WHERE `ID`=?";
        $stmt_update = mysqli_prepare($con, $update_query);
        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, "sssi", $titre, $description, $image_url, $id);
            if (mysqli_stmt_execute($stmt_update)) {
                // Supprimer les paragraphes existants
                $delete_paragraphs_query = "DELETE FROM `paragraphs` WHERE `conseil_id`=?";
                $stmt_del = mysqli_prepare($con, $delete_paragraphs_query);
                if ($stmt_del) {
                    mysqli_stmt_bind_param($stmt_del, "i", $id);
                    mysqli_stmt_execute($stmt_del);
                    mysqli_stmt_close($stmt_del);
                }

                // Insérer les nouveaux paragraphes
                $titres_paragraphes = isset($_POST['titre_paragraphe']) ? $_POST['titre_paragraphe'] : [];
                $paragraphes = isset($_POST['paragraphe']) ? $_POST['paragraphe'] : [];
                $insert_paragraph_query = "INSERT INTO `paragraphs`(`conseil_id`, `titre`, `paragraphe`) VALUES (?, ?, ?)";
                $stmt_insert_para = mysqli_prepare($con, $insert_paragraph_query);
                if ($stmt_insert_para) {
                    for ($i = 0; $i < count($paragraphes); $i++) {
                        // Vérifier si le paragraphe n'est pas vide
                        if (!empty($paragraphes[$i])) {
                            $titre_paragraphe = !empty($titres_paragraphes[$i]) ? $titres_paragraphes[$i] : null;
                            $paragraphe = $paragraphes[$i];

                            mysqli_stmt_bind_param($stmt_insert_para, "iss", $id, $titre_paragraphe, $paragraphe);
                            mysqli_stmt_execute($stmt_insert_para);
                        }
                    }
                    mysqli_stmt_close($stmt_insert_para);
                }
                
                $_SESSION['success'] = "Conseil mis à jour avec succès";
                header('Location: conseil.php');
                exit();
            } else {
                $error = "Erreur lors de la mise à jour du conseil. Veuillez réessayer.";
            }
            mysqli_stmt_close($stmt_update);
        } else {
            die("Erreur de préparation de la requête SQL : " . mysqli_error($con));
        }
    }
} else {
    header('Location: conseil.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Conseil</title>
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
                <h1 class="mt-4" style="color: #C71585;">Modifier Conseil</h1><hr>
                <div class="card mb-4" style=" background-color: rgba(255, 255, 255, 0.6);">
                    <div class="card-body">
                        <?php if(isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlentities($titre); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlentities($description); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <div id="preview" style="width:150px; height:150px; border:1px solid #000;">
                                    <img id="image-preview" src="<?php echo htmlentities($image_url); ?>" alt="[Photo]" style="width:100%; height:100%;">
                                </div>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <div id="paragraph-fields">
                            <!-- Afficher les détails des paragraphes existants -->
                            <?php foreach ($paragraphs as $index => $paragraph) { ?>
                                <div class="mb-3">
                                    <label for="titre_paragraphe_<?php echo $index; ?>" class="form-label">Titre du paragraphe <?php echo $index + 1; ?></label>
                                    <input type="text" class="form-control" id="titre_paragraphe_<?php echo $index; ?>" name="titre_paragraphe[]" value="<?php echo htmlentities($paragraph['titre']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="paragraphe_<?php echo $index; ?>" class="form-label">Paragraphe <?php echo $index + 1; ?></label>
                                    <textarea class="form-control" id="paragraphe_<?php echo $index; ?>" name="paragraphe[]" rows="5"><?php echo htmlentities($paragraph['paragraphe']); ?></textarea>
                                </div>
                            <?php } ?>
                            </div>
                            <button type="button" id="btn-add-paragraph" class="btn btn-secondary">Ajouter un paragraphe</button>
                            <button style="   background: #BDB76B;" type="submit" class="btn btn-primary" name="update">Mettre à jour</button>
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
<script>
    document.getElementById('image').addEventListener('change', function(){
        const [file] = this.files;
        if (file) {
            document.getElementById('image-preview').src = URL.createObjectURL(file);
        }
    });

    // Script to dynamically add paragraph fields
    document.getElementById('btn-add-paragraph').addEventListener('click', function(){
        var index = document.querySelectorAll('#paragraph-fields .mb-3').length / 2; // Since each paragraph has 2 fields
        var html = '<div class="mb-3">';
        html += '<label for="titre_paragraphe_' + index + '" class="form-label">Titre du paragraphe</label>';
        html += '<input type="text" class="form-control" id="titre_paragraphe_' + index + '" name="titre_paragraphe[]">';
        html += '</div>';
        html += '<div class="mb-3">';
        html += '<label for="paragraphe_' + index + '" class="form-label">Paragraphe</label>';
        html += '<textarea class="form-control" id="paragraphe_' + index + '" name="paragraphe[]" rows="5"></textarea>';
        html += '</div>';
        document.getElementById('paragraph-fields').insertAdjacentHTML('beforeend', html);
    });
</script>
</body>
</html>
