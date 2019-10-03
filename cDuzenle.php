<?php

    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location:index.php");
        exit;
    }

    $sorgu=$db->prepare("SELECT * FROM cari WHERE id= ?");
    $sorgu->execute([
        $_GET["id"]
    ]);

    $cari= $sorgu->fetch(PDO::FETCH_ASSOC);

    if(!$cari){
        header("Location:index.php");
        exit;
    }
    if(isset($_POST["submit"]))
    {
        $tip=isset($_POST["tip"]) ? $_POST["tip"] :0;
        $kod=isset($_POST["kod"]) ? $_POST["kod"] :$cari["kod"];
        $ad=isset($_POST["ad"]) ? $_POST["ad"]:$cari["ad"];
        $yetkili=isset($_POST["yetkili"]) ? $_POST["yetkili"] :$cari["yetkili"];
        $adres=isset($_POST["adres"]) ? $_POST["adres"] :$cari["adres"];
        $vergi_dairesi=isset($_POST["vergi_dairesi"]) ? $_POST["vergi_dairesi"]:$cari["vergi_dairesi"];
        $vergi_numarasi=isset($_POST["vergi_numarasi"]) ? $_POST["vergi_numarasi"]:$cari["vergi_numarasi"];

        if(!$tip){
            echo "Lütfen tip bos birakmayiniz.";
        }elseif(!$kod){
            echo "Lütfen kodu bos birakmayiniz.";
        }elseif(!$ad){
            echo "Lütfen adı boş birakmayiniz.";
        }elseif(!$yetkili){
            echo "Lütfen yetkili bos birakmayiniz.";
        }elseif(!$adres){
            echo "Lütfen adresi bos birakmayiniz.";
        }elseif(!$vergi_dairesi){
            echo "Lütfen vergi dairesini bos birakmayiniz.";
        }elseif(!$vergi_numarasi){
            echo "Lütfen vergi numarasi bos birakmayiniz.";
        }else{
            $sorgu=$db->prepare("UPDATE cari SET 
            tip=?,
            kod=?,
            ad=?,
            yetkili=?,
            adres=?,
            vergi_dairesi=?,
            vergi_numarasi=? 
            WHERE id=?");

            $guncelle=$sorgu->execute([
                $tip,$kod,$ad,$yetkili,$adres,$vergi_dairesi,$vergi_numarasi, $cari["id"]
            ]);

            $sonId=$db->lastInsertId();

            if($guncelle){
                header("Location:index.php?sayfa=index");
                
            }else{
                echo "Görüşme eklenemedi";
                $hata=$sorgu->errorInfo();
                echo "MySQL Hatasi:".$hata[2];
            }
        }
    }
?>
<html lang="tr" ALIGN="center">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>ANASAYFA</title>
    <link rel="stylesheet" type="text/css" href="tasarim.css">

   
  </head>


  <body  >
 
    <div class="container">
    <div class="row justify-content-center">  
    <div class="col"> 
    <div id="icerik">
    <form action=""  method="post" ALIGN="center"> 
        TİP:<br>
            <select name="tip">
                <option <?php echo $cari["tip"]== 'yonetici' ? "selected" : "" ?> value='yonetici'>Yönetici</option>
                <option <?php echo $cari["tip"]== 'kurumsal' ? "selected" : "" ?> value='kurumsal'>Kurumsal</option>
                <option <?php echo $cari["tip"]== 'alici' ? "selected" : "" ?> value='alici'>Alıcı</option>
                <option <?php echo $cari["tip"]== 'satici' ? "selected" : "" ?> value='satici'>Satıcı</option>
            </select><br><br>
        KOD:<br>
        <input type="text"  name="kod" value="<?php echo isset($_POST["kod"]) ? $_POST['kod'] : $cari["kod"] ?>" /><br><br>
        AD:<br>
        <input type="text"  name="ad" value="<?php echo isset($_POST["ad"]) ? $_POST['ad'] : $cari["ad"] ?> " ><br><br>
        YETKİLİ:<br>
        <input type="text"  name="yetkili" value="<?php echo isset($_POST["yetkili"]) ? $_POST['yetkili'] : $cari["yetkili"] ?>" ><br><br>
        ADRES:<br>
        <textarea name="adres" cols="30" rows="5"> <?php echo isset($_POST["adres"])? $_POST['adres'] : $cari["adres"] ?> </textarea> <br><br>
        VERGİ DAİRESİ:<br>
        <input type="text"  name="vergi_dairesi" value="<?php echo isset($_POST["vergi_dairesi"]) ? $_POST['vergi_dairesi'] : $cari["vergi_dairesi"] ?> " ><br><br>
        VERGİ NUMARASI:<br>
        <input type="text"  name="vergi_numarasi" value="<?php echo isset($_POST["vergi_numarasi"]) ? $_POST['vergi_numarasi'] : $cari["vergi_numarasi"] ?>" ><br><br>

        <input type="hidden" name="submit" value="1">
        <button class="readmore" type="submit" >GÜNCELLE</button>

    </form>
 
    </div>
    </div>
    </div>
    </div>

    
  </body>
</html>

  