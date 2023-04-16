<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();

$Content_Key = $_GET["Content_Key"];
$UserKey = $_GET["UserKey"];

    if(empty($UserKey)) {
        $res->Message("UserKey Empty",404);
    } else if (empty($Content_Key)) {
        $res->Message("Content_Key",404);
    } else {

        try {
            
            $select = $pdo->prepare("SELECT * FROM user WHERE UserKey = :UserKey");
            $select->bindParam(":UserKey", $UserKey);
            $select->execute();
            $rowUser = $select->fetchALL(PDO::FETCH_ASSOC);
            $countUser = (count($rowUser));
            
            if ($countUser > 0 ) {

                $select_user_like = $pdo->prepare("SELECT * FROM content_like WHERE UserKey = :UserKey AND Content_Key = :Content_Key");
                $select_user_like->bindParam(":Content_Key", $Content_Key);
                $select_user_like->bindParam(":UserKey", $UserKey);
                $select_user_like->execute();
                $rowUserLike = $select_user_like->fetchALL(PDO::FETCH_ASSOC);
                $countUserLike = (count($rowUserLike));

                    if ($countUserLike > 0) {

                        $Delete = "DELETE FROM content_like WHERE Content_Key = :Content_Key AND UserKey = :UserKey";
                        $Delete = $pdo->prepare($Delete);
                        $Delete->bindParam(':Content_Key', $Content_Key);
                        $Delete->bindParam(":UserKey", $UserKey);
                        $Delete->execute();

                        $select_like_content = $pdo->prepare("SELECT * FROM content WHERE Content_Key = :Content_Key");
                        $select_like_content->bindParam(":Content_Key", $Content_Key);
                        $select_like_content->execute();
                        $rowLike_Content = $select_like_content->fetchALL(PDO::FETCH_ASSOC);

                        $select_like = $rowLike_Content[0]["Content_Like"];
                        $select_like--;

                        $count_update = "UPDATE content SET Content_Like = :Content_Like WHERE Content_Key = :Content_Key";
                        $count_update = $pdo->prepare($count_update);
                        $count_update->bindParam(':Content_Key', $Content_Key);
                        $count_update->bindParam(':Content_Like', $select_like);
                        $count_update->execute();

                        $res->Message("UnLike");

                    } else {

                        $select_like_content = $pdo->prepare("SELECT * FROM content WHERE Content_Key = :Content_Key");
                        $select_like_content->bindParam(":Content_Key", $Content_Key);
                        $select_like_content->execute();
                        $rowLike_Content = $select_like_content->fetchALL(PDO::FETCH_ASSOC);

                        $stmt = $pdo->prepare("INSERT INTO content_like(Content_Key,UserKey) 
                        VALUES (:Content_Key, :UserKey)");
                        $stmt->bindParam(":Content_Key", $Content_Key);
                        $stmt->bindParam(":UserKey", $UserKey);
                        $stmt->execute();
                        $rowLike = $stmt->fetchALL(PDO::FETCH_ASSOC);
                        
                        $select_like = $rowLike_Content[0]["Content_Like"];
                        $select_like++;

                        $count_update = "UPDATE content SET Content_Like = :Content_Like WHERE Content_Key = :Content_Key";
                        $count_update = $pdo->prepare($count_update);
                        $count_update->bindParam(':Content_Key', $Content_Key);
                        $count_update->bindParam(':Content_Like', $select_like);
                        $count_update->execute();

                        $res->Message("Like");
                    }
                
                    
            } else {
                $res->Message("Not Found User",404);
            }
        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }
?>