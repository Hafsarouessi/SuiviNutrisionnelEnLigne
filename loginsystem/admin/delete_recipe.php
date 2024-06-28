<?php
session_start();
include_once('../includes/config.php');

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    if (isset($_GET['id'])) {
        $recipe_id = intval($_GET['id']);

        // Vérifiez si la recette existe
        $query = "SELECT * FROM recette WHERE id=?";
        $stmt = mysqli_prepare($con, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $recipe_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $recipe = mysqli_fetch_assoc($result);

            if ($recipe) {
                // Supprimez la recette de la base de données
                $delete_query = "DELETE FROM recette WHERE id=?";
                $delete_stmt = mysqli_prepare($con, $delete_query);
                if ($delete_stmt) {
                    mysqli_stmt_bind_param($delete_stmt, "i", $recipe_id);
                    $delete_result = mysqli_stmt_execute($delete_stmt);
                    if ($delete_result) {
                        echo "<script>alert('Recette supprimée avec succès.');</script>";
                    } else {
                        echo "<script>alert('Erreur lors de la suppression de la recette.');</script>";
                    }
                } else {
                    echo "<script>alert('Erreur de préparation de la requête SQL.');</script>";
                }
            } else {
                echo "<script>alert('La recette n\'existe pas.');</script>";
            }
        } else {
            echo "<script>alert('Erreur de préparation de la requête SQL.');</script>";
        }
    } else {
        echo "<script>alert('ID de recette non spécifié.');</script>";
    }
    echo "<script>window.location.href='recette.php';</script>";
    exit();
}
?>
