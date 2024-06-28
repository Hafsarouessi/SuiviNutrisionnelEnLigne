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
        
    </style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Suivi Nutritionnel</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
   
    <style>
        .container {
            margin: 0 auto;
            padding: 20px;
        }
        .container h1 {
            color: #C71585;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        label, select, textarea {
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .result-green {
            color: green;
        }

        .result-red {
            color: red;
        }
        
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php');?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php');?>
        <?php
include_once('includes/config.php');

function calculateBMI($poids, $taille, $sexe) {
    $taille = $taille / 100; // Conversion en mètres
    $bmi = $poids / ($taille * $taille);
    $bmiRounded = number_format($bmi, 2); // Arrondir l'IMC à deux décimales

    // Calcul du poids idéal
    if ($sexe === "homme") {
        $poidsIdeal = ($taille * 100 - 100) * 0.9;
    } else {
        $poidsIdeal = ($taille * 100 - 100) * 0.85;
    }

    // Évaluation de l'état de l'utilisateur en fonction de l'IMC
    if ($bmi < 18.5) {
        $message = "Vous êtes en insuffisance pondérale";
    } else if ($bmi >= 18.5 && $bmi < 25) {
        $message = "Votre poids est normal";
    } else if ($bmi >= 25 && $bmi < 30) {
        $message = "Vous êtes en surpoids";
    } else {
        $message = "Vous êtes obèse";
    }

    // Construction du message à afficher
    $resultMessage = "IMC: $bmiRounded, Poids idéal: " . number_format($poidsIdeal, 2) . " kg, État: $message";

    // Retourner le message
    return $resultMessage;
}

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('location:logout.php');
    exit(); // Arrêter le script
} 

if (isset($_POST['submit'])) {
    $id_utilisateur = $_SESSION['id'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $poids = $_POST['poids'];
    $taille = $_POST['taille'];
    $objectifs = $_POST['objectifs'];
    $restrictions = $_POST['restrictions'];
    $activite = $_POST['activite'];

    // Validation des données (exemple)
    // Vous devriez valider chaque champ ici

    if (!$con) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    $sql = "INSERT INTO plans_nutritionnels (id_utilisateur, age, sexe, poids, taille, objectifs, restrictions_alimentaires, niveau_activite) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iisddsss", $id_utilisateur, $age, $sexe, $poids, $taille, $objectifs, $restrictions, $activite);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            // Affichage d'un message de succès avec le bilan BMI
            $bmiResult = calculateBMI($poids, $taille, $sexe);
            $successMessage = "<div class='result-green'>Nouveau plan nutritionnel créé avec succès. $bmiResult</div>";
        } else {
            $errorMessage = "<div class='result-red'>Erreur : " . mysqli_stmt_error($stmt) . "</div>";
        }
        mysqli_stmt_close($stmt);
    } else {
        $errorMessage = "<div class='result-red'>Erreur de préparation de la requête SQL.</div>";
    }
    mysqli_close($con);
}
?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <h1>Plateforme de Suivi Nutritionnel</h1><hr>
                    <form method="post">
                        <label for="age">Âge:</label>
                        <input type="number" id="age" name="age" required>

                        <label for="sexe">Sexe:</label>
                        <select id="sexe" name="sexe" required>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                        </select>

                        <label for="poids">Poids (kg):</label>
                        <input type="number" id="poids" name="poids" required>

                        <label for="taille">Taille (cm):</label>
                        <input type="number" id="taille" name="taille" required>

                        <label for="objectifs">Objectifs de santé:</label>
                        <textarea id="objectifs" name="objectifs" required></textarea>

                        <label for="restrictions">Restrictions alimentaires:</label>
                        <textarea id="restrictions" name="restrictions"></textarea>

                        <label for="activite">Niveau d'activité physique:</label>
                        <select id="activite" name="activite" required>
                            <option value="sedentaire">Sédentaire</option>
                            <option value="modere">Modéré</option>
                            <option value="actif">Actif</option>
                        </select>

                        <button type="submit" name="submit" style="background: #BDB76B; font-weight: bold;">Créer Plan Nutritionnel</button>
                    </form>
                    <?php
                    if (isset($successMessage)) {
                        echo $successMessage;
                    } elseif (isset($errorMessage)) {
                        echo $errorMessage;
                    }
                    ?>
                </div>
            </main>
            <?php include('includes/footer.php');?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
