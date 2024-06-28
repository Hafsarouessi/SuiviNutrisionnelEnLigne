<?php
session_start();
include_once('includes/config.php');

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    // Vérifier si le champ de fichier photo est défini et téléchargé sans erreur
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $user_image = $_FILES['photo']['name'];
        $temp_name = $_FILES['photo']['tmp_name'];
        
        // Déplacer le fichier téléchargé vers l'emplacement souhaité
        $upload_directory = "images/"; // Assurez-vous que ce dossier existe et a les bonnes permissions
        $targetFilePath = $upload_directory . $user_image;
        
        if(move_uploaded_file($temp_name, $targetFilePath)) {
            // Utiliser le chemin complet de l'image téléchargée dans la base de données
            $user_image_url = $targetFilePath;

            // Utiliser une requête préparée pour l'insertion
            $sql = "INSERT INTO users (fname, lname, email, password, contactno, image) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $email, $password, $contact, $user_image_url);
                $msg = mysqli_stmt_execute($stmt);
                
                if($msg) {
                    echo "<script>alert('Registered successfully');</script>";
                    echo "<script>window.location.href='login.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Failed to register');</script>";
                }
            } else {
                echo "<script>alert('Erreur de préparation de la requête SQL.');</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image');</script>";
        }
    } else {
        echo "<script>alert('Please select an image to upload');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function checkpass() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert('Password and Confirm Password field does not match');
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body style="background: linear-gradient(rgba(0,0,0,0.7),#C71585), url(http://localhost/SuiviNutrisionnel/img/img1.jpeg);">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4" style="color: #C71585;">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" name="signup" onsubmit="return checkpass();" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="fname" name="fname" type="text" placeholder="Enter your first name" required />
                                                    <label for="inputFirstName" style="color: #C71585;">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="lname" name="lname" type="text" placeholder="Enter your last name" required />
                                                    <label for="inputLastName" style="color: #C71585;">Last name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="file" class="form-control" id="photo" name="photo" required>
                                            <label for="inputImage" style="color: #C71585;">Choose Profile Image</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="email@gmail.com" required />
                                            <label for="inputEmail" style="color: #C71585;">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="contact" name="contact" type="text" placeholder="+212" required pattern="[0-9]{10}" title="10 numeric characters only" maxlength="10" />
                                            <label for="inputcontact" style="color: #C71585;">Contact Number</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required />
                                                    <label for="inputPassword" style="color: #C71585;">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="at least one number and one uppercase and lowercase letter, and at least 6 or more characters" required />
                                                    <label for="inputPasswordConfirm" style="color: #C71585;">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="submit" style="background-color: #C71585;">Create Account</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php" style="color: #C71585;">Have an account? Go to login</a></div>
                                    <div class="small"><a href="../" style="color: #C71585;">Back to Home</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
