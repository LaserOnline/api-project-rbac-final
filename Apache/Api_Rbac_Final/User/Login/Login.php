<?php
session_start();

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
require_once("../../Models/Session/Session.php");

$res = new Response();
$UserEmail = strtolower($_GET['UserEmail']);
$UserPassword = $_GET['UserPassword'];

    if(empty($UserEmail)) {
        $res->MessageError($_SESSION["Plase_Enter_Email"],404);
    } else if (empty($UserPassword)) {
        $res->MessageError($_SESSION["Empty_Password"],404);
    } else {

        try {

            $select_email = $pdo->prepare("SELECT * FROM user INNER JOIN user_data on user.UserKey = user_data.UserKey WHERE UserEmail = :UserEmail ");
            $select_email->bindParam(":UserEmail", $UserEmail);
            $select_email->execute();
            $rowEmail = $select_email->fetchALL(PDO::FETCH_ASSOC);
            

                if ($rowEmail[0]["UserEmail"] == $UserEmail) {
                    if (password_verify($UserPassword,$rowEmail[0]["UserPassword"])) {
                        $res->getDataUser($rowEmail,200);
                    } else {
                        $res->ResMessage($_SESSION["Error"],$_SESSION["Incorrect_Password"],404);
                    }
                } else {
                        $res->ResMessage($_SESSION["Not_Found"],$_SESSION["Incorrect_Email"],404);
                }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>