<?php
require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();

$UserKey =$_GET["UserKey"];

    if(empty($UserKey)) {
        $res->Message("Error Empty UserKey",404);
    } else {

        try {

            $select = $pdo->prepare("SELECT * FROM hotel_like 
            INNER JOIN hotel on hotel_like.Hotel_Key = hotel.Hotel_Key WHERE UserKey = :UserKey");
            $select->bindParam(":UserKey", $UserKey);
            $select->execute();
            $rowLike = $select->fetchALL(PDO::FETCH_ASSOC);
            $countitem = count($rowLike);
            $res->getDataContent($countitem,$rowLike,200);

        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }

?>