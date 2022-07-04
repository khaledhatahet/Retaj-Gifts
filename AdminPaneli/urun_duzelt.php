<?php

require_once("baglan.php");
if(isset($_SESSION["kullanici"])){

    $GelenId = $_GET["id"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="CSS/urun_duzelt_style.css">
</head>
<body>
    <div class="sayfa">
       <a href="AnaSayfa.php"><img id="logo" src="resimler/logo.png"></a> 
        <a href="cikis.php"><button type="button" id="cikisButonu"> Çıkış</button></a>
       
        <aside id="aside1">         
            <ul>
                <li><a href="Kategori_Ekle.php"><button  class="yanliste">Kategori işlemleri</button></a></li>
                <li><a href="urun_Ekle.php"><button  class="yanliste">Ürün Ekle</button></a></li>
                <li><a href="Urunleri_Sil.php"><button  class="yanliste">Ürün Sil</button></a></li>
                <li><a href="urunleri_Duzelt.php"><button  class="yanliste">Ürün Düzelt</button></a></li>
                <li><a href="Sirketin_Bilgilerini_Duzelt.php"><button  class="yanliste">Şirketin Bilgilerini Düzelt</button></a></li>
                <li><a href="Eleman_Ekle.php"><button  class="yanliste">Eleman İşlemleri</button></a></li>
                <li><a href="siparisler.php"><button  class="yanliste">Siparişler</button></a></li>

            </ul>
      </aside>
      <article>
        <article>
            <h2>Ürün Düzelt</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                <?php
                    $BilgileriGetir = mysqli_query($veritabaniBaglantisi , "SELECT * FROM urun WHERE id=" . $GelenId);
                    while($UrunBilgiler = mysqli_fetch_assoc($BilgileriGetir)){
                        $UrunAdi = $UrunBilgiler["urunadi"];
                        $UrunKod = $UrunBilgiler["Kod"];
                        $UrunKg = $UrunBilgiler["Kg"];
                        $UrunOlcu = $UrunBilgiler["Olcu"];
                        $Urunfoto1 = Filtre($UrunBilgiler["Anafoto"]);
                        $Urunfoto2 = Filtre($UrunBilgiler["KucukFotograf1"]);
                        $Urunfoto3 = Filtre($UrunBilgiler["KucukFotograf2"]);
                        $Urunfoto4 = Filtre($UrunBilgiler["KucukFotograf3"]);
                        $UrunKategorisi = Filtre($UrunBilgiler["KategoriAdi"]);
                ?>
                    <tr>
                        <td><input type="text" placeholder="Ürün Adı" name="ad" value="<?php echo $UrunAdi;?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Kod" name="kod"  value="<?php echo $UrunKod;?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Kg" name="kg"  value="<?php echo $UrunKg;?>" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Ölçüleri" name="olcu"  value="<?php echo $UrunOlcu;?>" required></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <br><br><label id="kategori">Kategori :</label>
                            <select name="kategori_Sec" id="kategori_Sec" style="width: 250px; position:absolute;left: 100px;top: 287px;">
                            <option value="">Lütfen Seçiniz</option>
                            <?php
                            $goster = mysqli_query($veritabaniBaglantisi , "SELECT * FROM kategori");
                     $kayitSayisi = mysqli_num_rows($goster);
                      while($kayitlar = mysqli_fetch_assoc($goster)){?>
                                <option value="<?php echo $kayitlar["KategoriAdi"];?>"   <?php if($UrunKategorisi==$kayitlar["KategoriAdi"]) echo 'selected="selected"'; ?>   ><?php echo $kayitlar["KategoriAdi"];?></option>
                                <?php
                     }
                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Güncelle" name="gonder"></td>
                    </tr>
                    
                </table>
        </article>
        <aside id="aside2">
            <table class="fotoTablo">
                <tr>
                       <td><label>Ana Fotoğraf : </label></td> 
                        <td><input type="file" name="AnaFotograf"></td> 
                </tr>
                <tr>
                <td collapse="2"><img src="Resimler/<?php echo $Urunfoto1?>" class="foto1"></td>
                </tr>
                <tr>
                       <td><label>1.Küçük Fotoğraf :  </label> </td> 
                       <td><input type="file" name="KucukFotograf1"></td> 

                </tr>
                <?php if($Urunfoto2 != ""){ ?>
                <tr>
                <td collapse="2"><a href="foto_sil.php?fotoAdi=<?php echo $Urunfoto2?>&foto=1&id=<?php echo $GelenId;?>"><button type="button" class="sil">Sil</button></a></td>
                </tr>
                <tr>
                <td collapse="2"> <img src="Resimler/<?php echo $Urunfoto2?>" class="foto2"></td>
                <?php }?>
                </tr>
                <tr>
                       <td><label>2.Küçük Fotoğraf :  </label> </td> 
                       <td><input type="file" name="KucukFotograf2" ></td> 
          
                </tr>
                <?php if($Urunfoto3 != ""){ ?>
                <tr>
                <td collapse="2"><a href="foto_sil.php?fotoAdi=<?php echo $Urunfoto3?>&foto=2&id=<?php echo $GelenId;?>"><button type="button" class="sil">Sil</button></a></td>
                </tr>
                <tr>
                <td collapse="2"> <img src="Resimler/<?php echo $Urunfoto3?>" class="foto3"></td>
                <?php }?>
                </tr>
                <tr>
                       <td><label>3.Küçük Fotoğraf :  </label></td> 
                       <td><input type="file" name="KucukFotograf3"  ></td> 
                </tr>
                <?php if($Urunfoto4 != ""){ ?>
                <tr>
                <td collapse="2"><a href="foto_sil.php?fotoAdi=<?php echo $Urunfoto4?>&foto=3&id=<?php echo $GelenId;?>"><button type="button" class="sil">Sil</button></a></td>
                </tr>
                <tr>
                <td collapse="2"> <img src="Resimler/<?php echo $Urunfoto4?>" class="foto4"></td>
                <?php }?>
                </tr>
        </table>
        </aside>
    </form>
      </article>
    </div>
</body>
</html>

<?php
                    }
 if (isset($_POST['gonder'])) {
  
    $ad = $_POST["ad"];
    $kod = $_POST["kod"];
    $kg = $_POST["kg"];
    $olcu = $_POST["olcu"];
    $kategori = $_POST["kategori_Sec"];
    
    if($_FILES["AnaFotograf"]["name"] != ""){
        //$AnaFoto = rand(1000,10000) . "-" .$_FILES["AnaFotograf"]["name"];
        $path = $_FILES['AnaFotograf']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $AnaFoto = rand(1000,10000).".$ext";
        $AnaFototempname = $_FILES["AnaFotograf"]["tmp_name"];    
        $folder = "Resimler/".$AnaFoto;
    }else{
        $AnaFoto = $Urunfoto1;
    }

    
    if($_FILES["KucukFotograf1"]["name"] != ""){
         //$KucukFoto1 = rand(1000,10000) . "-" . $_FILES["KucukFotograf1"]["name"];
         $path = $_FILES['KucukFotograf1']['name'];
         $ext = pathinfo($path, PATHINFO_EXTENSION);
         $KucukFoto1 = rand(1000,10000).".$ext";
        $KucukFoto1tempname = $_FILES["KucukFotograf1"]["tmp_name"];    
        $folder1 = "Resimler/".$KucukFoto1;
    
    }else{
        $KucukFoto1 = $Urunfoto2;
    }

    if($_FILES["KucukFotograf2"]["name"] != ""){

        //$KucukFoto2 = rand(1000,10000) . "-" . $_FILES["KucukFotograf2"]["name"];
        $path = $_FILES['KucukFotograf2']['name'];
         $ext = pathinfo($path, PATHINFO_EXTENSION);
        $KucukFoto2 = rand(1000,10000).".$ext";
        $KucukFoto2tempname = $_FILES["KucukFotograf2"]["tmp_name"];    
        $folder2 = "Resimler/".$KucukFoto2;
    
    }else{
        $KucukFoto2 = $Urunfoto3;
    }

    if($_FILES["KucukFotograf3"]["name"] != ""){

        //$KucukFoto3 = rand(1000,10000) . "-" . $_FILES["KucukFotograf3"]["name"];
        $path = $_FILES['KucukFotograf3']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $KucukFoto3 = rand(1000,10000).".$ext";
        $KucukFoto3tempname = $_FILES["KucukFotograf3"]["tmp_name"];    
        $folder3 = "Resimler/".$KucukFoto3;
        
    }else{
        $KucukFoto3 = $Urunfoto4;
    }
   

   
    
    


    if($UrunKod != $kod){
    $res = mysqli_query($veritabaniBaglantisi , "SELECT * FROM urun WHERE Kod= '$kod'");
    $res1 = mysqli_num_rows($res);
    if($res1==1){
        ?>
        <script>                    
            alert("Bu Kodu Kullanamazsın");
        </script>
        <?php
    }else{
    
        $Guncelle = mysqli_query($veritabaniBaglantisi , "UPDATE urun SET urunadi = '$ad',Kod = '$kod',Kg='$kg' , Olcu='$olcu' , KategoriAdi='$kategori' , Anafoto ='$AnaFoto' , KucukFotograf1 ='$KucukFoto1' , KucukFotograf2 ='$KucukFoto2' , KucukFotograf3='$KucukFoto3' WHERE id=$GelenId");
      if($Guncelle){
        if($AnaFoto != $Urunfoto1){
            move_uploaded_file($AnaFototempname, $folder);
            unlink("Resimler/$Urunfoto1");

        }
        if($KucukFoto1 != $Urunfoto2){
            move_uploaded_file($KucukFoto1tempname, $folder1);
            unlink("Resimler/$Urunfoto2");

        }
        if($KucukFoto2 != $Urunfoto3){
            move_uploaded_file($KucukFoto2tempname, $folder2);
            unlink("Resimler/$Urunfoto3");

        }
        if($KucukFoto3 != $Urunfoto4){
            move_uploaded_file($KucukFoto3tempname, $folder3);
            unlink("Resimler/$Urunfoto4");

        }
        ?>
        <script>                    
            alert("Güncelleme İşlemi Başarılı");
        </script>
        <?php
        header("Refresh:0");
    }
}   
    }
    else{
        $Guncelle = mysqli_query($veritabaniBaglantisi , "UPDATE urun SET urunadi = '$ad',Kod = '$kod',Kg='$kg' , Olcu='$olcu' , KategoriAdi='$kategori' , Anafoto ='$AnaFoto' , KucukFotograf1 ='$KucukFoto1' , KucukFotograf2 ='$KucukFoto2' , KucukFotograf3='$KucukFoto3' WHERE id=$GelenId");
        if($Guncelle){
            if($AnaFoto != $Urunfoto1){
                move_uploaded_file($AnaFototempname, $folder);
                unlink("Resimler/$Urunfoto1");
    
            }
            if($KucukFoto1 != $Urunfoto2){
                move_uploaded_file($KucukFoto1tempname, $folder1);
                unlink("Resimler/$Urunfoto2");
    
            }
            if($KucukFoto2 != $Urunfoto3){
                move_uploaded_file($KucukFoto2tempname, $folder2);
                unlink("Resimler/$Urunfoto3");
    
            }
            if($KucukFoto3 != $Urunfoto4){
                move_uploaded_file($KucukFoto3tempname, $folder3);
                unlink("Resimler/$Urunfoto4");
    
            }
          ?>
          <script>                    
              alert("Güncelleme İşlemi Başarılı");
          </script>
          <?php
          header("Refresh:0");
      }
    }

  }

}
else{
    header("Location:GirisSayfasi.php");

}
mysqli_close($veritabaniBaglantisi)

?>