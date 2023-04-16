<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Admin</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="login-form-20/css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(login-form-20/images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Register Admin</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="Register/Register.php" method="get" class="signin-form">
                            <div class="form-group">
                                <input type="email" id="UserEmail" name="UserEmail" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" id="Username" name="Username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input id="UserPassword" type="password" name="UserPassword" class="form-control" placeholder="Password" required>
                                <span toggle="#UserPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <input id="c_password" type="password" name="c_password" class="form-control" placeholder="Confirm Password" required>
                                <span toggle="#c_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="Admin" class="form-control btn btn-primary submit px-3">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <form action="./Register/Register.php" method="get">
        <label for="UserEmail">Email: </label><br>
        <input type="email" id="UserEmail" name="UserEmail"><br>
        <label for="Username">Username: </label><br>
        <input type="text" id="Username" name="Username"><br>
        <label for="UserPassword">Password: </label><br>
        <input type="password" id="UserPassword" name="UserPassword"><br>
        <label for="UserPassword">Condfirm Password: </label><br>
        <input type="password" id="c_password" name="c_password"><br>
        <input type="submit" value="Submit" name="Admin">
    </form> -->
    
    <?php
        echo $_SESSION['err'];
        unset($_SESSION['err']);
    ?>
    <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    ?>

    <script src="login-form-20/js/jquery.min.js"></script>
    <script src="login-form-20/js/popper.js"></script>
    <script src="login-form-20/js/bootstrap.min.js"></script>
    <script src="login-form-20/js/main.js"></script>

</body>

</html>