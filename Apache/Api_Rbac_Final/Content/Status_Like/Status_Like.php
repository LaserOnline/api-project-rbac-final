<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();

$UserKey = $_GET["UserKey"];
$Content_Key = $_GET["Content_Key"];

    if(empty($UserKey)) {
        $res->Message("UserKey Empty",404);
    } else if (empty($Content_Key)) {
        $res->Message("Content_Key",404);
    } else {

        $select_content = $pdo->prepare("SELECT * FROM content WHERE Content_Key = :Content_Key");
        $select_content->bindParam(":Content_Key", $Content_Key);
        $select_content->execute();
        $rowContent = $select_content->fetchALL(PDO::FETCH_ASSOC);

        if ($rowContent[0]["Content_Key"] != $Content_Key) {
            $res->Message("Errro Not Found Key Content",404);
        } else {

        $select = $pdo->prepare("SELECT * FROM user WHERE UserKey = :UserKey");
        $select->bindParam(":UserKey", $UserKey);
        $select->execute();
        $rowUser = $select->fetchALL(PDO::FETCH_ASSOC);

            if($rowUser[0]["UserKey"] == $UserKey) {

                $select_like = $pdo->prepare("SELECT * FROM content_like WHERE UserKey = :UserKey AND Content_Key = :Content_Key");
                $select_like->bindParam(":Content_Key", $Content_Key);
                $select_like->bindParam(":UserKey", $UserKey);
                $select_like->execute();
                $like = $select_like->fetchALL(PDO::FETCH_ASSOC);
                $count_like = (count($like ));

                    if ($count_like > 0 ) {
                        $res->Message("Like",200);
                    } else {
                        $res->Message("UnLike",200);
                    }
                
            } else {
                $res->Message("Errro Not Found Key User",404);
            }

        }

    }
?>