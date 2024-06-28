<?php
session_start();
include_once('includes/config.php');

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('location:logout.php');
    exit;
}

// Récupérer tous les messages
$sql_messages = "SELECT * FROM messages WHERE id_expediteur = ? OR id_destinataire = ?";
$stmt_messages = mysqli_prepare($con, $sql_messages);
mysqli_stmt_bind_param($stmt_messages, "ii", $_SESSION['id'], $_SESSION['id']);
mysqli_stmt_execute($stmt_messages);
$result_messages = mysqli_stmt_get_result($stmt_messages);
mysqli_stmt_close($stmt_messages);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        /* Styles CSS */
    </style>
</head>
<body>
    <h1>Chat</h1>
    <div id="chat-box">
        <?php while ($row = mysqli_fetch_assoc($result_messages)) : ?>
            <!-- Afficher les messages -->
            <?php if ($row['type_message'] == 'texte') : ?>
                <div><?= $row['contenu'] ?></div>
            <?php elseif ($row['type_message'] == 'image') : ?>
                <img src="<?= $row['contenu'] ?>" alt="Image">
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</body>
</html>

