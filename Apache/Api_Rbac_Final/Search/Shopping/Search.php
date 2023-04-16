<?php
require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");

$res = new Response();
$Search = $_GET["Search"];

    try {

        $select = $pdo->prepare("SELECT * FROM shopping WHERE Title LIKE '%$Search%' ");
        $select->execute();
        $row = $select->fetchALL(PDO::FETCH_ASSOC); 
        $count_data = count($row);
        $res->getData($count_data,$row,200);

    } catch (PDOException $e) {
        $res->Message($e,404);
        mysqli_close($pdo);
    }
?>