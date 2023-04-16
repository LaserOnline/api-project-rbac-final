<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();
$ID = $_GET["ID"];

    try {

        if(empty($ID)) {
        $res->Message("Error Empty ID",404);
        } else {
            $select = $pdo->prepare("SELECT * FROM hotel INNER JOIN hotel_image 
        ON hotel.Hotel_Key = hotel_image.Hotel_Key WHERE hotel.ID_Hotel = :ID_Hotel ");

        $select->bindParam(":ID_Hotel", $ID);
        $select->execute();
        $row = $select->fetchALL(PDO::FETCH_ASSOC);
        $count_data = count($row);
        $res->getData($count_data,$row,200);
        }


    } catch (PDOException $e) {
        $res->Message($e,404);
        mysqli_close($pdo);
    }
?>