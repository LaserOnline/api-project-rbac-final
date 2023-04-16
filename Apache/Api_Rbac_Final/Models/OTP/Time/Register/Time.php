<?php
session_start();
require_once("../../../../Config/pdo.php");
require_once("../../../../Response/Response.php");
require_once("../../../Session/Session.php");

    $res = new Response();
    $otp = $_GET['otp'];

        try {

            if(empty($otp)) {
                $res->MessageError($_SESSION["Not_Found"],404);
            } else {
                $select = $pdo->prepare("SELECT * FROM register_otp WHERE OTP = :OTP ");
                $select->bindParam(":OTP", $otp);
                $select->execute();
                $row = $select->fetch(PDO::FETCH_ASSOC);             
                if(count($row)){  
                        while ($row["Time_OTP"] > 0) {
                            $row["Time_OTP"] --;
                            sleep(1);
                        }
                    $delete_sql = "DELETE FROM register_otp WHERE OTP = :OTP";
                    $delete_stmt = $pdo->prepare($delete_sql);
                    $delete_stmt->bindParam(':OTP', $otp);
                    $delete_stmt->execute();
                    $res->Message("TimeOut",200);
                }
                
            }

           
        } catch (PDOException $e) {
            echo $e->getMessage();
            $res->Message($e,404);
        }

    

?>