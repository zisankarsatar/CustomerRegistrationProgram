<form method="get" ALIGN="right">
  <input type="text" value="<?php echo isset($_GET["arama"]) ? $_GET["arama"]:'' ?>" name="arama" placeholder="Firma adı ara...">
  <button type="submit" class="btn btn-info btn-sm">ARA</button>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
</form>

<?php     
  require_once "baglan.php";

  $sql="SELECT * FROM cari WHERE durum IN (0,1)";
  if(isset($_GET["arama"])){
    $sql.=' && cari.ad LIKE "%'.$_GET['arama'].'%"';
  }
  
  $sorgu=$db->prepare($sql);
  $sorgu->execute();
  $kayitlar=$sorgu->fetchALL(PDO::FETCH_OBJ);
  
?>


<html lang="tr" ALIGN="center">
  <head>
    <title>ANASAYFA</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="tasarim.css">
  </head>
  <body>
  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
  <a class="btn btn-info" href="index.php?sayfa=cEkle" type="button" >+</a>
  <form action="" method="POST">
  <div id="bolumStili ">  
    <div class="container">
    <div class="row justify-content-center">  
    <div class="col"> 
    <header id="bolumStili">
    <table class="table table-bordered table-striped table-white" > 
      <h4 ALIGN="center">CARİ KAYIT LİSTESİ</h4>
        <tr>
          <td>İD&emsp;</td>
          <td>TİP&emsp;</td>
          <td>KOD&emsp;</td>
          <td>FİRMA ADI</td>
          <td>YETKİLİ&emsp;</td>
          <td>ADRES&emsp;</td>
          <td>SİL&emsp;</td>
          <td>DÜZENLE&emsp;</td>
      </tr>
      <?php foreach($kayitlar as $kayit){?>
      <tr>
        <td><?= $kayit->id ?></td>
        <td><?= $kayit->tip ?></td>
        <td><?= $kayit->kod ?></td>
        <td><?= $kayit->ad ?></td>
        <td><?= $kayit->yetkili ?></td>
        <td><?= $kayit->adres ?></td>
        <td><a class="btn btn-danger" href="index.php?sayfa=sil&id=<?= $kayit->id ?>" type="button" >SİL</a></td>
        <td><a class="btn btn-primary" href="index.php?sayfa=cDuzenle&id=<?= $kayit->id ?>"  type="button" >DUZENLE</a></td>
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
