<?php
    require_once "baslik.php";
    require_once "baglan.php";

    //güvenlik
    $_GET=array_map(function($get){
        return htmlspecialchars(trim($get));
    },$_GET);

    if(!isset($_GET["sayfa"])){
        $_GET["sayfa"]="index";
    }


    Switch($_GET["sayfa"]){

        case "index":
        require_once "anasayfa.php";
        break;
        
        case "liste":
        require_once "liste.php";
        break;

        case "sil":
        require_once "sil.php";
        break;

        case "okundu":
        require_once "okundu.php";
        break;

        case "duzenle":
        require_once "duzenle.php";
        break;

        case "carisizEkle":
        require_once "carisizEkle.php";
        break;

        case "cariEkle":
        require_once "cariEkle.php";
        break;
        
        case "cDuzenle":
        require_once "cDuzenle.php";
        break;
        
        case "cEkle":
        require_once "cEkle.php";
        break;
    }
?>