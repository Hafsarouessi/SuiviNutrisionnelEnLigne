<?php
session_start();
include_once('includes/config.php');

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('location:logout.php');
    exit;
}

if (isset($_POST['submit'])) {
    $id_expediteur = $_SESSION['id'];
    $id_destinataire = $_POST['destinataire'];
    $contenu = $_POST['message'];

    // Enregistrer le message dans la base de données

    $sql = "INSERT INTO messages (id_expediteur, id_destinataire, contenu, type_message) VALUES (?, ?, ?, 'texte')";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $id_expediteur, $id_destinataire, $contenu);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Récupérer les utilisateurs disponibles pour l'envoi de messages
$sql_users = "SELECT * FROM users WHERE id != ?";
$stmt_users = mysqli_prepare($con, $sql_users);
mysqli_stmt_bind_param($stmt_users, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt_users);
$result_users = mysqli_stmt_get_result($stmt_users);
mysqli_stmt_close($stmt_users);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Contact</title>
    <style>
        /* Styles CSS */
    </style>
</head>
<body>
    <h1>Envoyer un message</h1>
    <form method="post">
        <label for="destinataire">Destinataire :</label>
        <select id="destinataire" name="destinataire">
            <?php while ($row = mysqli_fetch_assoc($result_users)) : ?>
                <option value="<?= $row['id_utilisateur'] ?>"><?= $row['nom_utilisateur'] ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label for="message">Message :</label>
        <textarea id="message" name="message" required></textarea>
        <br>
        <button type="submit" name="submit">Envoyer</button>
    </form>
</body>
</html>
