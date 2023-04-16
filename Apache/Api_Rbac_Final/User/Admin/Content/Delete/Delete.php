<?php
require_once("../../../../Config/pdo.php");
require_once("../../../../Response/Response.php");
$res = new Response();

$Content_Key = $_GET["Content_Key"];
$Dir_Delete_Details = "../../../../Upload/Content/Details/";
$Dir_Delete_Cover = "../../../../Upload/Content/Cover/";

    if(empty($Content_Key)) {
        $res->Message("Empty Content_Key",404);
    } else {

       try {

        $select_image_old = $pdo->prepare("SELECT * FROM content 
        INNER JOIN content_image ON content.Content_Key = content_image.Content_Key 
        WHERE content.Content_Key = :Content_Key");
        $select_image_old->bindParam(":Content_Key", $Content_Key);
        $select_image_old->execute();
        $rowNewImage = $select_image_old->fetchALL(PDO::FETCH_ASSOC);
        $count = count($rowNewImage);
        $count --;

        unlink($Dir_Delete_Cover.$rowNewImage[0]["Image"]);

        for ($x = 0; $x <= $count;){
            unlink($Dir_Delete_Details.$rowNewImage[$x]["Content_image"]);
            $x++;
        }

        $Delete = "DELETE content, content_comment, content_image, content_like
        FROM content 
        INNER JOIN content_comment ON content.Content_Key = content_comment.Content_Key 
        INNER JOIN content_image ON content.Content_Key = content_image.Content_Key 
        INNER JOIN content_like ON content.Content_Key = content_like.Content_Key 
        WHERE content.Content_Key = :Content_Key";

        $Delete = $pdo->prepare($Delete);
        $Delete->bindParam(':Content_Key', $Content_Key);
        $Delete->execute();
        $res->Message("Success");

        
        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }
?>