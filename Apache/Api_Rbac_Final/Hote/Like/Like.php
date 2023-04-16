<?php
require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();
$UserKey =$_GET["UserKey"];
$Hotel_Key =$_GET["Hotel_Key"];

    if (empty($UserKey)) {
        $res->Message("Error Empty UserKey",404);
    } else if (empty($Hotel_Key)) {
        $res->Message("Error Empty UserKey",404);
    } else {

        try {
            
            $select_user_like = $pdo->prepare("SELECT * FROM hotel_like WHERE UserKey = :UserKey AND Hotel_Key = :Hotel_Key");
            $select_user_like->bindParam(":UserKey", $UserKey);
            $select_user_like->bindParam(":Hotel_Key", $Hotel_Key);
            $select_user_like->execute();
            $rowUserLike = $select_user_like->fetchALL(PDO::FETCH_ASSOC);
            $countUserLike = (count($rowUserLike));
            
                if ($countUserLike > 0) {
                        $Delete = "DELETE FROM hotel_like WHERE Hotel_Key = :Hotel_Key AND UserKey = :UserKey";
                        $Delete = $pdo->prepare($Delete);
                        $Delete->bindParam(':Hotel_Key', $Hotel_Key);
                        $Delete->bindParam(":UserKey", $UserKey);
                        $Delete->execute();
                        $res->Message("unLike");
                } else {
                        $select_like_content = $pdo->prepare("SELECT * FROM hotel WHERE Hotel_Key = :Hotel_Key");
                        $select_like_content->bindParam(":Hotel_Key", $Hotel_Key);
                        $select_like_content->execute();
                        $rowLike_Content = $select_like_content->fetchALL(PDO::FETCH_ASSOC);

                        $stmt = $pdo->prepare("INSERT INTO hotel_like(UserKey,Hotel_Key) 
                        VALUES (:UserKey, :Hotel_Key)");
                        $stmt->bindParam(":UserKey", $UserKey);
                        $stmt->bindParam(":Hotel_Key", $Hotel_Key);
                        $stmt->execute();
                        $rowLike = $stmt->fetchALL(PDO::FETCH_ASSOC);
                        $res->Message("Like");
                }
        } catch (PDOException $e) {
            $res->Message($e,404);
        }

    }

?>