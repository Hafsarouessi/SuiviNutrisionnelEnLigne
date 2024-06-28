<?php
include('./main/header.php');

include('loginsystem/includes/config.php');

// Vérifier si le formulaire de recherche a été soumis
if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Requête pour rechercher dans la base de données
    $query = "SELECT * FROM recette WHERE nom LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    $result = mysqli_query($con, $query);
} else {
    // Si aucun mot-clé n'est spécifié, afficher toutes les recettes
    $query = "SELECT * FROM recette";
    $result = mysqli_query($con, $query);
}
?>
<style>/* styles.css */
.single-news {
    margin-bottom: 30px;
    overflow: hidden;
    border: 1px solid #e6e6e6;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.single-news .news-head img {
    width: 100%;
    height: 200px; /* Fixed height */
    object-fit: cover; /* Ensure the image covers the entire area */
}



.single-news .news-content .date {
    font-size: 14px;
    color: #999;
    margin-bottom: 10px;
}

.single-news .news-content h2 {
    font-size: 22px;
    margin-bottom: 15px;
}

.single-news .news-content .text {
    font-size: 16px;
    color: #333;

}


</style>
<!-- Breadcrumbs -->
<div class="breadcrumbs overlay" style="background-image: url('img/img1.jpeg');">
			<div class="container">
				<div class="bread-inner">
					<div class="row">
						<div class="col-12">
							<h2>Recette </h2>
							<ul class="bread-list">
								<li><a href="accueil.html">Accueil</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Chercher des Recette  </li>
							</ul>
						</div>
						
				</div>
					</div>
				</div>
			</div>
		</div>
		<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 col-12 mx-auto">
						<form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bi-search" id="basic-addon1">
                                        
                                    </span>
									<input name="keyword"  type="search" class="form-control" id="keyword" placeholder="Chercher & Recette" aria-label="Search">

<button type="submit" class="form-control" style="background:#D13D99;">Search</button>
</div>
                            </form>
                        </div>

                    </div>
                </div>
            </section>



<section class="blog section" id="blog">
    <div class="container">
        <div class="row">
		
            <?php
            // Boucle pour afficher les nouvelles recettes
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single Blog -->
                <div class="single-news">
                    <div class="news-head">
                        <img src=".\loginsystem\admin\images\<?php echo $row['image_url']; ?>" alt="Recette">
                    </div>
                    <div class="news-body">
                        <div class="news-content">
                            <div class="date"><?php echo date("d M, Y", strtotime($row['date_creation'])); ?></div>
							<h2><a href="recette-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></a></h2>
                            <p class="text"><?php echo $row['description']; ?></p>
                        </div>
                    </div>
                </div>
                <!-- End Single Blog -->
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php
include('./main/footer.php');
?>