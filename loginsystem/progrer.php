<?php
session_start(); // Démarrer la session

include_once('includes/config.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('Location: logout.php');
    exit();
}

// Vérifier si l'utilisateur a déjà rempli le bilan nutritionnel
$id_utilisateur = $_SESSION['id'];
$query = "SELECT COUNT(*) AS count FROM plans_nutritionnels WHERE id_utilisateur = ?";
$stmt = mysqli_prepare($con, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id_utilisateur);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($count == 0) {
        // Rediriger l'utilisateur vers la page de création du bilan nutritionnel s'il n'a pas encore rempli le bilan
        header('Location: bilan.php');
        exit();
    }
} else {
    die("Erreur de préparation de la requête SQL : " . mysqli_error($con));
}

// Si l'utilisateur a rempli le bilan nutritionnel, récupérer ses progrès
$query_progress = "SELECT date, poids, tour_taille, tour_hanches, tour_poitrine FROM progress WHERE id_utilisateur = ? ORDER BY date DESC";
$stmt_progress = mysqli_prepare($con, $query_progress);
if ($stmt_progress) {
    mysqli_stmt_bind_param($stmt_progress, "i", $id_utilisateur);
    mysqli_stmt_execute($stmt_progress);
    mysqli_stmt_bind_result($stmt_progress, $date, $poids, $tour_taille, $tour_hanches, $tour_poitrine);
    $progress = [];
    while (mysqli_stmt_fetch($stmt_progress)) {
        $progress[] = [
            'date' => $date, 
            'poids' => $poids, 
            'tour_taille' => $tour_taille, 
            'tour_hanches' => $tour_hanches, 
            'tour_poitrine' => $tour_poitrine
        ];
    }
    mysqli_stmt_close($stmt_progress);
} else {
    die("Erreur de préparation de la requête SQL : " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des progrès</title>
    <link href="css/styles.css" rel="stylesheet">
    <style>  
        /* Styles CSS ici */
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <div class="custom-heading">
                        <h1>Liste des Progrès</h1>
                    </div><hr>

                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Poids</th>
                                <th>Tour de Taille</th>
                                <th>Tour de Hanches</th>
                                <th>Tour de Poitrine</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($progress as $entry): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($entry['date']); ?></td>
                                    <td><?php echo htmlspecialchars($entry['poids']); ?> kg</td>
                                    <td><?php echo htmlspecialchars($entry['tour_taille']); ?> cm</td>
                                    <td><?php echo htmlspecialchars($entry['tour_hanches']); ?> cm</td>
                                    <td><?php echo htmlspecialchars($entry['tour_poitrine']); ?> cm</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="custom-button">
                        <a href="add_progress.php" class="btn btn-primary">Ajouter Progrès de la Semaine</a>
                    </div>
                </div>
            </main>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
    <!-- Scripts JS nécessaires -->
</body>
</html>
