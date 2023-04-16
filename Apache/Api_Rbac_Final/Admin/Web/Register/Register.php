<?php

    session_start();
    require_once("../../../Config/pdo.php");
    require_once("../../../Models/RandomKey/RandomKey.php");
    require_once("../../../Response/Response.php");
    require_once("../../../Models/Session/Session.php");
    require_once("../../../Models/PHPMailer/PHPMailer.php");
    require_once("../../../Models/PHPMailer/SMTP.php");
    require_once("../../../Models/PHPMailer/Exception.php");
   
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $key = new RandomKey();
    $res = new Response();
    $datetime = new DateTime();


    $UserKey = $key->generateKey(8);
    $OTP = ($key->generateOtp(4));
    $UserPlatform = "ServiceControl";
    $UserStstus = "Admin";
    $UserEmail = $_GET['UserEmail'];
    $Username = $_GET['Username'];
    $UserPassword = $_GET['UserPassword'];
    $c_password = $_GET['c_password'];
    $time = 60;

    if (isset($_GET['Admin'])) {
        if(empty($UserEmail)) {
            $_SESSION["err"] = "กรุณาใส่ Email";
            header("location: ../index.php");
        } else if (!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["err"] = "รูปแบบ Email ไม่ถูกต้อง";
            header("location: ../index.php");
        } else if (empty($Username)) {
            $_SESSION["err"] = "กรุณาใส่ Username";
            header("location: ../index.php");
        } else if (strlen($Username) <= 3) {
            $_SESSION["err"] = "Username ต้องมี ความยาว 4 ตัวขึ้นไป";
            header("location: ../index.php");
        } else if (empty($UserPassword)) {
            $_SESSION["err"] = "กรุณาใส่ Password";
            header("location: ../index.php");
        } else if (strlen($UserPassword) <= 3) {
            $_SESSION["err"] = "Password ต้องมี ความยาว 4 ตัวอักษรขึ้นไป";
            header("location: ../index.php");
        } else if ($UserPassword != $c_password) {
            $_SESSION["err"] = "Password ไม่ตรง กัน";
            header("location: ../index.php");
        } else {
            try {
                    $check_email = $pdo->prepare("SELECT UserEmail FROM user WHERE UserEmail = :UserEmail ");
                    $check_email->bindParam(":UserEmail", $UserEmail);
                    $check_email->execute();
                    $row = $check_email->fetch(PDO::FETCH_ASSOC);
                        if ($row['UserEmail'] == $UserEmail) {
                            $_SESSION['err'] = "Email ซ้ำ";
                            header("location: ../index.php");
                        } else if (!isset($_SESSION['err'])) {
                            $select_otp = $pdo->prepare("SELECT OTPEmail FROM register_otp WHERE OTPEmail = :UserEmail ");
                            $select_otp->bindParam(":UserEmail", $UserEmail);
                            $select_otp->execute();
                            $row_otp = $select_otp->fetch(PDO::FETCH_ASSOC);
                                if($row_otp['OTPEmail'] == $UserEmail) {
                                    $update_otp = "UPDATE register_otp SET OTP = :OTP, Time_OTP = :Time_OTP WHERE OTPEmail = :UserEmail";
                                    $update_otp = $pdo->prepare($update_otp);
                                    $update_otp->bindParam(':UserEmail', $UserEmail);
                                    $update_otp->bindParam(':OTP', $OTP);
                                    $update_otp->bindParam(':Time_OTP', $time);
                                    $update_otp->execute();

                                    $name = "Project Final";
                                    $header = "OTP Form Project Final";
                                    $mail->isSMTP();
                                    $mail->Host = "smtp.gmail.com";
                                    $mail->SMTPAuth = true;
                                    $mail->Username = "razeroffline@gmail.com"; // enter your email address
                                    $mail->Password = "uuwllibdqtuueyqk"; // enter your password
                                    $mail->Port = 465;
                                    $mail->SMTPSecure = "ssl";

                                    $mail->isHTML(true);
                                    $mail->setFrom($UserEmail, $name);
                                    $mail->addAddress($UserEmail); // Send to mail
                                    $mail->Subject = $header;
                                    $mail->Body = strtoupper("OTP: ".$OTP);

                                    if($mail->send()) {
                                        $_SESSION["success"] = "กรุณา กรอง OTP";
                                        header("location: ../OTP/index.php");
                                    } else {
                                        $_SESSION["err"] = "Error ส่งไม่ได้";
                                        header("location: ../index.php");
                                    }
                                } else if ($row_otp['UserEmail'] != $UserEmail) {
                                    $stmt = $pdo->prepare("INSERT INTO register_otp(OTPPlatform,OTPKey,OTPStstus,OTPEmail,OTPUsername,OTPPassword,OTP,Time_OTP) 
                                    VALUES (:UserPlatform, :UserKey, :UserStstus, :UserEmail, :Username, :UserPassword, :OTP, :Time_OTP)");
                                    $stmt->bindParam(":UserPlatform", $UserPlatform);
                                    $stmt->bindParam(":UserKey", $UserKey);
                                    $stmt->bindParam(":UserStstus", $UserStstus);
                                    $stmt->bindParam(":UserEmail", $UserEmail);
                                    $stmt->bindParam(":Username", $Username);
                                    $stmt->bindParam(":UserPassword", $UserPassword);
                                    $stmt->bindParam(":OTP", $OTP);
                                    $stmt->bindParam(":Time_OTP", $time);
                                    $stmt->execute();
                                    
                                    $name = "Project Final";
                                    $header = "Form Project Final";
                                    $mail->isSMTP();
                                    $mail->Host = "smtp.gmail.com";
                                    $mail->SMTPAuth = true;
                                    $mail->Username = "razeroffline@gmail.com"; // enter your email address
                                    $mail->Password = "uuwllibdqtuueyqk"; // enter your password
                                    $mail->Port = 465;
                                    $mail->SMTPSecure = "ssl";

                                    $mail->isHTML(true);
                                    $mail->setFrom($UserEmail, $name);
                                    $mail->addAddress($UserEmail); // Send to mail
                                    $mail->Subject = $header;
                                    $mail->Body = strtoupper("OTP: ".$OTP);                                    

                                    if($mail->send()) {
                                        $_SESSION["OTPEmail"] = $UserEmail;
                                        header("location: ../OTP/index.php");
                                    } else {
                                        $_SESSION["err"] = "Error ส่งไม่ได้";
                                        header("location: ../index.php");
                                    }
                                }
                        }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } else {
        $_SESSION["err"] = "Error";
        header("location: ../index.php");
    }
?>