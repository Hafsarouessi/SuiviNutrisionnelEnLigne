
<?php
include('loginsystem/includes/config.php');

// Récupérer les nouvelles recettes depuis la base de données
$query = "SELECT * FROM recette ORDER BY id DESC LIMIT 3"; // Par exemple, récupérez les 3 dernières recettes
$result = mysqli_query($con, $query);

include('./main/header.php');
?>

	<!-- Slider Area -->
<section class="slider">
    <div class="hero-slider">
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/img1.jpeg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Une alimentation équilibrée <span> associée à un mode</span> de vie actif <span> est la clé d'une vie saine !</span></h1>
                            <p>Adoptez un mode de vie sain avec nos conseils en nutrition et fitness. Transformez votre quotidien dès maintenant.</p>
												<div class="button">
						<a href="#" class="btn">Rejoignez-nous</a>
						<a href="#" class="btn primary">En Savoir Plus</a>
					</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/img2.webp')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Rejoignez-nous pour un mode de vie plus sain <span> et équilibré</span></h1>
                            <p>Découvrez nos programmes de nutrition personnalisés pour vous aider à atteindre vos objectifs de santé et de bien-être.</p>
						<div class="button">
							<a href="#" class="btn">Rejoignez-nous</a>
							<a href="#" class="btn primary">En Savoir Plus</a>
						</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/image12.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Des plans de nutrition adaptés <span> à vos besoins</span></h1>
                            <p>Choisissez parmi nos recettes et conseils pour une alimentation équilibrée et délicieuse chaque jour.</p>
                            <div class="button">
    <a href="#" class="btn">Rejoignez-nous</a>
    <a href="#" class="btn primary">En Savoir Plus</a>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url('img/image11.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1>Une alimentation équilibrée <span> associée à un mode</span> de vie actif <span> est la clé d'une vie saine !</span></h1>
                            <p>Adoptez nos conseils et astuces pour améliorer votre mode de vie et atteindre vos objectifs de santé.</p>
                            <div class="button">
    <a href="#" class="btn">Rejoignez-nous</a>
    <a href="#" class="btn primary">En Savoir Plus</a>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
    </div>
</section>
<!--/ End Slider Area -->

<!-- Start Schedule Area -->
<section class="schedule">
    <div class="container">
        <div class="schedule-inner">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule last">
                        <div class="inner">
                            
					<div class="single-content">
							<span>Conseils Nutritionnels et Physiques</span>
							<h4>Améliorez votre alimentation et votre condition physique.</h4>
							<p>Découvrez des conseils pratiques pour une alimentation saine et équilibrée. Suivez des exercices simples et efficaces pour rester en forme et améliorer votre bien-être général.</p>
							<a href="#">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
						</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule first">
                        <div class="inner">
                            
                            <div class="single-content">
                                <span>Recettes santé</span>
                                <h4>Trouvez votre régime alimentaire</h4>
                                <p>Trouvez un régime alimentaire adapté à votre mode de vie : Comptage des calories, Faible en glucides, Keto, Végétalien, Végétarien et plus encore.</p>
                                <a href="recette.php">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule middle">
                        <div class="inner">
                            
                            <div class="single-content">
                                <span>Suivi des objectifs</span>
                                <h4>Fixez vos objectifs</h4>
                                <p>Choisissez votre taux de perte de poids hebdomadaire souhaité, la date cible et la répartition des calories telles que les graisses, les glucides et les protéines.</p>
                                <a href="programme.php">EN SAVOIR PLUS<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/End Start Schedule Area -->

		
		 <!-- Start Why choose -->
		<section id="why-choose" class="why-choose section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title">
							<h2 style="color: #C71585;">WEIGHT & LOSS</h2>
							
							</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6 col-12">
						<!-- Start Choose Left -->
						<div class="choose-left">
							<h3>Qui sommes-nous ?</h3>
							<p >Je suis Meriam berradi, votre guide passionné pour une perte de poids durable et épanouissante. En tant que coach certifiée en perte de poids, j'ai aidé de nombreuses personnes à atteindre leurs objectifs de forme physique et à retrouver confiance en elles.</p>
							
							<p>Grâce à une approche holistique de la perte de poids, je combine des conseils nutritionnels, des plans d'exercice adaptés et un soutien émotionnel pour vous aider à transformer votre corps et votre esprit. Je crois fermement que la clé d'un succès durable réside dans l'établissement de petites habitudes saines et dans le développement d'une relation positive avec la nourriture et l'exercice. </p>
							<p>Notre champ d'action est vaste, couvrant la climatisation, le froid industriel et commercial, ainsi que les secteurs des entrepôts frigorifiques, des centres de distribution, la santé, et de la restauration.</p>
							
						</div>
						<!-- End Choose Left -->
					</div>
					<div class="col-lg-6 col-12">
						<!-- Start Choose Rights -->
						<div class="choose-right">
							<div class="video-image" style="overflow: hidden; border-radius: 50%;  ">
                               <img src="img/img1.jpeg" alt="#">
                            </div>
						</div>
						<!-- End Choose Rights -->
					</div>
				</div>
			</div>
		</section>
		<!--/ End Why choose -->
		<!-- Tableau des Prix -->
<section class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
			<div class="section-title">
    <h2 >Nous vous offrons les meilleurs programmes à un prix raisonnable</h2>
</div>
            </div>
        </div>
        <div class="row">
		<div class="row">
    <!-- Programme de Perte de Poids -->
    <div class="col-lg-4 col-md-12 col-12">
        <div class="single-table">
            <!-- En-tête du Tableau -->
            <div class="table-head">
                <div class="icon">
                    <i class="fa-solid fa-weight-scale"></i>
                </div>
                <h4 class="title">Programme de Perte de Poids</h4>
                <div class="price">
                    <p class="amount">199 MAD<span>/ Par Visite</span></p>
                </div>
            </div>
            <!-- Liste du Tableau -->
            <ul class="table-list">
                <li><i class="icofont icofont-ui-check"></i>Plan structuré pour perdre du poids</li>
                <li><i class="icofont icofont-ui-check"></i>Alimentation équilibrée</li>
                <li><i class="icofont icofont-ui-check"></i>Activité physique régulière</li>
                <li><i class="icofont icofont-ui-check"></i>Support nutritionnel avancé</li>
                <li><i class="icofont icofont-ui-check"></i>Coaching personnalisé</li>
            </ul>
            <div class="table-bottom text-center mt-3">
                <a class="btn btn-primary" href="paiement.php?program=perte-poids&price=199">Rejoindre Maintenant</a>
            </div>
        </div>
    </div>
    <!-- Fin du Tableau Unique -->
    
    <!-- Programme de Gain de Muscle -->
    <div class="col-lg-4 col-md-12 col-12">
        <div class="single-table">
            <!-- En-tête du Tableau -->
            <div class="table-head">
                <div class="icon">
                    <i class="fa-solid fa-dumbbell"></i>
                </div>
                <h4 class="title">Programme de Gain de Muscle</h4>
                <div class="price">
                    <p class="amount">299 MAD<span>/ Par Visite</span></p>
                </div>
            </div>
            <!-- Liste du Tableau -->
            <ul class="table-list">
                <li><i class="icofont icofont-ui-check"></i>Augmentation de la masse musculaire</li>
                <li><i class="icofont icofont-ui-check"></i>Nutrition adaptée</li>
                <li><i class="icofont icofont-ui-check"></i>Entraînements de force intensifs</li>
                <li><i class="icofont icofont-ui-check"></i>Suppléments nutritionnels</li>
                <li><i class="icofont icofont-ui-check"></i>Suivi personnalisé</li>
            </ul>
            <div class="table-bottom text-center mt-3">
                <a class="btn btn-primary" href="paiement.php?program=gain-muscle&price=299">Rejoindre Maintenant</a>
            </div>
        </div>
    </div>
    <!-- Fin du Tableau Unique -->

    <!-- Programme de Bien-être -->
    <div class="col-lg-4 col-md-12 col-12">
        <div class="single-table">
            <!-- En-tête du Tableau -->
            <div class="table-head">
                <div class="icon">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h4 class="title">Programme de Bien-être</h4>
                <div class="price">
                    <p class="amount">399 MAD<span>/ Par Visite</span></p>
                </div>
            </div>
            <!-- Liste du Tableau -->
            <ul class="table-list">
                <li><i class="icofont icofont-ui-check"></i>Approche holistique du bien-être</li>
                <li><i class="icofont icofont-ui-check"></i>Changements alimentaires sains</li>
                <li><i class="icofont icofont-ui-check"></i>Amélioration du mode de vie</li>
                <li><i class="icofont icofont-ui-check"></i>Gestion du stress</li>
                <li><i class="icofont icofont-ui-check"></i>Techniques de relaxation</li>
            </ul>
            <div class="table-bottom text-center mt-3">
                <a class="btn btn-primary" href="paiement.php?program=bien-etre&price=399">Rejoindre Maintenant</a>
            </div>
        </div>
    </div>
    <!-- Fin du Tableau Unique -->
</div>

</div>

        </div>  
    </div>  
</section>  
<!--/ Fin du Tableau des Prix -->

			
		
		
		<!-- Start Fun-facts -->
		<div id="fun-facts" class="fun-facts section overlay">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Fun -->
						<div class="single-fun">
							<i class="icofont icofont-home"></i>
							<div class="content">
								<span class="counter">3468</span>
								<p>Nos Patients</p>
							</div>
						</div>
						<!-- End Single Fun -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Fun -->
						<div class="single-fun">
							<i class="icofont icofont-user-alt-3"></i>
							<div class="content">
								<span class="counter">1</span>
								<p>pécialiste en nutrition</p>
							</div>
						</div>
						<!-- End Single Fun -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Fun -->
						<div class="single-fun">
							<i class="icofont-simple-smile"></i>
							<div class="content">
								<span class="counter">4379</span>
								<p>Happy Patients</p>
							</div>
						</div>
						<!-- End Single Fun -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Start Single Fun -->
						<div class="single-fun">
							<i class="icofont icofont-table"></i>
							<div class="content">
								<span class="counter">12</span>
								<p>Years of Experience</p>
							</div>
						</div>
						<!-- End Single Fun -->
					</div>
				</div>
			</div>
		</div>
	</section>
		<section class="blog section" id="blog">
		<div class="container">
		<div class="row">
					
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">
                <h2>Une alimentation saine, une vie saine : Étape par étape vers une meilleure santé</h2>
                <img src="img/logoDiet.webp" alt="Logo Diet" class="small-image">
                <p>Votre santé est notre priorité absolue. En travaillant ensemble, nous pouvons atteindre vos objectifs de santé et vous aider à mener une vie plus équilibrée</p>
            </div>
        </div>
    </div>
</div>

	</section>
	<style>/* styles.css */
.single-news {
    margin-bottom: 30px;
    overflow: hidden;
    border: 1px solid #e6e6e6;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.small-image {
    width: 250px;
    height: auto;
}


.single-news .news-head img {
    width: 100%;
    height: 230px; /* Fixed height */
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
.single-table {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .table-list {
        flex-grow: 1;
    }
</style>

<!-- Start Blog Area -->
<section class="blog section" id="blog">
    <div class="container">
	<div class="col-lg-12">
						<div class="section-title">
							<h2 style="color: #C71585;">Recettes de Nutrition</h2>
							
							</div>
					</div>
				</div>
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
		
		
		
	