<?php

    session_start();
    require_once("../../Config/pdo.php");
    require_once("../../Models/Session/Session.php");
    require_once("../../Response/Response.php");
    require_once("../../Models/RandomKey/RandomKey.php");
    require_once("../../Models/PHPMailer/PHPMailer.php");
    require_once("../../Models/PHPMailer/SMTP.php");
    require_once("../../Models/PHPMailer/Exception.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $key = new RandomKey();
    $res = new Response();
  

    $UserKey = $key->generateKey(8);
    $OTP = $key->generateOtp(4);
    $UserPlatform = $_GET['UserPlatform'];
    $UserStstus = $_GET['UserStstus'];
    $UserEmail = strtolower($_GET['UserEmail']);
    $Username = $_GET['Username'];
    $UserPassword = $_GET['UserPassword'];
    $c_password = $_GET['c_password'];
    $time = 60;

    if(empty($UserEmail)) {
        $res->Message($_SESSION["Plase_Enter_Email"],404);
        mysqli_close($pdo);
    } else if (strlen($Username) <= 3) {
        $res->Message($_SESSION["Len_Username"],404);
        mysqli_close($pdo);
    } else if (!filter_var($UserEmail, FILTER_VALIDATE_EMAIL)) {
        $res->Message($_SESSION["EmailFormat"],404);
        mysqli_close($pdo);
    } else if (empty($UserPassword)) {
        $res->Message($_SESSION["Empty_Password"],404);
        mysqli_close($pdo);
    } else if (strlen($UserPassword) <= 3) {
        $res->Message($_SESSION["Len_Username"],404);
        mysqli_close($pdo);
    } else if ($UserPassword != $c_password) {
        $res->Message($_SESSION["CheckPass"],404);
        mysqli_close($pdo);
    } else {
        try {
            $check_email = $pdo->prepare("SELECT UserEmail FROM user WHERE UserEmail = :UserEmail ");
            $check_email->bindParam(":UserEmail", $UserEmail);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);
                if ($row['UserEmail'] == $UserEmail) {
                $res->Message($_SESSION["Duplicate_Email"],404);
                mysqli_close($pdo);
                } else if ($row['UserEmail'] != $UserEmail) {
                    $select_otp = $pdo->prepare("SELECT OTPEmail FROM register_otp WHERE OTPEmail = :UserEmail ");
                    $select_otp->bindParam(":UserEmail", $UserEmail);
                    $select_otp->execute();
                    $row_otp = $select_otp->fetch(PDO::FETCH_ASSOC);
                        if ($row_otp['OTPEmail'] == $UserEmail) {
                            $update_otp = "UPDATE register_otp SET OTP = :OTP, Time_OTP = :Time_OTP, OTPStstus = :OTPStstus WHERE OTPEmail = :UserEmail";
                            $update_otp = $pdo->prepare($update_otp);
                            $update_otp->bindParam(':UserEmail', $UserEmail);
                            $update_otp->bindParam(':OTP', $OTP);
                            $update_otp->bindParam(':OTPStstus', $UserStstus);
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
                                    $select_email = $pdo->prepare("SELECT * FROM register_otp WHERE OTPEmail = :UserEmail ");
                                    $select_email->bindParam(":UserEmail", $UserEmail);
                                    $select_email->execute();
                                    $select_data = $select_email->fetch(PDO::FETCH_ASSOC);

                                    $res->ResMessage($_SESSION["Success"],$select_data,200);
                            } else {
                                $res->Message($_SESSION["Error"],404);
                                mysqli_close($pdo);
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
                                $mail->Body = ("OTP: ".$OTP);                                    

                                if($mail->send()) {
                                    $select_email = $pdo->prepare("SELECT * FROM register_otp WHERE OTPEmail = :UserEmail ");
                                    $select_email->bindParam(":UserEmail", $UserEmail);
                                    $select_email->execute();
                                    $select_data = $select_email->fetch(PDO::FETCH_ASSOC);
                                    $res->ResMessage($_SESSION["Success"],$select_data,200);
                                    mysqli_close($pdo);
                                } else {
                                    $res->Message($_SESSION["Error"],404);
                                    mysqli_close($pdo);
                                }
                            }
                            
                        }

                        
        } catch (PDOException $e) {
            $res->ResMessage($_SESSION["Error"],$e->getMessage(),400);
            echo $e->getMessage();
            mysqli_close($pdo);
        }

    }

?>