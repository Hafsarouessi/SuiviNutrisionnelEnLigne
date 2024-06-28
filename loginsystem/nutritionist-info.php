<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile | Registration and Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        /* styles.css */

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
            padding: 0 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
        }

        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }

        .choose-left, .program-info {
            background: #fff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .admin-photo {
    max-width: 300px; /* Taille maximale de la largeur */
    height: auto; /* Hauteur automatique proportionnelle */
    border-radius: 50%; /* Bordures arrondies pour une forme de cercle */
    margin-bottom: 20px; /* Marge en bas pour l'espace */
    display: block; /* Assure que l'image est affichée en tant que bloc */
    margin-left: auto; /* Alignement automatique à gauche */
    margin-right: auto; /* Alignement automatique à droite */
}


        

        .program-list {
            list-style-type: none;
            padding: 0;
        }

        .program-list li {
            background: #f4f4f4;
            margin-bottom: 10px;
            padding: 10px;
            border-left: 5px solid #C71585; /* Utilisation de la couleur rose foncé pour les bordures des listes */
        }

        .program-list li strong {
            color: #C71585; /* Couleur rose foncé pour les noms des programmes */
        }

        a {
            color: #C71585; /* Utilisation de la couleur rose foncé pour les liens */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
     
.cool-title {
    color: #C71585; /* Couleur rose foncé */
    font-size: 28px; /* Taille de police plus grande */
    font-weight: bold; /* Texte en gras */
    text-transform: uppercase; /* Transforme le texte en majuscules */
    letter-spacing: 1px; /* Espacement entre les lettres */
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3); /* Ombre légère pour un effet de profondeur */
}
body {
    background-image: url('images/image11.jpg'); /* Chemin vers votre image d'arrière-plan */
    background-size: cover; /* Pour s'assurer que l'image couvre tout l'arrière-plan */
    background-repeat: no-repeat; /* Pour empêcher la répétition de l'image */
    background-attachment: fixed; /* Pour fixer l'image en arrière-plan lorsque l'utilisateur fait défiler */
    background-color: rgba(255, 255, 255, 0.7); /* Couleur de fond semi-transparente pour l'effet de cadre fumé */
}
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Start Choose Left -->
                            <div class="choose-left">
                                <img src="admin/images/nutritionniste.png" alt="Admin" class="admin-photo">
                                <p>Je suis Meriam Berradi, votre guide passionné pour une perte de poids durable et épanouissante. En tant que coach certifiée en perte de poids, j'ai aidé de nombreuses personnes à atteindre leurs objectifs de forme physique et à retrouver confiance en elles.</p>
                                <p>Grâce à une approche holistique de la perte de poids, je combine des conseils nutritionnels, des plans d'exercice adaptés et un soutien émotionnel pour vous aider à transformer votre corps et votre esprit. Je crois fermement que la clé d'un succès durable réside dans l'établissement de petites habitudes saines et dans le développement d'une relation positive avec la nourriture et l'exercice.</p>
                                <p>Notre champ d'action est vaste, couvrant la climatisation, le froid industriel et commercial, ainsi que les secteurs des entrepôts frigorifiques, des centres de distribution, la santé, et de la restauration.</p>
                            </div>
                            <!-- End Choose Left -->
                        </div>

                        <div class="col-lg-6 col-12">
                            <!-- Start Program Information -->
                            <div class="program-info">
                                <h3 style="color: #C71585; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Nos Programmes</h3>
                                <ul class="program-list">
                                    <li><strong class="program-title" style="color: #000;">Programme de Perte de Poids :</strong> Un plan structuré pour aider les individus à perdre du poids grâce à une alimentation équilibrée et une activité physique régulière.</li>
                                    <li><strong class="program-title"style="color: #000;">Programme de Gain de Muscle :</strong> Un guide complet axé sur l'augmentation de la masse musculaire avec une nutrition adéquate et des entraînements de force.</li>
                                    <li><strong class="program-title"style="color: #000;">Programme de Bien-être :</strong> Une approche holistique pour améliorer la santé et le bien-être général grâce à des changements alimentaires et de mode de vie.</li>
                                </ul>


                                <h3 style="color: #C71585; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Suivi de Nutrition</h3>
                                <p>Le suivi de nutrition sera effectué via WhatsApp. Pour commencer, veuillez remplir votre bilan initial sur la page <a href="progrer.php">Entrer les Progrès Hebdomadaires</a>. Chaque semaine, vous devrez entrer les mesures de votre progrès.</p>
                                <p>Pour toute assistance, contactez-nous via WhatsApp au : <strong><a href="https://wa.me/212612345678">+212 6 12 34 56 78</a></strong></p>
                            </div>
                            <!-- End Program Information -->
                        </div>
                    </div>
                </div>
            </main>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
