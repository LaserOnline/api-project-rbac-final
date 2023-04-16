<?php

require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");

$res = new Response();

$Region = $_GET["Region"];

    if(empty($Region)) {

        $res->Message("Empty Region",404);
        
    } else {

        try {

            $select_content = $pdo->prepare("SELECT * FROM content WHERE Content_Region = :Content_Region ORDER BY Primary_Key DESC");
            $select_content->bindParam(":Content_Region", $Region);
            $select_content->execute();
            $row_content = $select_content->fetchALL(PDO::FETCH_ASSOC);
            $count_data = count($row_content);
            
                if ($row_content[0]["Content_Region"] == $Region) {
                    $res->getDataContent($count_data,$row_content,200);
                } else {
                    $res->Message("Not Found Region",404);
                }
  
        } catch (PDOException $e) {
            $res->Message($e,404);
            mysqli_close($pdo);
        }

    }
?>