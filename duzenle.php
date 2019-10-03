<?php
    $cari_adlar=$db->query("SELECT * FROM cari ORDER BY ad ASC")->fetchAll(PDO::FETCH_ASSOC);

    if(!isset($_GET["id"]) || empty($_GET["id"])){
        header("Location:index.php");
        exit;
    }

    $sorgu=$db->prepare("SELECT * FROM gorusme WHERE id= ?");
    $sorgu->execute([
        $_GET["id"]
    ]);

    $gorusme= $sorgu->fetch(PDO::FETCH_ASSOC);

    if(!$gorusme){
        header("Location:index.php");
        exit;
    }

    if($gorusme["cari_id"]==null){
        if(isset($_POST["submit"])){
            $carisiz_ad=isset($_POST["carisiz_ad"]) ? $_POST["carisiz_ad"] :$gorusme["carisiz_ad"];
            $tarih=isset($_POST["tarih"]) ? $_POST["tarih"] : $gorusme["tarih"];
            $gorusme_tipi=isset($_POST["gorusme_tipi"]) ? $_POST["gorusme_tipi"] :0;
            $lokasyon=isset($_POST["lokasyon"]) ? $_POST["lokasyon"] :$gorusme["lokasyon"];
            $aciklama=isset($_POST["aciklama"]) ? $_POST["aciklama"]:$gorusme["aciklama"];
            
            if(!$carisiz_ad){
                echo "Lütfen carisiz ad giriniz.";
            }elseif(!$tarih){
                echo "Lütfen tarih belirleyiniz.";
            }elseif(!$gorusme_tipi){
                echo "Lütfen görüşme şeklini belirleyiniz.";
            }elseif(!$lokasyon){
                echo "Lütfen adresi  doldurunuz.";
            }elseif(!$aciklama){
                echo "Lütfen aciklamayi doldurunuz.";
            }else{
                $sorgu=$db->prepare("UPDATE gorusme SET 
                carisiz_ad=?,
                tarih=?,
                gorusme_tipi=?,
                lokasyon=?,
                aciklama=? 
                WHERE id=?");
      
                $guncelle=$sorgu->execute([
                    $carisiz_ad,$tarih,$gorusme_tipi,$lokasyon,$aciklama,$gorusme["id"]
                ]);
      
                $sonId=$db->lastInsertId();
      
                if($guncelle){
                    header("Location:index.php?sayfa=liste");
                
                }else{
                    echo "Görüşme eklenemedi"; 
                    $hata=$sorgu->errorInfo();
                    echo "MySQL Hatasi:".$hata[2];
                }
            }
      
        }
    }else{
        if(isset($_POST["submit"])){
            $cari_id=isset($_POST["cari_id"]) ? $_POST["cari_id"]:$gorusme["cari_id"];
            $tarih=isset($_POST["tarih"]) ? $_POST["tarih"] : $gorusme["tarih"];
            $gorusme_tipi=isset($_POST["gorusme_tipi"]) ? $_POST["gorusme_tipi"] :0;
            $lokasyon=isset($_POST["lokasyon"]) ? $_POST["lokasyon"] :$gorusme["lokasyon"];
            $aciklama=isset($_POST["aciklama"]) ? $_POST["aciklama"]:$gorusme["aciklama"];
            
            if(!$cari_id){
                echo "Lütfen cari seçiniz.";
            }elseif(!$tarih){
                echo "Lütfen tarih belirleyiniz.";
            }elseif(!$gorusme_tipi){
                echo "Lütfen görüşme şeklini belirleyiniz.";
            }elseif(!$lokasyon){
                echo "Lütfen adresi  doldurunuz.";
            }elseif(!$aciklama){
                echo "Lütfen aciklamayi doldurunuz.";
            }else{
                $sorgu=$db->prepare("UPDATE gorusme SET 
                cari_id=?,
                tarih=?,
                gorusme_tipi=?,
                lokasyon=?,
                aciklama=? 
                WHERE id=?");
      
                $guncelle=$sorgu->execute([
                    $cari_id,$tarih,$gorusme_tipi,$lokasyon,$aciklama,$gorusme["id"]
                ]);
      
                $sonId=$db->lastInsertId();
      
                if($guncelle){
                    header("Location:index.php?sayfa=liste");
                
                }else{
                    echo "Görüşme eklenemedi"; 
                    $hata=$sorgu->errorInfo();
                    echo "MySQL Hatasi:".$hata[2];
                }
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
    <?php if($gorusme["cari_id"]!=null):?> 
        CARİ ID:
            <select name="cari_id">
                <?php foreach ($cari_adlar as $cari_ad): ?>
                    <option value="<?php echo $cari_ad['id']?>"> <?php echo $cari_ad['ad']== $_GET["ad"] ? "selected": "" ?><?php echo $cari_ad['ad']?></option>
                <?php endforeach; ?>
            </select><br><br>
    <?php else:?>
        CARİSİZ AD:<br>
        <input type="text" name="carisiz_ad" value="<?php echo isset($_POST["carisiz_ad"]) ? $_POST['carisiz_ad'] : $gorusme["carisiz_ad"] ?>" ><br><br>
    <?php endif;?>
    Tarih:
    <input type="datetime-local" name="tarih" value="<?php echo isset($_POST["tarih"]) ? $_POST['tarih'] :$gorusme["tarih"]?>" ><br><br>
    GÖRÜŞME ŞEKLİ:
        <select name="gorusme_tipi"  >
            <option <?php echo $gorusme["gorusme_tipi"]== 'mail' ? "selected" : "" ?> value="mail">Mail</option>
            <option <?php echo $gorusme["gorusme_tipi"]== 'yuzyuze' ? "selected" : "" ?> value="yuzyuze">Yüzyüze</option>
            <option <?php echo $gorusme["gorusme_tipi"]== 'telefon' ? "selected" : "" ?> value="telefon">Telefon</option>
        </select><br><br>
    ADRES:<br>
    <textarea name="lokasyon" placeholder="adres.." cols="30" rows="5"><?php echo isset($_POST["lokasyon"]) ? $_POST['lokasyon']:$gorusme["lokasyon"] ?></textarea> <br><br>
    AÇIKLAMA:<br>
    <textarea name="aciklama" placeholder="açıklama.." cols="30" rows="5"><?php echo isset($_POST["aciklama"]) ? $_POST['aciklama'] :$gorusme["aciklama"] ?></textarea> <br><br>

    <input type="hidden" name="submit" value="1">
    <button class="" type="submit" >GÜNCELLE</button>
    </form>
    </div>
    </div>
    </div>
    </div>
  </body>
</html>

  