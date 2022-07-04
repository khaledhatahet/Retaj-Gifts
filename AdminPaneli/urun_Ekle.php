<?php

require_once("baglan.php");
if(isset($_SESSION["kullanici"])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="CSS/urun_Ekle_style.css">
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
            <h2>Ürün Ekle</h2>
            <form action="urun_Ekle.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><input type="text" placeholder="Ürün Adı" name="ad" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Kod" name="kod" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Kg" name="kg" required></td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Ölçüleri" name="olcu" required></td>
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
                                <option value="<?php echo $kayitlar["KategoriAdi"];?>"><?php echo $kayitlar["KategoriAdi"];?></option>
                                <?php
                     }
                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Ekle" name="gonder"></td>
                    </tr>
                    
                </table>
        </article>
        <aside id="aside2">
            <table>
                <tr>
                       <td><label>Ana Fotoğraf :  </label></td> 
                        <td><input type="file" name="AnaFotograf" ></td> 
                </tr>
                <tr>
                       <td><label>1.Küçük Fotoğraf :  </label></td> 
                       <td><input type="file" name="KucukFotograf1"></td> 
                </tr>
                <tr>
                       <td><label>2.Küçük Fotoğraf :  </label></td> 
                       <td><input type="file" name="KucukFotograf2" ></td> 
                </tr>
                <tr>
                       <td><label>3.Küçük Fotoğraf :  </label></td> 
                       <td><input type="file" name="KucukFotograf3" ></td> 
                </tr>
        </table>
        </aside>
    </form>
      </article>
    </div>
</body>
</html>

<?php
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
    }
    else{
        $AnaFoto = "";
    }
    if($_FILES["KucukFotograf1"]["name"] != ""){
        //$KucukFoto1 = rand(1000,10000) . "-" . $_FILES["KucukFotograf1"]["name"];
        $path = $_FILES['KucukFotograf1']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $KucukFoto1 = rand(1000,10000).".$ext";
       $KucukFoto1tempname = $_FILES["KucukFotograf1"]["tmp_name"];    
       $folder1 = "Resimler/".$KucukFoto1;
    }
    else{
        $KucukFoto1 = "";
    }
    if($_FILES["KucukFotograf2"]["name"] != ""){
    //$KucukFoto2 = rand(1000,10000) . "-" . $_FILES["KucukFotograf2"]["name"];
    $path = $_FILES['KucukFotograf2']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
   $KucukFoto2 = rand(1000,10000).".$ext";
   $KucukFoto2tempname = $_FILES["KucukFotograf2"]["tmp_name"];    
   $folder2 = "Resimler/".$KucukFoto2;

    }
    else{
        $KucukFoto2 = "";
    }
    if($_FILES["KucukFotograf3"]["name"] != ""){
        //$KucukFoto3 = rand(1000,10000) . "-" . $_FILES["KucukFotograf3"]["name"];
        $path = $_FILES['KucukFotograf3']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $KucukFoto3 = rand(1000,10000).".$ext";
        $KucukFoto3tempname = $_FILES["KucukFotograf3"]["tmp_name"];    
        $folder3 = "Resimler/".$KucukFoto3;
    }
    else{
        $KucukFoto3 = "";
    }

   

    
   
    
    $res = mysqli_query($veritabaniBaglantisi , "SELECT * FROM urun WHERE Kod= '$kod'");
    $res1 = mysqli_num_rows($res);
    if($res1==1){
        ?>
        <script>                    
            alert("Bu Ürün Daha Önce Eklenmiş");
        </script>
        <?php
    }else{
    
      $Ekle = mysqli_query($veritabaniBaglantisi , "INSERT INTO urun(urunadi,Kod,Kg,Olcu,Anafoto,KucukFotograf1,KucukFotograf2,KucukFotograf3,KategoriAdi) VALUES('$ad' , '$kod' ,'$kg' ,'$olcu' , '$AnaFoto',' $KucukFoto1','$KucukFoto2',' $KucukFoto3','$kategori')");
      if($Ekle){
        move_uploaded_file($AnaFototempname, $folder);
        move_uploaded_file($KucukFoto1tempname, $folder1);
        move_uploaded_file($KucukFoto2tempname, $folder2);
        move_uploaded_file($KucukFoto3tempname, $folder3);
        ?>
        <script>                    
            alert("Ekleme İşlemi Başarılı");
        </script>
        <?php
    }
}
  }

}
else{
    header("Location:GirisSayfasi.php");

}
mysqli_close($veritabaniBaglantisi)

?>