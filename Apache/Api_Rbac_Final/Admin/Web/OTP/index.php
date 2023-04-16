<?php

    session_start();
    if(!isset($_SESSION["OTPEmail"])) {
        // header("location: ../index.php");
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify OTP</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../login-form-20/css/style.css">
</head>

<body class="img js-fullheight" style="background-image: url(../login-form-20/images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Enter OTP</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="OTP.php" method="post" class="otp-form">
                            <div class="form-group">
                                <input type="text" id="OTP" style="text-transform:uppercase" name="OTP" class="form-control">
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <button type="submit" name="SubmitOTP" class="form-control btn btn-primary submit px-3">Verify OTP</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <form action="./OTP.php" method="post"> 
        <label for="OTP">OTP: </label><br>
        <input type="text" id="OTP" style="text-transform:uppercase" name="OTP"><br>
        <input type="submit" value="Submit" name="SubmitOTP">
    </form> -->

    <?php
        echo $_SESSION['err'];
        unset($_SESSION['err']);
    ?>
    <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    ?>

    <script src="../login-form-20/js/jquery.min.js"></script>
    <script src="../login-form-20/js/popper.js"></script>
    <script src="../login-form-20/js/bootstrap.min.js"></script>
    <script src="../login-form-20/js/main.js"></script>

</body>

</html>