
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Change password</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript">
        function valid() {
            if(document.changepassword.newpassword.value!= document.changepassword.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match!!");
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <style>
        body {
            background-image: url('images/image11.jpg'); /* Chemin vers votre image d'arrière-plan */
            background-size: cover; /* Pour s'assurer que l'image couvre tout l'arrière-plan */
            background-repeat: no-repeat; /* Pour empêcher la répétition de l'image */
            background-attachment: fixed; /* Pour fixer l'image en arrière-plan lorsque l'utilisateur fait défiler */
            background-position: center; /* Positionner l'image au centre */
            padding-top: 20px; /* Ajoute de l'espace en haut pour séparer du haut de la fenêtre */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Couleur de fond semi-transparente */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Ombre légère pour le cadre */
        }
        .card-header {
            background-color: #C71585; /* Couleur d'arrière-plan de l'en-tête de la carte */
            color: white; /* Couleur du texte de l'en-tête de la carte */
            font-weight: bold; /* Texte en gras */
        }
        .btn-primary {
            background-color: #BDB76B; /* Couleur de fond du bouton */
            border-color: #BDB76B; /* Couleur de la bordure du bouton */
        }
        .btn-primary:hover {
            background-color: #D2CE9E; /* Couleur de fond du bouton au survol */
            border-color: #D2CE9E; /* Couleur de la bordure du bouton au survol */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php');?>
    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php');?>
        <?php 
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {
    //Code for Updation 
    // for  password change   
    if(isset($_POST['update'])) {
        $oldpassword=$_POST['currentpassword']; 
        $newpassword=$_POST['newpassword'];
        $sql=mysqli_query($con,"SELECT password FROM users where password='$oldpassword'");
        $num=mysqli_fetch_array($sql);
        if($num>0) {
            $userid=$_SESSION['id'];
            $ret=mysqli_query($con,"update users set password='$newpassword' where id='$userid'");
            echo "<script>alert('Password Changed Successfully !!');</script>";
            echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>";
        } else {
            echo "<script>alert('Old Password not match !!');</script>";
            echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>";
        }
    }
?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4" style="color: #C71585; font-weight: bold; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Changer Mot de passe</h1>
                    <hr />
                    <div class="card mb-4">
                        <div class="card-header">Modifier le mot de passe</div>
                        <div class="card-body">
                            <form method="post" name="changepassword" onSubmit="return valid();">
                                <div class="mb-3">
                                    <label for="currentpassword" class="form-label">Mot de passe actuel</label>
                                    <input class="form-control" id="currentpassword" name="currentpassword" type="password" required />
                                </div>
                                <div class="mb-3">
                                    <label for="newpassword" class="form-label">Nouveau mot de passe</label>
                                    <input class="form-control" id="newpassword" name="newpassword" type="password" required />
                                </div>
                                <div class="mb-3">
                                    <label for="confirmpassword" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" required />
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" name="update">Changer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('includes/footer.php');?>
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
<?php } ?>
