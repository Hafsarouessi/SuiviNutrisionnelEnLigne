<?php
include('./main/header.php');?>
<style>
   .heade {
    height: 400px; /* Hauteur de la section */
    width: 100%;
    background: linear-gradient(rgba(0,0,0,0.7),#D2B48C),url(images/photos.jpg);
    background-size: cover; 
    background-position: center; 
    box-shadow: 10px  ; 
}
  
        
 .search-form {
    color: #fff; 
    font-family: 'Helvetica Neue', sans-serif;
    font-size: 13px; 
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80px;
    background-color: #333; 
    text-align: center;
    text-transform: uppercase; 
    letter-spacing: 2px; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); 
}


         body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}



main {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.payment-form {
    text-align: left;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color:#BC8F8F;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


.payement-form {
    color: #fff; 
    font-family: 'Helvetica Neue', sans-serif;
    font-size: 13px; 
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    background-color: #333; 
    text-align: center;
    text-transform: uppercase; 
    letter-spacing: 2px; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); 
}
  .form-row {
    display: flex;
    align-items: center; 
    gap: 10px; 
    margin-bottom: 30px; 
}

.label {
    flex: 1; 
    font-weight: bold;
}

.input {
    flex: 2; 
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}



 </style>

<!-- Contenu de la page -->
<div class="breadcrumbs overlay" style="background-image: url('img/img1.jpeg');">
    <div class="container">
        <div class="bread-inner">
            <div class="row">
                <div class="col-12">
                    <h2>Payment</h2>
                    <ul class="bread-list">
                        <li><a href="accueil.html">Accueil</a></li>
                        <li><i class="icofont-simple-right"></i></li>
                        <li class="active">Rejoindre à Weight Loss</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<br><br>
<main>
    <div class="payment-form">
        <?php
        // Vérifiez si les paramètres program et price sont définis dans l'URL
        if (isset($_GET['program']) && isset($_GET['price'])) {
            $program = htmlspecialchars($_GET['program']);
            $price = htmlspecialchars($_GET['price']);

            // Affichez le type de programme et le prix dans le titre h2
            echo "<h2 class='text-center my-4' style='text-align: center; color: #BC8F8F; font-size: 45px; font-family: \"Kaushan Script\", cursive; text-transform: capitalize;'>Paiement pour $program</h2>";
            echo "<p style='text-align: center; font-size: 24px;'>Montant à payer : $price MAD</p>";
        } else {
            // Redirigez si les paramètres ne sont pas définis correctement
            header('Location: index.php');
            exit();
        }
        ?>

        <form method="post" action="trt.php">
            <!-- Ajout de champs cachés pour transmettre program et price -->
            <input type="hidden" name="program" value="<?php echo $program; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

            <div class="form-group">
                <label for="nom">Nom sur la Carte</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="numero-carte">Numéro de Carte</label>
                <input type="text" id="numero-carte" name="numero-carte" required>
            </div>
            <div class="form-group">
                <label for="date-expiration">Date d'Expiration</label>
                <input type="text" id="date-expiration" name="date-expiration" placeholder="MM/AA" required>
            </div>
            <div class="form-group">
                <label for="code-securite">Code de Sécurité</label>
                <input type="text" id="code-securite" name="code-securite" required>
            </div>
            
            <?php
// Vérifiez si l'utilisateur est connecté (utilisation de session)
if (isset($_SESSION['id'])) {
    // Affichez le bouton de paiement si l'utilisateur est connecté

    echo '<button type="submit" class="btn btn-primary" style="background-color:#BC8F8F;">Payer</button>';
} else {
   echo ' <div style="text-align: center; margin-top: 20px;">
        <p>Vous devez être connecté pour effectuer le paiement.</p>
        <a href="index.php" class="btn btn-primary">Se connecter</a>
    </div>';
}

?>



        </form>
    </div>
</main>

<br><br><br>

<?php
// Inclusion du pied de page
include('./main/footer.php');

?>

<!-- Scripts JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/all.min.js"></script>
<script type="text/javascript" src="js/ajaxrequest.js"></script>
</body>
</html>

