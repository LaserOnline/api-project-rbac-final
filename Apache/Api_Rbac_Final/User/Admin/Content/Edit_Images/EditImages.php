<?php

require_once("../../../../Config/pdo.php");
require_once("../../../../Response/Response.php");
require_once("../../../../Models/RandomKey/RandomKey.php");

$res = new Response();
$key = new RandomKey();

$StrID = $_POST["ID"];
$KeyImage = $key->generateKey(15);
$Image = $_FILES["image"]["name"];
$File = $_FILES["image"]["tmp_name"];
$Extension = pathinfo($Image, PATHINFO_EXTENSION);
$NewName = "$KeyImage.$Extension";
$Size = $_FILES['image']['size'];
$Path = "../../../../Upload/Content/Details/".$NewName;
$Dir_Delete = "../../../../Upload/Content/Details/";
$sourceProperties = getimagesize($File);
$ImageType = $sourceProperties[2];
$ID_Images = intval($StrID);

    try {
       
        switch ($ImageType) {

            case IMAGETYPE_PNG:
                $imageResourceId = imagecreatefrompng($File); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagepng($targetLayer,$Path);    
                $select_image_old = $pdo->prepare("SELECT * FROM content_image WHERE ID_Images = :ID_Images");
                $select_image_old->bindParam(":ID_Images", $ID_Images);
                $select_image_old->execute();
                $rowNewImage = $select_image_old->fetchALL(PDO::FETCH_ASSOC);
                unlink($Dir_Delete.$rowNewImage[0]["Content_image"]);
                $update = "UPDATE content_image SET Content_image = :Content_image WHERE ID_Images = :ID_Images";
                $update = $pdo->prepare($update);
                $update->bindParam(':ID_Images', $ID_Images);
                $update->bindParam(':Content_image', $NewName);
                $update->execute();
                $res->Message("Success",200);
                mysqli_close($pdo);  
                break;

            case IMAGETYPE_JPEG:
                $imageResourceId = imagecreatefromjpeg($File); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer,$Path);
                $select_image_old = $pdo->prepare("SELECT * FROM content_image WHERE ID_Images = :ID_Images");
                $select_image_old->bindParam(":ID_Images", $ID_Images);
                $select_image_old->execute();
                $rowNewImage = $select_image_old->fetchALL(PDO::FETCH_ASSOC);
                unlink($Dir_Delete.$rowNewImage[0]["Content_image"]);
                $update = "UPDATE content_image SET Content_image = :Content_image WHERE ID_Images = :ID_Images";
                $update = $pdo->prepare($update);
                $update->bindParam(':ID_Images', $ID_Images);
                $update->bindParam(':Content_image', $NewName);
                $update->execute();
                $res->Message("Success",200);
                mysqli_close($pdo);
                break;

            case IMAGETYPE_GIF:
                $imageResourceId = imagecreatefromjpeg($File); 
                $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($targetLayer,$Path);
                $select_image_old = $pdo->prepare("SELECT * FROM content_image WHERE ID_Images = :ID_Images");
                $select_image_old->bindParam(":ID_Images", $ID_Images);
                $select_image_old->execute();
                $rowNewImage = $select_image_old->fetchALL(PDO::FETCH_ASSOC);
                unlink($Dir_Delete.$rowNewImage[0]["Content_image"]);
                $update = "UPDATE content_image SET Content_image = :Content_image WHERE ID_Images = :ID_Images";
                $update = $pdo->prepare($update);
                $update->bindParam(':ID_Images', $ID_Images);
                $update->bindParam(':Content_image', $NewName);
                $update->execute();
                $res->Message("Success",200);
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

    function imageResize($imageResourceId,$width,$height) {
        $targetWidth = $width < 1280 ? $width : 1280 ;
        $targetHeight = ($height/$width)* $targetWidth;
        $targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        return $targetLayer;
    }

?>