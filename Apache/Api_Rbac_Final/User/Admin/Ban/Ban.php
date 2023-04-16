<?php

require_once("../../../Config/pdo.php");
require_once("../../../Response/Response.php");
$res = new Response();
$UserEmail = $_GET["UserEmail"];
$Ban = "Ban";
    if(empty($UserEmail)) {
        $res->Message("Error Empty UserKey",404);
    } else {

        try {

            $select = "UPDATE user SET UserStstus = :UserStstus WHERE UserEmail = :UserEmail";
            $select = $pdo->prepare($select);
            $select->bindParam(':UserStstus', $Ban);
            $select->bindParam(':UserEmail', $UserEmail);
            $select->execute();
            $res->Message("Success",200);

        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }

?>