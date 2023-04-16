<?php
require_once("../../Config/pdo.php");
require_once("../../Models/RandomKey/RandomKey.php");
require_once("../../Response/Response.php");

$res = new Response();
$key = new RandomKey();

$tmpFile[] = $_FILES['image']['tmp_name'];
$NameFile[] = $_FILES['image']['name'];
$HotelKey = $_POST["HotelKey"];
$Path = "../../Upload/Hote/Image/";
$Rename = $key->generateKey(8);

try {
    foreach($tmpFile as $TemKey => $Tmpvalue) {
        foreach($NameFile as $NameKey => $NameValue) {
            $File = $tmpFile[$TemKey];
            $Extension = pathinfo($NameFile[$NameKey], PATHINFO_EXTENSION);
            $NewName = "$Content_Key$Rename.$Extension";
            $sourceProperties = getimagesize($tmpFile[$TemKey]);
            $imageType = $sourceProperties[2];
            $CheckType = array('jpg', 'jpge', 'png', 'gif');

            if (in_array($Extension, $CheckType)) {

                switch ($imageType) {
                    

                    case IMAGETYPE_PNG:
                        $imageResourceId = imagecreatefrompng($File); 
                        $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                        imagepng($targetLayer,$Path.$NewName);
                    

                    case IMAGETYPE_JPEG:
                        $imageResourceId = imagecreatefromjpeg($File); 
                        $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                        imagejpeg($targetLayer,$Path.$NewName);
    
                   
                    
                    case IMAGETYPE_GIF:
                        $imageResourceId = imagecreatefromjpeg($File); 
                        $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                        imagejpeg($targetLayer,$Path.$NewName);
                        

                    default:
                        $sql = "INSERT INTO hotel_image (Hotel_Key, Image) 
                        VALUES (:Hotel_Key, :Image)";
                        $stmt = $pdo->prepare($sql);
                        $params = array(
                        'Hotel_Key' => $HotelKey,
                        'Image' => $NewName,
                        );
                        $stmt->execute($params);
                        $res->Message(1 ,200);

                    exit;
                    break;

                }
            } else {
                $res->Message("Error Type",404);
            }
        }
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