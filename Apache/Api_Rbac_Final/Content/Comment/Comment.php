<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
require_once("../../Models/RandomKey/RandomKey.php");

$res = new Response();
$key = new RandomKey();

$UserKey = $_GET["UserKey"];
$Content_Key = $_GET["Content_Key"];
$Comment = $_GET["Comment"];

    if(empty($UserKey)) {
        $res->Message("UserKey Empty",404);
    } else if (empty($Content_Key)) {
        $res->Message("Content Empty",404);
    }else if (empty($Comment)) {
        $res->Message("Content Empty",404);
    } else {

        $select = $pdo->prepare("SELECT * FROM user WHERE UserKey = :UserKey");
        $select->bindParam(":UserKey", $UserKey);
        $select->execute();
        $rowUser = $select->fetchALL(PDO::FETCH_ASSOC);

        if ($rowUser[0]["UserKey"] != $UserKey) {
            $res->Message("Errro Not Found Key User",404);
        } else {
            $select_content = $pdo->prepare("SELECT * FROM content WHERE Content_Key = :Content_Key");
            $select_content->bindParam(":Content_Key", $Content_Key);
            $select_content->execute();
            $rowContent = $select_content->fetchALL(PDO::FETCH_ASSOC);

            if ($rowContent[0]["Content_Key"] != $Content_Key) {
                $res->Message("Errro Not Found Key Content",404);
            } else {
                
                try {

                    $stmt = $pdo->prepare("INSERT INTO content_comment(Content_Key,UserKey,Comment) 
                    VALUES (:Content_Key, :UserKey, :Comment)");
                    $stmt->bindParam(":Content_Key", $Content_Key);
                    $stmt->bindParam(":UserKey", $UserKey);
                    $stmt->bindParam(":Comment", $Comment);
                    $stmt->execute();
                    
                    $select_before_comment = $pdo->prepare("SELECT Comment FROM content WHERE Content_Key = :Content_Key");
                    $select_before_comment->bindParam(":Content_Key", $Content_Key);
                    $select_before_comment->execute();
                    $rowComment = $select_before_comment->fetchALL(PDO::FETCH_ASSOC);
                    $count_before = $rowComment[0]["Comment"];
                    $count_before ++;

                    $count_update = "UPDATE content SET Comment = :Comment WHERE Content_Key = :Content_Key";
                    $count_update = $pdo->prepare($count_update);
                    $count_update->bindParam(':Content_Key', $Content_Key);
                    $count_update->bindParam(':Comment', $count_before);
                    $count_update->execute();

                    $res->Message($count_before,200);

                } catch (PDOException $e) {
                    $res->Message($e,404);
                }
            }
        }
    }
?>