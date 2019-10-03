<?php

    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location:index.php");
        exit;
    }
    
    $sorgu=$db->prepare("UPDATE cari SET durum = 2 WHERE id=?");
    $sil=$sorgu->execute([$_GET["id"]]);

    if($sil){
        header("Location:index.php?sayfa=index");
    }else{
        $hata=$sorgu->errorInfo();
        echo "MySQL Hatasi:".$hata[2];
    }



?>