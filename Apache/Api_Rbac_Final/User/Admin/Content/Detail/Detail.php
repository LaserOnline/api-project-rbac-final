<?php

require_once("../../../../Config/pdo.php");
require_once("../../../../Response/Response.php");
$res = new Response();
$Content_Key = $_GET["Content_Key"];

    if(empty($Content_Key)){
        $res->Message("Error Empty Key",404);
    } else {
        
        try {
            $select_content = $pdo->prepare("SELECT * FROM content INNER JOIN content_image ON content.Content_Key = content_image.Content_Key 
            INNER JOIN user ON content.UserKey = user.UserKey INNER JOIN user_data ON user.UserKey = user_data.UserKey
            WHERE content.Content_Key = :Content_Key");
            $select_content->bindParam(":Content_Key", $Content_Key);
            $select_content->execute();
            $row_data = $select_content->fetchALL(PDO::FETCH_ASSOC);
            $count = count($row_data);
            $count --;
            $res->getDateContentDetail($count,$row_data,200);
        } catch (PDOException $e) {
            $res->Message($e,404);
        }

    }

?>