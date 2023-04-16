<?php

    session_start();
    require_once("../../../Config/pdo.php");
    
    $OTP = strtoupper($_POST["OTP"]);
    
    if(isset($_POST['SubmitOTP'])) {
        if((strlen($OTP) <= 3) || (strlen($OTP) >= 5)) {
            $_SESSION["err"] = "OTP มั่วละ ใส่ใหม่";
            header("location: ./index.php");
        } else {
            try {
                $check_otp = $pdo->prepare("SELECT * FROM register_otp WHERE OTP = :OTP ");
                $check_otp->bindParam(":OTP", $OTP);
                $check_otp->execute();
                $row = $check_otp->fetch(PDO::FETCH_ASSOC);                
                    if($row['OTP'] == $OTP) {
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
                        $delete_stmt->bindParam(':OTP', $OTP);
                        $delete_stmt->execute();

                        unset($_SESSION['OTPEmail']);
                        $_SESSION["success"] = "Success";
                        header("location: ../index.php");
                    } else {
                        $_SESSION["err"] = "OTP ไม่ถูกต้องหรือหมดเวลา";
                        header("location: ./index.php");
                    }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    } else {
        $_SESSION["err"] = "Error ไม่ทราบสาเหตุ";
         header("location: ./index.php");
    }
?>