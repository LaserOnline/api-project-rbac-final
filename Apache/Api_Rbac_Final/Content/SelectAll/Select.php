<?php

session_start();
require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
require_once("../../Models/Session/Session.php");
$res = new Response();

    try {

        $select_content = $pdo->prepare("SELECT * FROM content ORDER BY Primary_Key DESC");
        $select_content->execute();
        $row_content = $select_content->fetchALL(PDO::FETCH_ASSOC);
        $count_data = count($row_content);
        
        $select_Image = $pdo->prepare("SELECT Content_image FROM content INNER JOIN content_image on content.Content_Key = content_image.Content_Key ORDER BY content_image.ID_Images DESC");
        $select_Image->execute();
        $row_Image = $select_Image->fetchALL(PDO::FETCH_ASSOC);
        $res->getDataContent($count_data,$row_content,200);
 

    } catch (PDOException $e) {
        $res->Message($e,404);
        mysqli_close($pdo);
    }
    
    
?>