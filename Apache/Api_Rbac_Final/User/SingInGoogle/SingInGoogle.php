<?php
require_once("../../Config/pdo.php");
require_once("../../Models/RandomKey/RandomKey.php");
require_once("../../Models/Session/Session.php");
require_once("../../Response/Response.php");

$key = new RandomKey();
$res = new Response();

$UserKey = $key->generateKey(8);
$UserPlatform = "ByGoogle";
$UserStstus = "Normal";
$UserEmail = strtolower($_GET['UserEmail']);
$Username = $_GET['Username'];
$UserProfile = $_GET['UserProfile'];

    if (empty($Username)) {
        $res->Message($_SESSION["Plase_Enter_Username"],404);
    } else if (empty($UserEmail)) {
        $res->Message($_SESSION["Plase_Enter_Email"],404);
    } else if (empty($UserProfile)) {
        $res->Message($_SESSION["Error"],404);
    } else if ($UserEmail == "null" || $Username == "null") {
        $res->Message($_SESSION["Error"],404);
    } else {
        try {
            $select = $pdo->prepare("SELECT * FROM user WHERE UserEmail = :UserEmail");
            $select->bindParam(":UserEmail", $UserEmail);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC); 
            if ($row['UserEmail'] == $UserEmail) {
                $update = "UPDATE user_data SET UserProfile = :UserProfile WHERE UserKey = :UserKey";
                $update = $pdo->prepare($update);
                $update->bindParam(':UserProfile', $UserProfile);
                $update->bindParam(':UserKey', $row["UserKey"]);
                $update->execute();
                $RowUpdate = $update->fetch(PDO::FETCH_ASSOC);   
                $select_email = $pdo->prepare("SELECT * FROM user INNER JOIN user_data on user.UserKey = user_data.UserKey WHERE UserEmail = :UserEmail ");
                $select_email->bindParam(":UserEmail", $UserEmail);
                $select_email->execute();
                $rowEmail = $select_email->fetchALL(PDO::FETCH_ASSOC);
                $res->getDataUser($rowEmail[0],200); 
            } else {
                $User = $pdo->prepare("INSERT INTO user(UserPlatform,UserKey,UserStstus,UserEmail,Username) 
                VALUES (:UserPlatform, :UserKey, :UserStstus, :UserEmail, :Username)");

                $User_Data = $pdo->prepare("INSERT INTO user_data(UserKey,UserProfile) 
                VALUES (:UserKey, :UserProfile)");

                $User->bindParam(":UserPlatform", $UserPlatform);
                $User->bindParam(":UserKey", $UserKey);
                $User->bindParam(":UserStstus", $UserStstus);
                $User->bindParam(":UserEmail", $UserEmail);
                $User->bindParam(":Username", $Username);

                $User_Data->bindParam(":UserKey", $UserKey);
                $User_Data->bindParam(":UserProfile", $UserProfile);
                
                $User->execute();
                $User_Data->execute();
               
                $select_email = $pdo->prepare("SELECT * FROM user INNER JOIN user_data on user.UserKey = user_data.UserKey WHERE UserEmail = :UserEmail ");
                $select_email->bindParam(":UserEmail", $UserEmail);
                $select_email->execute();
                $rowEmail = $select_email->fetchALL(PDO::FETCH_ASSOC);
                $res->getDataUser($rowEmail[0],200); 

            }

            } catch (PDOException $e) {
                echo $e->getMessage();
                $res->Message($e,404);
            }

    }
?>