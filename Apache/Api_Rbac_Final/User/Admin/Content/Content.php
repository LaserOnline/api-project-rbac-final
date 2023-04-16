<?php

require_once("../../../Config/pdo.php");
require_once("../../../Response/Response.php");
$res = new Response();

    try {

        $select = $pdo->prepare("SELECT * FROM content INNER JOIN user 
        on content.UserKey = user.UserKey INNER JOIN user_data ON user.UserKey = user_data.UserKey");
        $select->execute();
        $row = $select->fetchALL(PDO::FETCH_ASSOC);
        $count = (count($row));

        $res->getData($count,$row,200);

    } catch (PDOException $e) {
        $res->Message($e,404);
    }

?>