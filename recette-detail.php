<?php
include('./main/header.php');

if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Mettre à jour le nombre de vues de la recette
    $update_views_query = "UPDATE `recette` SET `nombre_vues` = `nombre_vues` + 1 WHERE `id` = ?";
    $stmt = mysqli_prepare($con, $update_views_query);
    mysqli_stmt_bind_param($stmt, "i", $recipe_id);
    mysqli_stmt_execute($stmt);

    // Récupérer les détails de la recette
    $query_recipe = "SELECT *, `nombre_vues` FROM `recette` WHERE `id` = ?";
    $stmt = mysqli_prepare($con, $query_recipe);
    mysqli_stmt_bind_param($stmt, "i", $recipe_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $recette = mysqli_fetch_assoc($result);
} else {
    // Rediriger vers la page d'accueil ou une autre page si l'ID n'est pas spécifié
    header('Location: recette.php');
    exit();
}
?>
<style>
    .news-single .breadcrumbs {
        background-image: url('img/img1.jpeg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 30px;
        overflow: hidden;
    }
</style>

<!-- Breadcrumbs -->
<div class="breadcrumbs overlay" style="background-image: url('img/img1.jpeg');">
    <div class="container">
        <div class="bread-inner">
            <div class="row">
                <div class="col-12">
                    <h2><?php echo htmlentities($recette['nom']); ?></h2>
                    <ul class="bread-list">
                        <li><a href="index.php">Accueil</a></li>
                        <li><i class="icofont-simple-right"></i></li>
                        <li class="active"><?php echo htmlentities($recette['nom']); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Single News -->
<section class="news-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="single-main">
                    <!-- News Head -->
                    <div class="news-head">
                        <img src=".\loginsystem\admin\images\<?php echo htmlentities($recette['image_url']); ?>" alt="Recette">
                    </div>
                    <!-- News Title -->
                    <h1 class="news-title" style="color:#C71585;"><?php echo htmlentities($recette['nom']); ?></h1>
                    <!-- Meta -->
                    
                    <div class="meta">
                        <div class="meta-left">
                            <span class="author"><a href="#"><img src="img/nutritionniste.jpg" alt="#">Meriam berradi</a></span>
                            <span class="date"><i class="fa fa-clock-o"></i><?php echo date("d M, Y", strtotime($recette['date_creation'])); ?></span>
                        </div>
                        <div class="meta-right">
                            <span class="views"><i class="fa fa-eye"></i><?php echo htmlentities($recette['nombre_vues']); ?> Views</span>
                        </div>
                    </div>
                    <h3 style="text-decoration: underline; font-size: 20px; color: #DB7093; font-family: Arial, sans-serif;">Les ingrédients :</h3><br>
                    <div class="news-text">
                        <?php
                        // Séparer le texte des ingrédients par les sauts de ligne
                        $ingredients = explode("\n", $recette['ingredient']);
                        // Parcourir chaque ligne des ingrédients
                        foreach ($ingredients as $ingredient) {
                            // Supprimer les espaces vides en début et fin de ligne
                            $ingredient = trim($ingredient);
                            if (!empty($ingredient)) { // Vérifier si la ligne n'est pas vide
                                // Ajouter une puce ou un tiret à chaque ligne et des espaces
                                echo '<p style="margin-bottom: 10px; margin-left: 25px; font-size: 16px;"><span style="color: #C71585; font-size: 20px;">&bull; </span>' . htmlentities($ingredient) . '</p>';
                            }
                        }
                        ?>
                    </div>
                    <h3 style="text-decoration: underline; font-size: 20px; color: #DB7093; font-family: Arial, sans-serif;">Méthode de préparation :</h3><br>
                    <div class="news-text">
                        <style>
                            /* CSS pour styliser les numéros de la liste ordonnée */
                            .news-text ol {
                                margin-left: 50px; /* Augmenter la marge à gauche pour aligner le texte plus à droite */
                                font-size: 16px;
                                padding-left: 0; /* Enlever le padding par défaut de la liste ordonnée */
                            }
                            .news-text ol li {
                                margin-bottom: 10px;
                                list-style-type: none; /* Enlever les numéros par défaut */
                                counter-increment: list-counter; /* Incrémenter le compteur personnalisé */
                                position: relative; /* Position relative pour placer le numéro personnalisé */
                            }
                            .news-text ol li::before {
                                content: counter(list-counter) ". "; /* Ajouter le numéro personnalisé */
                                color: #C71585; /* Couleur des numéros */
                                position: absolute; /* Positionner le numéro à gauche */
                                left: -19px; /* Ajuster la position du numéro */
                            }
                        </style>
                        <?php
                        // Séparer le texte de la méthode de préparation par les sauts de ligne
                        $method = explode("\n", $recette['methode']);
                        // Utiliser une liste ordonnée pour organiser les étapes
                        echo '<ol>';
                        // Parcourir chaque ligne de la méthode de préparation
                        foreach ($method as $step) {
                            // Supprimer les espaces vides en début et fin de ligne
                            $step = trim($step);
                            if (!empty($step)) { // Vérifier si la ligne n'est pas vide
                                // Ajouter un élément de liste pour chaque étape
                                echo '<li>' . htmlentities($step) . '</li>';
                            }
                        }
                        echo '</ol>';
                        ?>
                    </div>
                    <!-- Valeurs des Nutriments -->
                    <h3 style="text-decoration: underline; font-size: 20px; color:#DB7093; font-family: Arial, sans-serif;">Valeurs des Nutriments: par portion</h3><br>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nutriments</th>
                                <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Protéines</td>
                                <td><?php echo htmlentities($recette['proteines']); ?>g</td>
                            </tr>
                            <tr>
                                <td>Lipides</td>
                                <td><?php echo htmlentities($recette['lipides']); ?>g</td>
                            </tr>
                            <tr>
                                <td>Glucides</td>
                                <td><?php echo htmlentities($recette['glucides']); ?>g</td>
                            </tr>
                            <tr>
                                <td>Calories</td>
                                <td><?php echo htmlentities($recette['calories']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Valeurs des Nutriments -->
                    <div class="blog-bottom">
                        <!-- Social Share -->
                        <ul class="social-share">
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <!-- Next Prev -->
                        <ul class="prev-next">
                            <li class="prev"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                        <!--/ End Next Prev -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="main-sidebar">
                    <!-- Single Widget -->
                    <div class="single-widget search">
                        <div class="form">
                            <input type="email" placeholder="Search Here...">
                            <a class="button" href="#"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <!--/ End Single Widget -->
                    <!-- Single Widget -->
                    <div class="single-widget popular-post">
                    <h3 class="title">Derniers Conseils</h3>
                    <?php
            // Requête pour récupérer les trois derniers conseils
            $query = "SELECT ID, Titre, Description, Image_URL, date_added, nombre_vues FROM conseils ORDER BY date_added DESC LIMIT 3";
            $result = mysqli_query($con, $query);

            // Vérifier s'il y a des résultats
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                        <!-- Single Post -->
                        <div class="single-post">
                            <div class="image">
                            <img src=".\loginsystem\admin\<?php echo $row['Image_URL']; ?>" alt="<?php echo $row['Titre']; ?>">
                            </div>
                            <div class="content">
                            <h5><a href="conseil-detail.php?id=<?php echo $row['ID']; ?>"><?php echo $row['Titre']; ?></a></h5>

                            <ul class="comment">
                                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date("M d, Y", strtotime($row['date_added'])); ?></li>
                                <li><i class="fa fa-eye" aria-hidden="true"></i><?php echo $row['nombre_vues']; ?></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Post -->
                        <?php
                }
            } else {
                echo '<p>Aucun conseil trouvé.</p>';
            }
            ?>
                       
                    <!--/ End Single Widget -->
                   
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('./main/footer.php');
?>
