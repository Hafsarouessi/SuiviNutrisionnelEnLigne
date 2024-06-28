<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Progrès</title>
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/img2.webp'); /* Chemin vers votre image d'arrière-plan */
            background-size: cover; /* Ajuste la taille de l'image pour couvrir toute la surface */
            background-position: center; /* Centre l'image */
            margin: 0;
            padding: 0;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.9); /* Couleur de fond avec transparence pour l'overlay */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        .overlay h1 {
            color: #C71585;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #C71585;
        }

        .btn-primary {
            background-color: #C71585;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #AD0E6F;
        }
    </style>
</head>
<body>
    <?php include_once('includes/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="overlay">
                    <h1>Ajouter Progrès de la Semaine</h1>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="poids" class="form-label">Poids</label>
                            <input type="number" step="0.1" class="form-control" id="poids" name="poids" required>
                        </div>
                        <div class="mb-3">
                            <label for="tour_taille" class="form-label">Tour de Taille (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="tour_taille" name="tour_taille" required>
                        </div>
                        <div class="mb-3">
                            <label for="tour_hanches" class="form-label">Tour de Hanches (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="tour_hanches" name="tour_hanches" required>
                        </div>
                        <div class="mb-3">
                            <label for="tour_poitrine" class="form-label">Tour de Poitrine (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="tour_poitrine" name="tour_poitrine" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </main>
            <?php include('includes/footer.php'); ?>
        </div>
    </div>
</body>
</html>
