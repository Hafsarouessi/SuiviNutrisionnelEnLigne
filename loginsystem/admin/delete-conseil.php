<?php
session_start();
include_once('../includes/config.php');

// Vérification de la session adminid
if (empty($_SESSION['adminid'])) {
    header('Location: logout.php');
    exit();
} else {
    // Vérification de l'existence de l'ID du conseil dans l'URL
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header('Location: conseil.php');
        exit();
    }

    // Récupération de l'ID du conseil depuis l'URL
    $conseil_id = $_GET['id'];

    // Suppression des paragraphes associés au conseil
    $sql_delete_paragraphs = "DELETE FROM paragraphs WHERE conseil_id=?";
    $stmt_delete_paragraphs = mysqli_prepare($con, $sql_delete_paragraphs);
    if ($stmt_delete_paragraphs) {
        mysqli_stmt_bind_param($stmt_delete_paragraphs, "i", $conseil_id);
        $result_delete_paragraphs = mysqli_stmt_execute($stmt_delete_paragraphs);
        if (!$result_delete_paragraphs) {
            echo "<script>alert('Erreur lors de la suppression des paragraphes.');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Erreur de préparation de la requête SQL pour la suppression des paragraphes.');</script>";
        exit();
    }

    // Suppression du conseil
    $sql_delete_conseil = "DELETE FROM conseils WHERE id=?";
    $stmt_delete_conseil = mysqli_prepare($con, $sql_delete_conseil);
    if ($stmt_delete_conseil) {
        mysqli_stmt_bind_param($stmt_delete_conseil, "i", $conseil_id);
        $result_delete_conseil = mysqli_stmt_execute($stmt_delete_conseil);
        if ($result_delete_conseil) {
            echo "<script>alert('Conseil supprimé avec succès.');</script>";
            echo "<script>window.location.href='conseil.php';</script>";
            exit();
        } else {
            echo "<script>alert('Erreur lors de la suppression du conseil.');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Erreur de préparation de la requête SQL pour la suppression du conseil.');</script>";
        exit();
    }
}
?>
