<?php
require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();

$UserEmail = $_GET["UserEmail"];

    if(empty($UserEmail)) {
        $res->Message("Error Empty UserKey",404);
    } else {

        try {

            $select_user = $pdo->prepare("SELECT * FROM user INNER JOIN user_data 
            on user.UserKey = user_data.UserKey WHERE UserEmail = :UserEmail");

            $select_user->bindParam(":UserEmail", $UserEmail);
            $select_user->execute();
            $rowUser = $select_user->fetchALL(PDO::FETCH_ASSOC);
            $count = (count($rowUser));
                if ($count > 0) {
                    $res->getDataUser($rowUser);
                } else {
                    $res->Message("Error Not Found User");
                }
            

        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }
?>