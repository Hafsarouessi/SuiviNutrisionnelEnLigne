<?php session_start(); 
include_once('includes/config.php');
// Code for login 
if(isset($_POST['login']))
{
$password=$_POST['password'];
$dec_password=$password;
$useremail=$_POST['uemail'];
$ret= mysqli_query($con,"SELECT id,fname FROM users WHERE email='$useremail' and password='$dec_password'");
$num=mysqli_fetch_array($ret);
if($num>0)
{

$_SESSION['id']=$num['id'];
$_SESSION['name']=$num['fname'];
header("location:welcome.php");

}
else
{
echo "<script>alert('Invalid username or password');</script>";
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
        <title>User Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background: linear-gradient(rgba(0,0,0,0.7),#C71585), url(http://localhost/SuiviNutrisionnel/img/img1.jpeg);">

        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">

<div class="card-header">
<h2 class="modal-title" id="UtilisateurConnecterLabel" style="color: #C71585; ">User Login</h2>

      </div><br>


                                    <div class="card-body">
                                        
                                        <form method="post">
                                            
<div class="form-floating mb-3">
<input class="form-control" name="uemail" type="email" placeholder="name@example.com" required/>
<label for="inputEmail" style="color: #C71585; ">Email address</label>
</div>
                                            

<div class="form-floating mb-3">
<input class="form-control" name="password" type="password" placeholder="Password" required />
<label for="inputPassword" style="color: #C71585; ">Password</label>
</div>


<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
<a class="small" href="password-recovery.php" style="color: #C71585;">Forgot Password?</a>
<button class="btn btn-primary" name="login" type="submit" style="background-color: #C71585;">Login</button>
</div>
</form>
</div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="signup.php" style="color: #C71585;" >Need an account? Sign up!</a></div>
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <?php
  include('../main/footer.php');
 ?>
