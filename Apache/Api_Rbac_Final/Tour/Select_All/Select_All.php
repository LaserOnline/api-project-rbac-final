<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();
$ID = $_GET["ID"];

    try {

        if(empty($ID)) {
        $res->Message("Error Empty ID",404);
        } else {
        $select = $pdo->prepare("SELECT * FROM tour INNER JOIN tour_images 
        ON tour.Tour_Key = tour_images.Tour_Key WHERE tour.Tour_ID = :Tour_ID ");

        $select->bindParam(":Tour_ID", $ID);
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