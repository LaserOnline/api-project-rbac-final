<?php

require_once("../../Config/pdo.php");
require_once("../../Models/RandomKey/RandomKey.php");
require_once("../../Response/Response.php");
$res = new Response();
$key = new RandomKey();

$Title = $_POST["Title"];
$Detail = $_POST["Detail"];
$Star = $_POST["Star"];
$City = $_POST["City"];
$Price = $_POST["Price"];
$LocationR = $_POST["LocationR"];
$LocationL = $_POST["LocationL"];
$Relax_Key = $key->generateKey(15);

$KeyImage = $key->generateKey(5);
$Image = $_FILES["image"]["name"];
$File = $_FILES["image"]["tmp_name"];
$Extension = pathinfo($Image, PATHINFO_EXTENSION);
$NewName = "$KeyImage.$Extension";
$Size = $_FILES['image']['size'];
$Path = "../../Upload/Relax/Cover/".$NewName;
$sourceProperties = getimagesize($File);
$ImageType = $sourceProperties[2];

    if (empty($Title)) {
        $res->Message("Title Empty",404);
        mysqli_close($pdo);
    } else if (empty($Detail)) {
        $res->Message("Detail Empty",404);
        mysqli_close($pdo);
    } else if (empty($Star)) {
        $res->Message("Start Empty",404);
        mysqli_close($pdo);
    } else if (empty($LocationL)) {
        $res->Message("LocationL Empty",404);
        mysqli_close($pdo);
    } else if (empty($LocationR)) {
        $res->Message("LocationR Empty",404);
        mysqli_close($pdo);
    } else if (empty($Image)) {
        $res->Message("Empty",404);
        mysqli_close($pdo);
    } else if (empty($Price)) {
        $res->Message("Price Empty",404);
        mysqli_close($pdo);
    } else {
        
        try {

            switch ($ImageType) {

                case IMAGETYPE_PNG:
                    $imageResourceId = imagecreatefrompng($File); 
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagepng($targetLayer,$Path);      
                    $stmt = $pdo->prepare("INSERT INTO relax(Relax_Key,Title,Detail,Star,City,LocationR,LocationL,Relax_Images_Cover,Price) 
                    VALUES (:Relax_Key, :Title, :Detail, :Star, :City, :LocationR, :LocationL, :Image, :Price)");
                    $stmt->bindParam(":Relax_Key", $Relax_Key);
                    $stmt->bindParam(":Title", $Title);
                    $stmt->bindParam(":Detail", $Detail);
                    $stmt->bindParam(":Star", $Star);
                    $stmt->bindParam(":City", $City);
                    $stmt->bindParam(":Price", $Price);
                    $stmt->bindParam(":LocationR", $LocationR);
                    $stmt->bindParam(":LocationL", $LocationL);
                    $stmt->bindParam(":Image", $NewName);
                    $stmt->execute();
                    $res->Message($Relax_Key,200);
                    mysqli_close($pdo);
                    break;
                case IMAGETYPE_JPEG:
                    $imageResourceId = imagecreatefromjpeg($File); 
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($targetLayer,$Path);
                    $stmt = $pdo->prepare("INSERT INTO relax(Relax_Key,Title,Detail,Star,City,LocationR,LocationL,Relax_Images_Cover,Price) 
                    VALUES (:Relax_Key, :Title, :Detail, :Star, :City, :LocationR, :LocationL, :Image, :Price)");
                    $stmt->bindParam(":Relax_Key", $Relax_Key);
                    $stmt->bindParam(":Title", $Title);
                    $stmt->bindParam(":Detail", $Detail);
                    $stmt->bindParam(":Star", $Star);
                    $stmt->bindParam(":City", $City);
                    $stmt->bindParam(":Price", $Price);
                    $stmt->bindParam(":LocationR", $LocationR);
                    $stmt->bindParam(":LocationL", $LocationL);
                    $stmt->bindParam(":Image", $NewName);
                    $stmt->execute();
                    $res->Message($Relax_Key,200);
                    mysqli_close($pdo);
                    break;
                case IMAGETYPE_GIF:
                    $imageResourceId = imagecreatefromjpeg($File); 
                    $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($targetLayer,$Path);
                    $stmt = $pdo->prepare("INSERT INTO relax(Relax_Key,Title,Detail,Star,City,LocationR,LocationL,Relax_Images_Cover,Price) 
                    VALUES (:Relax_Key, :Title, :Detail, :Star, :City, :LocationR, :LocationL, :Image, :Price)");
                    $stmt->bindParam(":Relax_Key", $Relax_Key);
                    $stmt->bindParam(":Title", $Title);
                    $stmt->bindParam(":Detail", $Detail);
                    $stmt->bindParam(":Star", $Star);
                    $stmt->bindParam(":City", $City);
                    $stmt->bindParam(":Price", $Price);
                    $stmt->bindParam(":LocationR", $LocationR);
                    $stmt->bindParam(":LocationL", $LocationL);
                    $stmt->bindParam(":Image", $NewName);
                    $stmt->execute();
                    $res->Message($Relax_Key,200);
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



    function imageResize($imageResourceId,$width,$height) {
        $targetWidth = $width < 1280 ? $width : 1280 ;
        $targetHeight = ($height/$width)* $targetWidth;
        $targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        return $targetLayer;
    }

?>