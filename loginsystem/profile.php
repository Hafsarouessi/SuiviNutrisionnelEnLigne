<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Profile | Registration and Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        /* CSS pour le corps (body) avec une image d'arrière-plan et un effet de flou */
        body {
            background-image: url('images/image11.jpg'); /* Chemin vers votre image d'arrière-plan */
            background-size: cover; /* Pour s'assurer que l'image couvre tout l'arrière-plan */
            background-repeat: no-repeat; /* Pour empêcher la répétition de l'image */
            background-attachment: fixed; /* Pour fixer l'image en arrière-plan lorsque l'utilisateur fait défiler */
            background-position: center; /* Positionner l'image au centre */
            padding-top: 56px; /* Ajustement pour le navbar */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.6); /* Couleur de fond semi-transparente pour l'effet de cadre fumé */

            backdrop-filter: blur(10px); /* Flou de l'arrière-plan avec un rayon de 10px */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordure légère */
        }

        .card-body {
            color: #000; /* Couleur du texte */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php');?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php');?>
        <?php 
        include_once('includes/config.php');
        if (strlen($_SESSION['id'] == 0)) {
            header('location:logout.php');
        } else {
            $userid=$_SESSION['id'];
            $query=mysqli_query($con,"select * from users where id='$userid'");
            while($result=mysqli_fetch_array($query)) {
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                <h1 class="mt-4" style="color: #C71585; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);"><?php echo ucfirst($result['fname']); ?>'s Profile</h1>
                <hr /><div class="card mb-4">
                        <div class="card-body">
                            <a href="edit-profile.php" style="color: #BDB76B; font-weight: bold;">Edit</a>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Prenom</th>
                                    <td><?php echo $result['fname'];?></td>
                                </tr>
                                <tr>
                                    <th>Nom</th>
                                    <td><?php echo $result['lname'];?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td colspan="3"><?php echo $result['email'];?></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td colspan="3"><?php echo $result['contactno'];?></td>
                                </tr>
                                <tr>
                                    <th>Date d'inscription</th>
                                    <td colspan="3"><?php echo $result['posting_date'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('includes/footer.php');?>
        </div>
        <?php } } ?>
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
