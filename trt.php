<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de configuration
include_once('./loginsystem/includes/config.php');

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: ./loginsystem/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_utilisateur = $_SESSION['id'];
    $program = htmlspecialchars($_POST['program']);
    $price = floatval($_POST['price']); // Conversion en float pour le montant

    // Préparation de la requête SQL
    $query = "INSERT INTO paiements (utilisateur_id, programme, montant) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "isd", $id_utilisateur, $program, $price);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
            alert('Paiement effectué avec succès.');
            window.location.href = 'index.php'; // Redirection vers la page d'accueil ou une autre page
          </script>";
            } else {
            echo "<script>alert('Erreur lors du paiement. Veuillez réessayer.');</script>";
        }
        mysqli_stmt_close($stmt);
        exit();
    } else {
        die("Erreur de préparation de la requête SQL : " . mysqli_error($con));
    }
}
?>
