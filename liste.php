<form method="POST" ALIGN="right" action="index.php?sayfa=liste">
  <input type="text" name="ara" value="<?php echo isset($_POST['ara']) ? $_POST["ara"]: '' ?>" placeholder="Görüşme ara">
  <button type="submit" class="btn btn-info btn-sm">>Ara</button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
</form>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script> 
  $( ".tarih" ).datepicker({
      dateFormat: "dd-mm-yy"
  });
</script>
  
<?php 
  require_once "baglan.php";
  
  $sql="SELECT COALESCE((select c.ad from cari c where c.id = g.cari_id), g.carisiz_ad) as cari_isim, g.* FROM gorusme g WHERE g.goruldu IN (0)";
  
  if(isset($_POST["ara"]) && !empty($_POST["ara"])){
    $sql.=' and COALESCE((select c.ad from cari c where c.id = g.cari_id), g.carisiz_ad)  LIKE "%'.$_POST['ara'].'%"';
  }
   
  $sorgu=$db->prepare($sql);
  $sorgu->execute();
  $gorusmeler=$sorgu->fetchALL(PDO::FETCH_OBJ);
  
?>

<html lang="tr" ALIGN="center">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>GORUSME</title>
    <link rel="stylesheet" type="text/css" href="tasarim.css">

  </head>

  <body>
  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
  <a class="btn btn-info" href="index.php?sayfa=carisizEkle" type="button" >CARİSİZ GÖRÜŞME EKLE</a>
  <a class="btn btn-info" href="index.php?sayfa=cariEkle" type="button" >CARİ GÖRÜŞME EKLE</a>
  <form action="" method="POST">
  <div id="bolumStili ">
    <div class="container">
    <div class="row justify-content-center">  
    <div class="col"> 
    <header id="bolumStili">
    <table class="table table-bordered table-striped table-white" > 
    <h4 ALIGN="center">GORUSME LİSTESİ</h4>  
    <tr>    
      <td>İD&emsp;</td>
      
      <td>AD&emsp;</td>
      <td>TARİH-SAAT&emsp;</td>
      <td>GÖRÜŞME ŞEKLİ</td>
      <td>ADRES&emsp;</td>
      <td>AÇIKLAMA&emsp;</td>
      <td>OKUNDU&emsp;</td>
      <td>DÜZENLE&emsp;</td>
    </tr>
    
    <?php foreach($gorusmeler as $gorusme){?>
    <tr>
      <td><?= $gorusme->id ?></td>
      <td><?= $gorusme->cari_isim ?></td>
      <td><?= $gorusme->tarih ?></td>
      <td><?= $gorusme->gorusme_tipi ?></td>
      <td><?= $gorusme->lokasyon ?></td>
      <td><?= $gorusme->aciklama ?></td>
      <td><a class="btn btn-success" href="index.php?sayfa=okundu&id=<?= $gorusme->id ?>"  type="button" >OKUNDU</a></td>
      <td><a class="btn btn-primary" href="index.php?sayfa=duzenle&id=<?= $gorusme->id ?>"  type="button" >DUZENLE</a></td>
    </tr>
    <?php }?>

    </table>
      </header>
    </div>
    </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      </form>
  </body>
  
</html>