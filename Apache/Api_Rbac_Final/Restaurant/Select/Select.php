<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();

try {

    $select = $pdo->prepare("SELECT * FROM restaurant ORDER BY Restaurant_ID DESC");
    $select->execute();
    $row = $select->fetchALL(PDO::FETCH_ASSOC);
    $count_data = count($row);
    $res->getData($count_data,$row,200);


} catch (PDOException $e) {
    $res->Message($e,404);
    mysqli_close($pdo);
}

?>