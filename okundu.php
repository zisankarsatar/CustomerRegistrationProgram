<?php

    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location:index.php");
        exit;
    }
    
    $sorgu=$db->prepare("UPDATE gorusme SET goruldu = 1 WHERE id=?");
    $okundu=$sorgu->execute([$_GET["id"]]);

    if($okundu){
        header("Location:index.php?sayfa=liste");
    }else{
        $hata=$sorgu->errorInfo();
        echo "MySQL Hatasi:".$hata[2];
    }



?>