
<?php




include('./main/header.php');
?>
    
    <!-- Styles personnalisés -->
    <style>
        .single-program {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
        .single-program .icon {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .single-program .title {
            color: #C71585;
            font-size: 24px;
            font-weight: bold;
        }
        .single-program .amount {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
           <!-- Programme de Perte de Poids -->
<div class="col-lg-4 col-md-12 col-12">
    <div class="single-program">
        <div class="icon">
            <i class="fas fa-weight"></i>
        </div>
        <h4 class="title">Programme de Perte de Poids</h4>
        <div class="price">
            <p class="amount">199 MAD<span>/ Par Visite</span></p>
        </div>
        <ul class="program-details">
            <li>Plan structuré pour perdre du poids</li>
            <li>Alimentation équilibrée</li>
            <li>Activité physique régulière</li>
            <li>Support nutritionnel avancé</li>
            <li>Coaching personnalisé</li>
        </ul>
        <div class="text-center mt-3">
            <a class="btn btn-primary" href="paiement.php?program=perte-poids&price=199">Rejoindre Maintenant</a>
        </div>
    </div>
</div>

<!-- Programme de Gain de Muscle -->
<div class="col-lg-4 col-md-12 col-12">
    <div class="single-program">
        <div class="icon">
            <i class="fas fa-dumbbell"></i>
        </div>
        <h4 class="title">Programme de Gain de Muscle</h4>
        <div class="price">
            <p class="amount">299 MAD<span>/ Par Visite</span></p>
        </div>
        <ul class="program-details">
            <li>Augmentation de la masse musculaire</li>
            <li>Nutrition adaptée</li>
            <li>Entraînements de force intensifs</li>
            <li>Suppléments nutritionnels</li>
            <li>Suivi personnalisé</li>
        </ul>
        <div class="text-center mt-3">
            <a class="btn btn-primary" href="paiement.php?program=gain-muscle&price=299">Rejoindre Maintenant</a>
        </div>
    </div>
</div>

<!-- Programme de Bien-être -->
<div class="col-lg-4 col-md-12 col-12">
    <div class="single-program">
        <div class="icon">
            <i class="fas fa-spa"></i>
        </div>
        <h4 class="title">Programme de Santé Bien-être</h4>
        <div class="price">
            <p class="amount">399 MAD<span>/ Par Visite</span></p>
        </div>
        <ul class="program-details">
            <li>Approche holistique du bien-être</li>
            <li>Changements alimentaires sains</li>
            <li>Amélioration du mode de vie</li>
            <li>Gestion du stress</li>
            <li>Techniques de relaxation</li>
        </ul>
              <div class="text-center mt-3">
                     <a class="btn btn-primary" href="paiement.php?program=bien-etre&price=399">Rejoindre Maintenant</a>
               </div>
             </div>
         </div>
        </div>
    </div>

	   
    <?php
include('./main/footer.php');
?>
		

