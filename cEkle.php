<?php

    if(isset($_POST["submit"])){
        $tip=isset($_POST["tip"])? $_POST["tip"] : 0;
        $kod=isset($_POST["kod"])? $_POST["kod"] : null;
        $ad=isset($_POST["ad"])? $_POST["ad"] : null;
        $yetkili=isset($_POST["yetkili"])? $_POST["yetkili"] : null;
        $adres=isset($_POST["adres"])? $_POST["adres"] : null;
        $vergi_dairesi=isset($_POST["vergi_dairesi"])? $_POST["vergi_dairesi"] : null;
        $vergi_numarasi=isset($_POST["vergi_numarasi"])? $_POST["vergi_numarasi"] : null;

        if(!$tip){
            echo "Tip kısmını boş bırakmayın!";
        }elseif(!$kod){
            echo "Kod kısmını boş bırakmayın!";
        }elseif(!$ad){
            echo "Ad kısmını boş bırakmayın!";
        }elseif(!$yetkili){
            echo "Yetkili kısmını boş bırakmayın!";
        }elseif(!$adres){
            echo "Adres kısmını boş bırakmayın!";
        }elseif(!$vergi_dairesi){
            echo "Vergi dairesi kısmını boş bırakmayın!";
        }elseif(!$vergi_numarasi){
            echo "Vergi numarası kısmını boş bırakmayın!";
        }else{
            $sorgu=$db->prepare("INSERT INTO cari SET
            tip=?,
            kod=?,
            ad=?,
            yetkili=?,
            adres=?,
            vergi_dairesi=?,
            vergi_numarasi=?
            ");

            $ekle=$sorgu-> execute([
                $tip,$kod,$ad,$yetkili,$adres,$vergi_dairesi,$vergi_numarasi
            ]);
            
            $sonID=$db->lastInsertId();

            if($ekle){
                header("Location:index.php");
            }else{
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
  <div id="bolumStili ">  
    <div class="container">
    <div class="row justify-content-center">  
    <div class="col"> 
    <div id="icerik">
    <form action=""  method="post" ALIGN="center"> 
    TİP:<br>
        <select name="tip">
            <option value="yonetici">Yönetici</option>
            <option value="kurumsal">Kurumsal</option>
            <option value="alici">Alıcı</option>
            <option value="satici">Satıcı</option>
        </select><br><br>
    KOD:<br>
    <input type="text"  name="kod" value=" " ><br><br>
    FİRMA ADI:<br>
    <input type="text"  name="ad" value=" " ><br><br>
    YETKİLİ:<br>
    <input type="text"  name="yetkili" value=" " ><br><br>
    ADRES:<br>
    <textarea name="adres"  value="<?php echo isset($_POST["adres"])? $_POST['adres'] : null ?>" cols="30" rows="5"></textarea> <br><br>
    VERGİ DAİRESİ:<br>
    <input type="text"  name="vergi_dairesi" value=" " ><br><br>
    VERGİ NUMARASI:<br>
    <input type="text"  name="vergi_numarasi" value=" " ><br><br>

    <input type="hidden" name="submit" value="1">
    <button class="" type="submit" >EKLE</button>

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
