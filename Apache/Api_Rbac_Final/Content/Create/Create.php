<?php

require_once("../../Config/pdo.php");
require_once("../../Models/RandomKey/RandomKey.php");
require_once("../../Response/Response.php");

$res = new Response();
$key = new RandomKey();


$UserKey = $_POST["UserKey"];
$Title = $_POST["Title"];
$Detail = $_POST["Detail"];
$Region = $_POST["Region"];
$Content_Key = $key->generateKey(15);

$KeyImage = $key->generateKey(3);
$Image = $_FILES["image"]["name"];
$File = $_FILES["image"]["tmp_name"];
$Extension = pathinfo($Image, PATHINFO_EXTENSION);
$NewName = "$UserKey$KeyImage.$Extension";
$Size = $_FILES['image']['size'];
$Path = "../../Upload/Content/Cover/".$NewName;
$sourceProperties = getimagesize($File);
$ImageType = $sourceProperties[2];


    if (empty($UserKey)) {
        $res->Message("UserKey Empty",404);
        mysqli_close($pdo);
    } else if (empty($Image)) {
        $res->Message("Image Empty",404);
        mysqli_close($pdo);
    } else if (empty($Title)) {
        $res->Message("กรุณาใส่หัวข้อ",404);
        mysqli_close($pdo);
    } else if (empty($Detail)) {
        $res->Message("กรุณาใส่รายละเอียด",404);
        mysqli_close($pdo);
    } else if (empty($Region)) {
        $res->Message("Empty Region",404);
        mysqli_close($pdo);
    } else {

        try {
            $select = $pdo->prepare("SELECT * FROM user WHERE UserKey = :UserKey");
            $select->bindParam(":UserKey", $UserKey);
            $select->execute();
            $rowEmail = $select->fetchALL(PDO::FETCH_ASSOC);
            if ($rowEmail[0]["UserKey"] != $UserKey) {
                $res->Message("Errro Not Found Key User",404);
            } else {
                
                try {
                    switch ($ImageType) {

                        case IMAGETYPE_PNG:
                            $imageResourceId = imagecreatefrompng($File); 
                            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                            imagepng($targetLayer,$Path);      
                            $stmt = $pdo->prepare("INSERT INTO content(Content_Key,UserKey,Content_Title,Content_Detail,Content_Region,Image) 
                            VALUES (:Content_Key, :UserKey, :Content_Title, :Content_Detail, :Content_Region, :Image)");
                            $stmt->bindParam(":Content_Key", $Content_Key);
                            $stmt->bindParam(":UserKey", $UserKey);
                            $stmt->bindParam(":Content_Title", $Title);
                            $stmt->bindParam(":Content_Detail", $Detail);
                            $stmt->bindParam(":Content_Region", $Region);
                            $stmt->bindParam(":Image", $NewName);
                            $stmt->execute();
                            $res->Message($Content_Key,200);
                            mysqli_close($pdo);
                            break;
                        case IMAGETYPE_JPEG:
                            $imageResourceId = imagecreatefromjpeg($File); 
                            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                            imagejpeg($targetLayer,$Path);
                            $stmt = $pdo->prepare("INSERT INTO content(Content_Key,UserKey,Content_Title,Content_Detail,Content_Region,Image) 
                            VALUES (:Content_Key, :UserKey, :Content_Title, :Content_Detail, :Content_Region, :Image)");
                            $stmt->bindParam(":Content_Key", $Content_Key);
                            $stmt->bindParam(":UserKey", $UserKey);
                            $stmt->bindParam(":Content_Title", $Title);
                            $stmt->bindParam(":Content_Detail", $Detail);
                            $stmt->bindParam(":Content_Region", $Region);
                            $stmt->bindParam(":Image", $NewName);
                            $stmt->execute();
                            $res->Message($Content_Key,200);
                            mysqli_close($pdo);
                            break;
                        case IMAGETYPE_GIF:
                            $imageResourceId = imagecreatefromjpeg($File); 
                            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                            imagejpeg($targetLayer,$Path);
                            $stmt = $pdo->prepare("INSERT INTO content(Content_Key,UserKey,Content_Title,Content_Detail,Content_Region,Image) 
                            VALUES (:Content_Key, :UserKey, :Content_Title, :Content_Detail, :Content_Region, :Image)");
                            $stmt->bindParam(":Content_Key", $Content_Key);
                            $stmt->bindParam(":UserKey", $UserKey);
                            $stmt->bindParam(":Content_Title", $Title);
                            $stmt->bindParam(":Content_Detail", $Detail);
                            $stmt->bindParam(":Content_Region", $Region);
                            $stmt->bindParam(":Image", $NewName);
                            $stmt->execute();
                            $res->Message($Content_Key,200);
                            mysqli_close($pdo);
                            break;
                        
                        default:
                        $res->Message("Error Type Image",404);
                        mysqli_close($pdo);
                        break;
    
                    } 
                } catch (PDOException $e) {
                    $res->Message($e,404);
                }
            }
        } catch (PDOException $e) {
            $res->Message($e,404);
        }
    }

    function imageResize($imageResourceId,$width,$height) {
        $targetWidth = $width < 1280 ? $width : 1280 ;
        $targetHeight = ($height/$width)* $targetWidth;
        $targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        return $targetLayer;
    }
?>