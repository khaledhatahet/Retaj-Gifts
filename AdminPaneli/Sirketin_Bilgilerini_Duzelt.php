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
    <link rel="stylesheet" href="CSS/Sirketin_Bilgilerini_Duzelt_Style.css">
</head>
<body>
    <div class="sayfa">
        <a href="AnaSayfa.php"><img id="logo" src="resimler/logo.png"></a> 
        <a href="cikis.php"><button type="button" id="cikisButonu"> Çıkış</button></a>
       
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
      <article class="BuyukKisim">
        <center>
        <article class="Hakkımızda">
            <h3>Hakkımızda</h3>
            <form action="Bilgileri_Duzelt.php" method="post">
                <table>
            <?php
            $sirketBilgiGetir = mysqli_query($veritabaniBaglantisi , "SELECT * FROM SirketinBilgileri");
            while($kayitlar = mysqli_fetch_assoc($sirketBilgiGetir)){
                $Aciklama = $kayitlar['Aciklama'];
                $email =$kayitlar['email'];
                $telefon =  $kayitlar['telefon'];
                $Adres = $kayitlar['adres'];

            ?>
            <textarea name="hakkimizda" class="hakkimizda_Text"><?php echo $kayitlar['Aciklama'];?></textarea>
           
            <input type="submit" value="Güncelle" class="Hakkimizda_Guncelle" name="Hakkimizda_Guncelle">
        </table>
        </form>
        </article>
        <article class="Iletisim">
            <h3>Iletişim</h3>

            <form name="iletisim_Formu" class="iletisim_Formu" action="Bilgileri_Duzelt.php" method="post">
                <table>
                    <tr>
                        <td> <label class="yazi">Email:</label> </td>
                        <td><input type="email" name="iletisim_email" id="iletisim_email" placeholder="Email" value="<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                        <td> <label class="yazi"> Telefon:</label></td>
                        <td><input type="text" name="iletisim_telefon" id="iletisim_telefon" placeholder="Telefon" value="<?php echo $telefon;?>"></td>
                    </tr>
                    <tr>
                        <td> <label class="yazi"> Adres:</label></td>
                        <td><input type="text" name="iletisim_adres" id="iletisim_adres" placeholder="Adres" value="<?php echo $Adres;?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Güncelle" name="iletisim_Guncelle" class="iletisim_Guncelle"></td>
                    </tr>
                </table>
            </form>

        </article>
    </center>
      </article>
    </div>
</body>
</html>

<?php
            }
}
else{
    header("Location:GirisSayfasi.php");

}
mysqli_close($veritabaniBaglantisi);
?>