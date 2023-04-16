<?php

    session_start();

    require_once("../../Config/pdo.php");
    require_once("../../Models/Session/Session.php");
    require_once("../../Response/Response.php");

    $res = new Response();
    
    try {
        $res->ConnectSuccess(true,200);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $res->ResMessage($_SESSION["Error"],$e,500);
    }
    
?>