<?php
require_once("baglan.php");
if(isset($_SESSION["kullanici"])){


    if (isset($_REQUEST["Sayfalama"])) {
        $GelenSayfalama = $_REQUEST["Sayfalama"];
    } else {
        $GelenSayfalama = 1;
    }
    
    if(isset($_GET["ara"])){
        $GelenKelime = $_GET["ara"];
        }else{
            $GelenKelime = "";
        }
    
    $SayfalamaIcinSolVeSagButonSayisi = 2;
    $SayfaBasinaGosterilecekKayitSayisi = 5;
    $ToplamKayitSayisiSorgusu = mysqli_query($veritabaniBaglantisi , "SELECT * FROM urun WHERE urunadi LIKE '%$GelenKelime%'");
    $ToplamkayitSayisi = mysqli_num_rows($ToplamKayitSayisiSorgusu);
    $SayfalamayaBaslanacakKayitSayisi = ($GelenSayfalama * $SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
    $BulunanSayfaSayisi = ceil($ToplamkayitSayisi/$SayfaBasinaGosterilecekKayitSayisi);
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="CSS/urunleri_Duzelt_style.css">

   
</head>
<body>
    <div class="sayfa">
        <a href="AnaSayfa.php"><img id="logo" src="resimler/logo.png"></a> 
        <a href="cikis.php"><button type="button" id="cikisButonu"> Çıkış</button></a>
        <form>
            <input type="search" name="ara" id="ara" placeholder="Ara...">
        </form>
        <aside>         
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
         <div class="urunler_kismi">
            <h3>Ürünler</h3>
            <div class="urun">
                <table>


                <?php
                        $goster = mysqli_query($veritabaniBaglantisi,"SELECT * FROM urun WHERE urunadi LIKE '%$GelenKelime%' ORDER BY id ASC LIMIT $SayfalamayaBaslanacakKayitSayisi , $SayfaBasinaGosterilecekKayitSayisi");
                        while($kayitlar = mysqli_fetch_assoc($goster)){
                  ?>
                    <tr>
                        <td>
                                <img class="UrunFotografi" src="Resimler/<?php echo $kayitlar["Anafoto"]; ?>">
                        </td>
                        <td>
                            <label><?php echo $kayitlar["urunadi"]?></label>
                        </td>
                        <td>
                            <label><?php echo $kayitlar["Kg"]."kg"?></label>
                        </td>
                        <td>
                            <label><?php echo $kayitlar["Olcu"]."cm"?></label>
                        </td>
                        
                        <td>
                        <a href="urun_duzelt.php?id=<?php echo $kayitlar["id"];?>"><button type="button" class="sil">Düzelt</button></a>
                        </td>
                    </tr>
                   <?php
                        }
                   ?>
                    
                    </table>

                </div>
            </div>
            <div class="SayfalamaAlaniKapsayicisi">
    <div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
        Toplam <?php echo $BulunanSayfaSayisi;?> sayfada , <?php echo $ToplamkayitSayisi ?> adet kayıt bulunmaktadır.
    </div>

    <div class="SayfalamaAlaniIciNumaralandirmaAlaniKapsayicisi">
        <?php
        
        if ($GelenSayfalama > 1) {
            echo "<span class='Pasif'><a href='urunleri_Duzelt.php?Sayfalama=1&ara=$GelenKelime'> << </a></span>";
            $SayfalamaIcinSayfaDegeriniBirGeriAl = $GelenSayfalama-1;
            echo " <span class='Pasif'><a href='urunleri_Duzelt.php?Sayfalama=$SayfalamaIcinSayfaDegeriniBirGeriAl&ara=$GelenKelime'> < </a></span>";

        }
        
        for($SayfalamaIcinSayfaIndexDeger = $GelenSayfalama-$SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDeger <= $GelenSayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDeger++){
            
            if(($SayfalamaIcinSayfaIndexDeger > 0) and ($SayfalamaIcinSayfaIndexDeger <= $BulunanSayfaSayisi)){
                
                if($SayfalamaIcinSayfaIndexDeger == $GelenSayfalama){
                    echo " <span class='Aktif'>" . $SayfalamaIcinSayfaIndexDeger . "</span>";

                }else{
                    echo "<span class='Pasif'><a href='urunleri_Duzelt.php?Sayfalama=" . $SayfalamaIcinSayfaIndexDeger . "&ara=$GelenKelime'>" . $SayfalamaIcinSayfaIndexDeger . "</a></span>";

                }
                

            }
            
        }
        

        if($GelenSayfalama!=$BulunanSayfaSayisi){
            $SayfalamaIcinSayfaDegeriniBirIleriAl = $GelenSayfalama+1;

            echo " <span class='Pasif'><a href='urunleri_Duzelt.php?Sayfalama=$SayfalamaIcinSayfaDegeriniBirIleriAl&ara=$GelenKelime'> > </a></span>";
            echo "<span class='Pasif'><a href='urunleri_Duzelt.php?Sayfalama=$BulunanSayfaSayisi&ara=$GelenKelime'> >> </a></span>";

        }
        ?>
    
    </div>
</div>
      </article>
    </div>
</body>
</html>
<?php
 }
 else{
     header("Location:GirisSayfasi.php");

 }
mysqli_close($veritabaniBaglantisi);
?>