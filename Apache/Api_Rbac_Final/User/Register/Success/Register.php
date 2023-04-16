<?php

    session_start();
    require_once("../../../Config/pdo.php");
    require_once("../../../Models/Session/Session.php");
    require_once("../../../Response/Response.php");

    $res = new Response();
    $otp = $_GET['otp'];

        if (empty($otp)) {
            $res->MessageError($_SESSION["Not_Found"],404);
        } else {
            try {
                $select_otp = $pdo->prepare("SELECT * FROM register_otp WHERE OTP = :OTP ");
                $select_otp->bindParam(":OTP", $otp);
                $select_otp->execute();
                $row = $select_otp->fetch(PDO::FETCH_ASSOC);   
                    if ($row['OTP'] == $otp) {
                        $UserProfile = 'User.png';
                        $passwordHash = password_hash($row['OTPPassword'], PASSWORD_DEFAULT);
                        $User = $pdo->prepare("INSERT INTO user(UserPlatform,UserKey,UserStstus,UserEmail,Username,UserPassword) 
                        VALUES (:UserPlatform, :UserKey, :UserStstus, :UserEmail, :Username, :UserPassword)");
                        $User_Data = $pdo->prepare("INSERT INTO user_data(UserKey,UserProfile) 
                        VALUES (:UserKey, :UserProfile)");
                        $User->bindParam(":UserPlatform", $row['OTPPlatform']);
                        $User->bindParam(":UserKey", $row['OTPKey']);
                        $User->bindParam(":UserStstus", $row['OTPStstus']);
                        $User->bindParam(":UserEmail", $row['OTPEmail']);
                        $User->bindParam(":Username", $row['OTPUsername']);
                        $User->bindParam(":UserPassword", $passwordHash);
                        $User_Data->bindParam(":UserKey", $row['OTPKey']);
                        $User_Data->bindParam(":UserProfile", $UserProfile);
                        $User->execute();
                        $User_Data->execute();

                        $delete_sql = "DELETE FROM register_otp WHERE OTP = :OTP";
                        $delete_stmt = $pdo->prepare($delete_sql);
                        $delete_stmt->bindParam(':OTP', $otp);
                        $delete_stmt->execute();
                        $res->MessageError($_SESSION["Success"],200);
                    } else {
                        $res->MessageError($_SESSION["Not_Found"],404);
                    }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
?>