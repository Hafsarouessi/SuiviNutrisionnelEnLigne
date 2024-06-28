
<?php
include('./main/header.php');


if (isset($_GET['id'])) {
    $conseil_id = $_GET['id'];
    $update_views_query = "UPDATE `conseils` SET `nombre_vues` = `nombre_vues` + 1 WHERE `id` = $conseil_id";
     mysqli_query($con, $update_views_query);
     $query_conseil = "SELECT *, `nombre_vues` FROM conseils WHERE id = $conseil_id";
     $result_conseil = mysqli_query($con, $query_conseil);
     $conseil = mysqli_fetch_assoc($result_conseil);
    
    // Récupérer les informations du conseil
    $query_conseil = "SELECT * FROM conseils WHERE id = $conseil_id";
    $result_conseil = mysqli_query($con, $query_conseil);
    $conseil = mysqli_fetch_assoc($result_conseil);
    
    // Récupérer les paragraphes associés au conseil
    $query_paragraphs = "SELECT `paragraph_id`, `conseil_id`, `titre`, `paragraphe` FROM `paragraphs` WHERE `conseil_id` = $conseil_id";
    $result_paragraphs = mysqli_query($con, $query_paragraphs);
    
    $paragraphs = [];
    while ($row = mysqli_fetch_assoc($result_paragraphs)) {
        $paragraphs[] = $row;
    }
} else {
    header('Location: conseils.php');
    exit();
}

?>
   
		
		
		<!-- Titre de la page -->
        <div class="breadcrumbs overlay" style="background-image: url('img/img1.jpeg');">
    <div class="container">
        <div class="bread-inner">
            <div class="row">
                <div class="col-12">
                    <h2>conseils</h2>
                    <ul class="bread-list">
                        <li><a href="index.php">Accueil</a></li>
                        <li><i class="icofont-simple-right"></i></li>
                        <li class="active"><?php echo $conseil['Titre']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
		<!-- End Titre de la page -->
		
		<!-- Single News -->
		<section class="news-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="row">
							<div class="col-12">
								<div class="single-main">
									<!-- News Head -->
									<div class="news-head">
									
									
                                      <img  class="conseil-image" src=".\loginsystem\admin\<?php echo $conseil['Image_URL']; ?>" alt="Conseil">
                                    </div>
									<!-- News Title -->
                                    <h3 style=" color: #C71585;"class="news-title"><?php echo $conseil['Titre']; ?></h3>
									<!-- Meta -->
									<div class="meta">
                                    <div class="meta-left">
											<span class="author"><a href="#"><img src="img/nutritionniste.jpg" alt="#">Meriam berradi</a></span>
                                            <span class="date"><i class="fa fa-clock-o"></i><?php echo date("d M, Y", strtotime($conseil['date_added'])); ?></span>
										</div>
										<div class="meta-right">
											<span class="comments"><a href="#"><i class="fa fa-comments"></i>05 Comments</a></span>
                                            <span class="views"><i class="fa fa-eye"></i><?php echo $conseil['nombre_vues']; ?> Views</span>
										</div>
									</div>
                                    <div class="news-text">
                        <?php
                        // Parcourir chaque paragraphe
                        foreach ($paragraphs as $paragraph) {
                            $titre = trim($paragraph['titre']);
                            $paragraphe = trim($paragraph['paragraphe']);
                            if (!empty($titre)) {
                                echo '<h3 style=" text-decoration: underline; font-size: 20px; color: #DB7093; font-family: Arial, sans-serif; text-shadow: 2px 4px 3px rgba(0,0,0,0.3);"><span style="color: #DB7093; font-size: 20px;">&bull; </span>' . $titre . '</h3><br>';

                                echo '<p>' . $paragraphe . '</p>';
                            } else {
                                echo '<blockquote class="overlay"><p>' . $paragraphe . '</p></blockquote>';
                            }
                        }
                        ?>
                    </div>
									<!-- News Text -->
									
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
							

							<div class="single-widget recent-post">
    <h3 class="title">Recent post</h3>
    
    <?php
    // Requête pour récupérer les trois dernières recettes
    $query_recettes = "SELECT id, nom, image_url, date_creation , nombre_vues FROM recette ORDER BY date_creation DESC LIMIT 3";
    $result_recettes = mysqli_query($con, $query_recettes);
    
    // Vérifier si des recettes ont été trouvées
    if (mysqli_num_rows($result_recettes) > 0) {
        // Afficher chaque recette
        while ($recette = mysqli_fetch_assoc($result_recettes)) {
            ?>
           <div class="single-post">
    <div class="image">
        <img src=".\loginsystem\admin\images\<?php echo $recette['image_url']; ?>" alt="<?php echo $recette['nom']; ?>">
    </div>
    <div class="content">
        <h5><a href="recette-detail.php?id=<?php echo $recette['id']; ?>"><?php echo $recette['nom']; ?></a></h5>
        <ul class="comment">
            <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date("M d, Y", strtotime($recette['date_creation'])); ?> | </li>
            <li><i class="fa fa-eye" aria-hidden="true"></i><?php echo $recette['nombre_vues']; ?> vues</li>
        </ul>
    </div>
</div>

            <!-- End Single Post -->
            <?php
        }
    } else {
        echo "<p>Aucune recette trouvée.</p>";
    }
    ?>
</div>

							<!-- Single Widget -->
							<!--/ End Single Widget -->
							<!-- Single Widget -->
<div class="single-widget side-tags">
    <h3 class="title">Tags</h3>
    <ul class="tag">
        <li><a href="#">nutrition</a></li>
        <li><a href="#">bien-être</a></li>
        <li><a href="#">exercice</a></li>
        <li><a href="#">santé mentale</a></li>
        <li><a href="#">alimentation équilibrée</a></li>
        <li><a href="#">conseils de santé</a></li>
        <!-- Ajoutez d'autres tags pertinents ici -->
    </ul>
</div>
<!--/ End Single Widget -->

						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Single News -->
		
		<?php
include('./main/footer.php');
?>