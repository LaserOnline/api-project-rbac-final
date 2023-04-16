<?php

require_once("../../../Config/pdo.php");
require_once("../../../Response/Response.php");
$res = new Response();

$LastName = $_GET["LastName"];
$UserKey = $_GET["UserKey"];

    if  (empty($UserKey)) {
        $res->Message("Empty UserKey",404);
    } else if (empty($LastName)) {
        $res->Message("Empty LastName",404);
    } else {

        try {

            $select_user = $pdo->prepare("SELECT * FROM user_data WHERE UserKey = :UserKey");
            $select_user->bindParam(":UserKey", $UserKey);
            $select_user->execute();
            $rowUser = $select_user->fetchALL(PDO::FETCH_ASSOC);
            $count = (count($rowUser));

                if ($count > 0) {
                    
                    $update = "UPDATE user_data SET LastName = :LastName WHERE UserKey = :UserKey";
                    $update = $pdo->prepare($update);
                    $update->bindParam(':UserKey', $UserKey);
                    $update->bindParam(':LastName', $LastName);
                    $update->execute();

                    $select_new = $pdo->prepare("SELECT * FROM user_data WHERE UserKey = :UserKey");
                    $select_new->bindParam(":UserKey", $UserKey);
                    $select_new->execute();
                    $rowNew = $select_new->fetchALL(PDO::FETCH_ASSOC);

                    $res->Message($rowNew[0]["LastName"]);
                    
                    mysqli_close($pdo);
                } else {
                    $res->Message("Error Not Found User");
                }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>