<?php
require_once("../../Config/pdo.php");
require_once("../../Response/Response.php");
require_once("../../Models/RandomKey/RandomKey.php");

$res = new Response();
$key = new RandomKey();

$Image = $_FILES["image"]["name"];
$File = $_FILES["image"]["tmp_name"];
$UserKey = $_POST["UserKey"];
$KeyImage = $key->generateKey(3);
$Extension = pathinfo($Image, PATHINFO_EXTENSION);
$NewName = "$UserKey$KeyImage.$Extension";
$Path = "../../Upload/Profile/".$NewName;
$sourceProperties = getimagesize($File);
$ImageType = $sourceProperties[2];
$Dir_Delete = "../../Upload/Profile/";

    if(empty($Image)) {
        $res->Message("Error Not Image",404);
    } else if (empty($UserKey)) {
        $res->Message("Error Not UserKey",404);
    } else {

        $select_user = $pdo->prepare("SELECT * FROM user_data WHERE UserKey = :UserKey");
        $select_user->bindParam(":UserKey", $UserKey);
        $select_user->execute();
        $rowUser = $select_user->fetchALL(PDO::FETCH_ASSOC);

        $count = (count($rowUser));

                if ($count > 0) {

                    try {
                        switch ($ImageType) {

                            case IMAGETYPE_PNG:
                            $imageResourceId = imagecreatefromjpeg($File); 
                            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                            imagejpeg($targetLayer,$Path);
                            $update = "UPDATE user_data SET UserProfile = :UserProfile WHERE UserKey = :UserKey";
                            $update = $pdo->prepare($update);
                            $update->bindParam(':UserKey', $UserKey);
                            $update->bindParam(':UserProfile', $NewName);
                            $update->execute();
                            $select_new = $pdo->prepare("SELECT * FROM user_data WHERE UserKey = :UserKey");
                            $select_new->bindParam(":UserKey", $UserKey);
                            $select_new->execute();
                            $rowNewImage = $select_new->fetchALL(PDO::FETCH_ASSOC);
                            if ($rowNewImage[0]["UserProfile"] != "User.png") {
                                unlink($Dir_Delete.$rowUser[0]["UserProfile"]);
                            }
                            $res->Message($rowNewImage[0]["UserProfile"]);
                            mysqli_close($pdo);
                            break;

                            case IMAGETYPE_JPEG:
                            $imageResourceId = imagecreatefromjpeg($File); 
                            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                            imagejpeg($targetLayer,$Path);
                            $update = "UPDATE user_data SET UserProfile = :UserProfile WHERE UserKey = :UserKey";
                            $update = $pdo->prepare($update);
                            $update->bindParam(':UserKey', $UserKey);
                            $update->bindParam(':UserProfile', $NewName);
                            $update->execute();
                            $select_new = $pdo->prepare("SELECT * FROM user_data WHERE UserKey = :UserKey");
                            $select_new->bindParam(":UserKey", $UserKey);
                            $select_new->execute();
                            $rowNewImage = $select_new->fetchALL(PDO::FETCH_ASSOC);
                            if ($rowNewImage[0]["UserProfile"] != "User.png") {
                                unlink($Dir_Delete.$rowUser[0]["UserProfile"]);
                            }
                            $res->Message($rowNewImage[0]["UserProfile"]);
                            mysqli_close($pdo);
                            break;

                            case IMAGETYPE_GIF:
                            $imageResourceId = imagecreatefromjpeg($File); 
                            $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                            imagejpeg($targetLayer,$Path);
                            $update = "UPDATE user_data SET UserProfile = :UserProfile WHERE UserKey = :UserKey";
                            $update = $pdo->prepare($update);
                            $update->bindParam(':UserKey', $UserKey);
                            $update->bindParam(':UserProfile', $NewName);
                            $update->execute();
                            $select_new = $pdo->prepare("SELECT * FROM user_data WHERE UserKey = :UserKey");
                            $select_new->bindParam(":UserKey", $UserKey);
                            $select_new->execute();
                            $rowNewImage = $select_new->fetchALL(PDO::FETCH_ASSOC);
                            if ($rowNewImage[0]["UserProfile"] != "User.png") {
                                unlink($Dir_Delete.$rowNewImage[0]["UserProfile"]);
                            }
                            $res->Message($rowUser[0]["UserProfile"]);
                            mysqli_close($pdo);
                            break;

                        }   
                    } catch (PDOException $e) {
                        $res->Message($e,404);
                    }

                } else {
                    $res->Message("Error Not Found User");
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