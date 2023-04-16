<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");

$res = new Response();
$Content_Key = $_GET["Content_Key"];

    if(empty($Content_Key)) {
        $res->Message("Content Empty",404);
    } else {
        try {
            $select_comment = $pdo->prepare("SELECT * FROM content_comment INNER JOIN user 
            ON content_comment.UserKey = user.UserKey INNER JOIN user_data 
            ON user.UserKey = user_data.UserKey WHERE content_comment.Content_Key = :Content_Key ");
            $select_comment->bindParam(":Content_Key", $Content_Key);
            $select_comment->execute();
            $row_data = $select_comment->fetchALL(PDO::FETCH_ASSOC);
            $count = count($row_data);
            $res->getDateContentDetail($count,$row_data,200);
        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }
?>