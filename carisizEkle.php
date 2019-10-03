<?php     
  if(isset($_POST["submit"])){
      
    $carisiz_ad=isset($_POST["carisiz_ad"]) ? $_POST["carisiz_ad"] :null;
    $tarih=isset($_POST["tarih"]) ? $_POST["tarih"] :null;
    $gorusme_tipi=isset($_POST["gorusme_tipi"]) ? $_POST["gorusme_tipi"] :0;
    $lokasyon=isset($_POST["lokasyon"]) ? $_POST["lokasyon"] :null;
    $aciklama=isset($_POST["aciklama"]) ? $_POST["aciklama"]:null;
    
    if(!$carisiz_ad){
        echo "Lütfen carisiz id belirleyiniz.";
    }elseif(!$tarih){
        echo "Lütfen tarih belirleyiniz.";
    }elseif(!$gorusme_tipi){
        echo "Lütfen görüşme şeklini belirleyiniz.";
    }elseif(!$lokasyon){
        echo "Lütfen adresi  doldurunuz.";
    }elseif(!$aciklama){
        echo "Lütfen aciklamayi doldurunuz.";
    }else{
        $sorgu=$db->prepare("INSERT INTO gorusme SET 
        carisiz_ad=?,
        tarih=?,
        gorusme_tipi=?,
        lokasyon=?,
        aciklama=? ");

        $ekle=$sorgu->execute([
            $carisiz_ad,$tarih,$gorusme_tipi,$lokasyon,$aciklama
        ]);

        $sonId=$db->lastInsertId();

        if($ekle){
            header("Location:index.php?sayfa=liste");
        
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

    <title>Duzenle</title>
    <link rel="stylesheet" type="text/css" href="tasarim.css">
  </head>

<body>
<div id="icerik">
<button class="btn btn-info" onClick="location.href='index.php?sayfa=cariEkle'">Cari Görüşme Ekle</button><hr>
<form action=""  method="post" ALIGN="center">

    CARİSİZ AD:<br>
    <input type="text" name="carisiz_ad" value="<?php echo isset($_POST["carisiz_ad"]) ? $_POST['carisiz_ad'] : null ?>" ><br><br>
    Tarih:<br>
    <input type="datetime-local" name="tarih" value="" ><br><br>
    GÖRÜŞME ŞEKLİ:<br>
        <select name="gorusme_tipi"  >
            <option value="mail">Mail</option>
            <option value="yuzyuze">Yüzyüze</option>
            <option value="telefon">Telefon</option>
        </select><br><br>
    ADRES:<br>
    <textarea name="lokasyon" placeholder="adres.."  value="<?php echo isset($_POST["lokasyon"]) ? $_POST['lokasyon'] : null ?>" cols="30" rows="5"></textarea> <br><br>
    AÇIKLAMA:<br>
    <textarea name="aciklama" placeholder="açıklama.." value="<?php echo isset($_POST["aciklama"]) ? $_POST['aciklama'] : null ?>" cols="30" rows="5"></textarea> <br><br>

    <input type="hidden" name="submit" value="1">
    <button class="readmore" type="submit" >EKLE</button>

</form>
</div>
    </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>