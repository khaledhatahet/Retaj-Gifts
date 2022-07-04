<?php
require_once("baglan.php");

if(isset($_SESSION["kullanici"])){

     
  $siparislerSayisiGetir = mysqli_query($veritabaniBaglantisi , "SELECT SiparisNumarasi,SiparisTarihi,SiparisDurumu,ToplamUrunFiyati FROM siparisler GROUP BY SiparisNumarasi");
  $siparislerSayisi = mysqli_num_rows($siparislerSayisiGetir);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="CSS/siparisler_style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
    <script src="JS/fonksiyonlar.js"></script>

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
      <article>
         <div class="AciklamaKissmi">
            <h3 class="title">Siparişler</h3>

                <!--                       1.sipariş                   -->

                
            <?php
               //for($i = 1; $i <= $siparislerSayisi; $i++){
                 while($siparisler = mysqli_fetch_assoc($siparislerSayisiGetir)){


                   $siparisDurumu = $siparisler["SiparisDurumu"];
                   $SiparisNumarasi = $siparisler["SiparisNumarasi"];
                   $ToplamUrunFiyati = $siparisler["ToplamUrunFiyati"];
                   $SiparisTarihi = $siparisler["SiparisTarihi"];

                   $ayniSiparisNoyaSahipSiparisler = mysqli_query($veritabaniBaglantisi,"SELECT * FROM siparisler WHERE SiparisNumarasi = $SiparisNumarasi");
                   $ayniSiparisSayisiGetir = mysqli_num_rows($ayniSiparisNoyaSahipSiparisler);

                   
            ?>

            <div class="urun" onclick="$.SoruIcerigikGoster()">

                    <div class="urunfotolari">
                    <?php 
                  if($ayniSiparisSayisiGetir > 1){

                    $Bilgiler1= mysqli_fetch_assoc($ayniSiparisNoyaSahipSiparisler); 
                    $id1 = $Bilgiler1["Urunid"];
                    $urunfotogetir1 = mysqli_query($veritabaniBaglantisi,"SELECT Anafoto FROM urun WHERE id = $id1");
                    $urunbilgileri1 = mysqli_fetch_assoc($urunfotogetir1);
                    $foto1 = $urunbilgileri1["Anafoto"];

                    $Bilgiler2= mysqli_fetch_assoc($ayniSiparisNoyaSahipSiparisler); 
                    $id2 = $Bilgiler2["Urunid"];
                    $urunfotogetir2 = mysqli_query($veritabaniBaglantisi,"SELECT Anafoto FROM urun WHERE id = $id2");
                    $urunbilgileri2 = mysqli_fetch_assoc($urunfotogetir2);
                    $foto2 = $urunbilgileri2["Anafoto"];

                ?>
                        <img src="Resimler/<?php echo $foto1 ?>" class="urunfoto1" alt="">
                        <img src="Resimler/<?php echo $foto2 ?>" class="urunfoto2" alt="">
                        <?php
                  }else if($ayniSiparisSayisiGetir == 1){ 
                    $Bilgiler= mysqli_fetch_assoc($ayniSiparisNoyaSahipSiparisler); 
                    $id = $Bilgiler["Urunid"];
                    $urunfotogetir = mysqli_query($veritabaniBaglantisi,"SELECT Anafoto FROM urun WHERE id = $id");
                    $urunbilgileri = mysqli_fetch_assoc($urunfotogetir);
                    $foto = $urunbilgileri["Anafoto"];
                ?>  
                 <img src="Resimler/<?php echo $foto ?>" class="urunfoto1" alt="">
                <?php
                  }
                ?>
                    </div>
                    <div class="siparisNo">
                        <h3><b>Sipariş No :  <?php echo $SiparisNumarasi ?></b></h3>
                        <small>29 Nisan Per, 21:25</small>
                    </div>
                    <div class="siparisDurumu">
                        <!-- <h3>sipariş tamamlandı</h3> 
                        <img src="resimler/teslimEdildi.png" alt=""> -->
                        <select name="SiparisDurumu" class="SiparisDurumu" data-id="<?php echo $SiparisNumarasi ?>">
                        <option value=""></option>
                        <option value="2" <?php  if($siparisDurumu == 2){ ?> selected <?php } ?>>Teslim edildi </option>
                        <option value="0" <?php  if($siparisDurumu == 0){ ?> selected <?php } ?>>İptal edildi</option>
                        <option value="1" <?php  if($siparisDurumu == 1){ ?> selected <?php } ?>>Yolda</option>
                        </select>
                    </div>
                    <div class="siparisTutarı">
                        <h3><?php echo $ToplamUrunFiyati ?> TL</h3>
                    </div>
                    <div class="yukariAsagi">
                            <img class="yukariAsagiIcon" src="resimler/asagi.png" alt="">
                    </div>

                    <?php
                  $siparisleriGetir = mysqli_query($veritabaniBaglantisi , "SELECT * FROM siparisler WHERE SiparisNumarasi = $SiparisNumarasi");
                  while($siparisDetayi = mysqli_fetch_assoc($siparisleriGetir)){

                    $urunAdi = $siparisDetayi["UrunAdi"];
                    $urunid = $siparisDetayi["Urunid"];
                    $urunAdedi = $siparisDetayi["UrunAdedi"];

                    $urunBilgileriGetir = mysqli_query($veritabaniBaglantisi , "SELECT Anafoto,UrunFiyati FROM urun WHERE id = $urunid");
                    $urunBilgileri = mysqli_fetch_assoc($urunBilgileriGetir);

                    $urunFoto = $urunBilgileri["Anafoto"];
                    $urunFiyati = $urunBilgileri["UrunFiyati"];

              ?>
                    <div class="siparisDetayi" style="display:none;">
                  <div class="urunFotosu">
                      <img src="Resimler/<?php echo $urunFoto ?>" class="urunfoto1" alt="">
                  </div>
                  <div class="urunAdi">
                      <h3><b><?php echo $urunAdi ?></b></h3>
                  </div>
                  <div class="fiyat">
                      <h3><?php echo $urunAdedi ?> Adet X <?php echo $urunFiyati ?> TL</h3> 
                  </div>
                  <div class="toplamTutar">
                      <h3><?php echo $toplam = $urunAdedi * $urunFiyati ?> TL</h3>
                  </div>
                   </div>

                    <!-- <div class="siparisDetayi" style="display:none;">
                        <div class="urunFotosu">
                            <img src="resimler/urunFoto.png" class="urunfoto1" alt="">
                        </div>
                        <div class="urunAdi">
                            <h3><b>Ürun Adı</b></h3>
                        </div>
                        <div class="fiyat">
                            <h3>3 Adet X 25.00 TL</h3> 
                        </div>
                        <div class="toplamTutar">
                            <h3>67.80 TL</h3>
                        </div>
                    </div> -->

                    <?php 
            }
              ?>
                
            </div>
            <?php
                  }
            ?>
      
         
       
      </article>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>

    <script>
          $(document).ready(function(){

            $('.SiparisDurumu').on('change',function(){
                var durum = $(this).val();
                var siparisNo = $(this).attr("data-id");
                // alert(siparisNo)
                $.ajax({
                    url:"siparisDurumuDegistir.php",
                    type:"post",
                    data:{
                        'yeniDurum':durum,
                        'siparisNo':siparisNo
                    },
                    success:function(){
                        alert("Sipariş Durumu Güncellendi");
                    
                    }
                });
                // end of ajax call
            });

        });
    </script>
</body>
</html>
<?php
}
else{
    header("Location:GirisSayfasi.php");

}
mysqli_close($veritabaniBaglantisi);
?>