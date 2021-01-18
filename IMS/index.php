<?php
session_start();
if(isset($_SESSION['log']) ==1){
    header('location:dashboard.php');
}
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GSAIMS | Sign In</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/f807c48613.js"></script>
    <script src="js/jquery.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-5 col-lg-7 bg-image"></div>
        <div class="col-md-7 col-lg-5">
            <div class="login d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <div id="logo">
                                <img src="img/png/cropped-GSA-Logo.png" style="width: 50%; height: 50%">
                            </div>
                            <h3 class="login-heading mb-4  text-center" style="letter-spacing: 2px">Inventory Management System</h3>
                            <form action="php/login.php" method="post">
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="inputEmail" required autofocus>
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="inputPassword" required>
                                    <label for="inputPassword">Password</label>
                                </div>

                                <button id="signin" class="btn btn-lg btn-secondary btn-block btn-login text-uppercase font-weight-bold mb-2 " type="submit">
                                    Sign in
                                </button>

                                <!-- php code to prompt the user if the email or password is incorrect -->
                                <p id="placeBannerToDisplayErrorLogin"></p>
                                <?php if ($_GET["loginFailed"] == 1) echo 'Wrong Username or Password' ?>
                                <!-- php code to prompt the user if the email or password is incorrect -->


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>