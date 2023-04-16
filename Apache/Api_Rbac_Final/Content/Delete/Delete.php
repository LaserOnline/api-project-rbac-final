<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
$res = new Response();

$ID = $_GET["ID"];
$Content_Key = $_GET["Content_Key"];
$params = array(
    'ID' => $ID = $_GET["ID"],
);
    if(empty($ID)) {
        $res->Message("Error Empty ID",404);
    } else if (empty($Content_Key)) {
        $res->Message("Error Empty Content Key",404);
    } else {
        $select = $pdo->prepare("SELECT * FROM content_comment WHERE ID = :ID");
        $select->bindParam(":ID", $ID);
        $select->execute();
        $rowID = $select->fetchALL(PDO::FETCH_ASSOC);
    
        if($rowID[0]["ID"] != $ID) {
            $res->Message("Not Found ID",404);
        } else {
           
            $Delete = "DELETE FROM content_comment WHERE ID = :ID";
            $Stmt_Delete = $pdo->prepare($Delete);
            $Stmt_Delete->execute($params);

            $select_before_comment = $pdo->prepare("SELECT Comment FROM content WHERE Content_Key = :Content_Key");
            $select_before_comment->bindParam(":Content_Key", $Content_Key);
            $select_before_comment->execute();
            $rowComment = $select_before_comment->fetchALL(PDO::FETCH_ASSOC);
            $count_before = $rowComment[0]["Comment"];
            $count_before --;

            $count_update = "UPDATE content SET Comment = :Comment WHERE Content_Key = :Content_Key";
            $count_update = $pdo->prepare($count_update);
            $count_update->bindParam(':Content_Key', $Content_Key);
            $count_update->bindParam(':Comment', $count_before);
            $count_update->execute();

            $res->Message("Success",200);
        }

    }
?>