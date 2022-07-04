<?php

require_once("baglan.php");
session_start(); ob_start();

if(isset( $_SESSION["user"])){

  $UyeId = $_SESSION["user"];

  
  $siparislerSayisiGetir = mysqli_query($veritabaniBaglantisi , "SELECT SiparisNumarasi,SiparisTarihi,SiparisDurumu,ToplamUrunFiyati FROM siparisler WHERE UyeId = $UyeId GROUP BY SiparisNumarasi");
  $siparislerSayisi = mysqli_num_rows($siparislerSayisiGetir);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retaj Gifts</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/siparislerim_sayfasi_style.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
    />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/0b54df7c74.js"></script>
    <link rel="stylesheet" href="OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="OwlCarousel2-2.3.4/docs/assets/owlcarousel/assets/owl.theme.default.min.css">
    <script src="OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js"></script>
    <script src="OwlCarousel2-2.3.4/docs/assets/owlcarousel/owl.carousel.js"></script>

    <script src="JS/fonksiyonlar.js"></script>

</head>
<body>
    <div class="sayfa">
    <div class="header" id="head">
            <svg class="telefon" xmlns="http://www.w3.org/2000/svg" width="12" height="17" viewBox="0 0 12 17">
                <path id="Shape" d="M10.5,17h-9A1.462,1.462,0,0,1,0,15.583V1.417A1.462,1.462,0,0,1,1.5,0h9A1.462,1.462,0,0,1,12,1.417V15.583A1.462,1.462,0,0,1,10.5,17ZM1.875,1.417a.366.366,0,0,0-.375.354V15.229a.365.365,0,0,0,.375.354h8.25a.365.365,0,0,0,.375-.354V1.771a.366.366,0,0,0-.375-.354ZM6,14.875a.709.709,0,1,1,.749-.708A.731.731,0,0,1,6,14.875ZM9.75,12.75H2.25V3.542h7.5v9.207ZM7.125,2.833H4.875a.355.355,0,1,1,0-.708h2.25a.355.355,0,1,1,0,.708Z" fill="#fff"/>
              </svg>
              <p class="telefonNO"><?php echo $Telefon; ?></p>
            <svg class="email" xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13">
                <path id="Shape" d="M17,13H0V0H17V13ZM5.791,6.636l-3.9,4.92h13.3L11.213,6.632,8.5,8.874ZM1.417,3.021V9.852L4.691,5.727Zm14.166,0-3.269,2.7,3.269,4.05ZM1.758,1.444,8.5,7.015l6.741-5.57Z" fill="#fff"/>
              </svg>
              
            <p class="emailadres"><?php echo $Email; ?></p>

            <?php
              if(isset($_SESSION["user"])){
                ?>

                <a href="cikis.php" class="CikisButonu">
                  <img src="resimler/logout.png" width="20px" height="20px" style="position:relative; top:4px">
                  Çıkış
                </a>
                <a href="sepetSayfasi.php" class="sepetButonu">
                  <img src="resimler/sepet.png" width="20px" height="20px" style="position:relative; top:4px">
                  Sepet
                </a>
                <a href="siparişlerimSayfasi.php" class="SiparislerimButonu">
                  <img src="resimler/siparisler.png" width="20px" height="20px" style="position:relative; top:4px">
                  Siparişlerim
                </a>

              <?php
              }else{
              ?>
              <a href="KullaniciGirisSayfasi.php" class="GirisYap">
                  Giriş Yap
                </a>
                <a href="KullaniciUyeOlSayfasi.php" class="UyeOl">
                  Üye Ol
                </a>
              <?php
              }
              ?>
        </div>
        <div class="anamenu">
            <a id="logo" href="index.php"><img src="resimler/logo.png" alt="Logo"></a>
            <ul>
            
                <li class="right-menu">
               <button class="menu-button">Kategoriler</button>
               <div class="dropdown-menu">
               <?php
                  $goster = mysqli_query($veritabaniBaglantisi , "SELECT * FROM kategori");
                  $kayitSayisi = mysqli_num_rows($goster);
                   while($kayitlar = mysqli_fetch_assoc($goster)){?>
              
                 <a href="urunler.php?kategori=<?php echo $kayitlar["KategoriAdi"];?>"><?php echo $kayitlar["KategoriAdi"];?></a>
         
               <?php } ?>

                </div>
                </li>
                <li class="ustmenu"><a class="menu" href="index.php">Ana Sayfa</a></li>
                <li class="ustmenu"><a class="menu" href="urunler.php">Ürünler</a></li>
                <li class="ustmenu"><a class="menu" href="hakkimizda.php">Hakkımızda</a></li>
                <li class="ustmenu"><a class="menu" href="iletisim.php">İletişim</a></li>
            </ul>
            <form action="urunler.php" method="Get">
                <input type="search" name="ara" id="ara" placeholder="Ara...">
            </form>
        </div>







         <article>
        <div class="AciklamaKissmi">
            <h2>Siparişlerim</h2>
             
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

                   if($siparisDurumu == 0){
                       $siparisDurumu = "İptal Edildi";
                   }else if($siparisDurumu == 1){
                       $siparisDurumu = "Sipariş Yolda";
                   }else if($siparisDurumu == 2){
                        $siparisDurumu = "sipariş tamamlandı";
                   }
                   
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
                <img src="adminPaneli/Resimler/<?php echo $foto1 ?>" class="urunfoto1" alt="">
                <img src="adminPaneli/Resimler/<?php echo $foto2 ?>" class="urunfoto2" alt="">
                <?php
                  }else if($ayniSiparisSayisiGetir == 1){ 
                    $Bilgiler= mysqli_fetch_assoc($ayniSiparisNoyaSahipSiparisler); 
                    $id = $Bilgiler["Urunid"];
                    $urunfotogetir = mysqli_query($veritabaniBaglantisi,"SELECT Anafoto FROM urun WHERE id = $id");
                    $urunbilgileri = mysqli_fetch_assoc($urunfotogetir);
                    $foto = $urunbilgileri["Anafoto"];
                ?>
                <img src="adminPaneli/Resimler/<?php echo $foto ?>" class="urunfoto1" alt="">
                <?php
                  }
                ?>
              </div>
              <div class="siparisNo">
                <h3><b>Sipariş No : <?php echo $SiparisNumarasi ?></b></h3>
                <small>29 Nisan Per, 21:25</small>
              </div>
              <div class="siparisDurumu">
                <h3><?php echo $siparisDurumu ?></h3> 
                <?php
                if($siparisDurumu == "İptal Edildi"){
                ?>
                <img src="resimler/iptal.png" alt="">
                <?php
                } else if($siparisDurumu == "Sipariş Yolda"){
                ?>
                <img src="resimler/hourglass.png" alt="">
                <?php
                }else if($siparisDurumu == "sipariş tamamlandı"){
                ?>
                <img src="resimler/teslimEdildi.png" alt="">
                <?php
                  }
                ?>
                
              </div>
              <div class="siparisTutarı">
                <h3><?php echo $ToplamUrunFiyati ?> TL</h3>
              </div>
              <div class="yukariAsagi">
                    <img class="yukariAsagiIcon" src="resimler/asagi.png" alt="">
              </div>

              <?php
                  $siparisleriGetir = mysqli_query($veritabaniBaglantisi , "SELECT * FROM siparisler WHERE UyeId = $UyeId AND SiparisNumarasi = $SiparisNumarasi");
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
                      <img src="adminPaneli/Resimler/<?php echo $urunFoto ?>" class="urunfoto1" alt="">
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
            <?php
                  }
            ?>
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
            </div>
              <?php 
            }
              ?>
                        <!--                       2.sipariş                   -->


            <!-- <div class="urun" onclick="$.SoruIcerigikGoster()">
              <div class="urunfotolari" style="position: relative; left:15px">
                <img src="resimler/urunFoto.png" class="urunfoto1" alt="">
              </div>
              <div class="siparisNo">
                <h3><b>Sipariş No : 901677620</b></h3>
                <small>29 Nisan Per, 21:25</small>
              </div>
              <div class="siparisDurumu">
                <h3>sipariş iptal edildi</h3> 
                <img src="resimler/iptal.png" alt="">
              </div>
              <div class="siparisTutarı">
                <h3>67.80 TL</h3>
              </div>
              <div class="yukariAsagi">
                    <img class="yukariAsagiIcon" src="resimler/asagi.png" alt="">
              </div>

              <div class="siparisDetayi" style="display:none;">
                  <div class="urunFotosu">
                      <img src="resimler/urunFoto.png" class="urunfoto1" alt="">
                  </div>
                  <div class="urunAdi">
                      <h3><b>Ürun Adı</b></h3>
                  </div>
                  <div class="fiyat">
                      <h3>1 Adet X 25.00 TL</h3> 
                  </div>
                  <div class="toplamTutar">
                      <h3>67.80 TL</h3>
                  </div>
            </div>
             
            </div> -->

                                    <!--                       3.sipariş                   -->

        </div>
    </article>
      









      <div class="footer">
        <img id="logo" src="resimler/logo_only_name.png" alt="Logo">
        <p> <?php 

        $yeniAdres = str_replace(",Istanbul","<br>Istanbul",$Adres);

        echo $yeniAdres ;
        
        ?></p>

        <svg xmlns="http://www.w3.org/2000/svg" width="154" height="43" viewBox="0 0 154 43" id="Group_12">
          <g id="Group_12" data-name="Group 12" transform="translate(-0.479 -0.277)">
          <a href="https://tr-tr.facebook.com/zaimuniv/" target="_blank"><path id="facebook" d="M21.5,43A21.5,21.5,0,0,1,6.3,6.3,21.5,21.5,0,1,1,36.7,36.7,21.359,21.359,0,0,1,21.5,43Zm0-39.417A17.917,17.917,0,1,0,39.417,21.5,17.937,17.937,0,0,0,21.5,3.583ZM23.291,32.25H17.917V21.5H14.333V17.917h3.583V14.885c0-2.782,1.521-4.135,4.651-4.135h4.307v4.479H24.291c-.856,0-1,.369-1,1.195v1.492h3.583L26.553,21.5H23.291V32.249Z" transform="translate(0.479 0.277)" fill="#fff"/></a>
          <a href="https://twitter.com/zaimuniv?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"> <path id="twitter" d="M21.5,43A21.5,21.5,0,0,1,6.3,6.3,21.5,21.5,0,1,1,36.7,36.7,21.359,21.359,0,0,1,21.5,43Zm0-39.417A17.917,17.917,0,1,0,39.417,21.5,17.937,17.937,0,0,0,21.5,3.583ZM18.405,31.131a12.5,12.5,0,0,1-6.759-1.981,9.049,9.049,0,0,0,1.054.062,8.812,8.812,0,0,0,5.48-1.892,4.412,4.412,0,0,1-4.121-3.062,4.42,4.42,0,0,0,1.993-.075,4.431,4.431,0,0,1-3.539-4.38,4.434,4.434,0,0,0,2,.551,4.422,4.422,0,0,1-1.365-5.89,12.571,12.571,0,0,0,9.091,4.609,4.413,4.413,0,0,1,7.516-4.022,8.805,8.805,0,0,0,2.8-1.07,4.426,4.426,0,0,1-1.94,2.44,8.808,8.808,0,0,0,2.532-.7,8.832,8.832,0,0,1-2.2,2.283A13,13,0,0,1,27.4,27.4,12.093,12.093,0,0,1,18.405,31.131Z" transform="translate(53.479 0.277)" fill="#fff"/></a>
          <a href="https://www.instagram.com/zaimuniv/?hl=tr" target="_blank">  <path id="instagram" d="M21.5,43A21.5,21.5,0,0,1,6.3,6.3,21.5,21.5,0,1,1,36.7,36.7,21.359,21.359,0,0,1,21.5,43Zm0-39.417A17.917,17.917,0,1,0,39.417,21.5,17.937,17.937,0,0,0,21.5,3.583Zm0,28.667c-2.881,0-3.266-.012-4.432-.065-3.912-.179-6.074-2.341-6.254-6.252-.052-1.143-.064-1.524-.064-4.432s.012-3.288.064-4.432c.179-3.91,2.342-6.072,6.254-6.251,1.158-.055,1.5-.067,4.432-.067s3.3.013,4.434.067c3.914.177,6.075,2.339,6.251,6.251.053,1.166.065,1.551.065,4.432s-.012,3.268-.065,4.432c-.176,3.911-2.337,6.073-6.251,6.252C24.768,32.238,24.383,32.25,21.5,32.25Zm0-19.561c-2.84,0-3.192.008-4.343.06-2.915.133-4.274,1.492-4.408,4.408-.048,1.1-.063,1.436-.063,4.343s.015,3.24.063,4.343c.136,2.914,1.5,4.273,4.408,4.407,1.13.052,1.469.063,4.343.063,2.842,0,3.186-.011,4.344-.063,2.913-.132,4.273-1.491,4.408-4.407.05-1.139.06-1.48.06-4.343s-.011-3.2-.06-4.343c-.135-2.915-1.495-4.274-4.408-4.406C24.713,12.7,24.373,12.689,21.5,12.689Zm0,14.331a5.52,5.52,0,1,1,5.52-5.52A5.526,5.526,0,0,1,21.5,27.02Zm0-9.1A3.583,3.583,0,1,0,25.085,21.5,3.587,3.587,0,0,0,21.5,17.917Zm5.736-.863a1.29,1.29,0,1,1,1.293-1.29A1.291,1.291,0,0,1,27.236,17.053Z" transform="translate(111.479 0.277)" fill="#fff"/></a>
          </g>
        </svg>
        <a href="#head"> <svg xmlns="http://www.w3.org/2000/svg" width="39.859" height="39.862" viewBox="0 0 39.859 39.862" id="to_top">
          <path id="to_top" d="M1528.835,240.277A19.931,19.931,0,1,1,1508.907,220,19.931,19.931,0,0,1,1528.835,240.277Zm-37.195,0a17.273,17.273,0,1,0,17.267-17.577,17.274,17.274,0,0,0-17.267,17.577Zm17.424-1.85-8.822,7.4a1.186,1.186,0,0,1-1.658,0,1.143,1.143,0,0,1,0-1.629l10.373-9.258,10.295,9.4a1.143,1.143,0,0,1,0,1.63,1.177,1.177,0,0,1-1.65,0l-8.708-7.474" transform="translate(-1488.976 -220)" fill="#fff" fill-rule="evenodd"/>
        </svg></a>
        
        
      </div>

      <div class="footer2">
        <p> © Retaj Gifts | All Rights Reserved | </p>
      </div>
    
    </div>
</body>
</html>
<?php
}else{
  header("Location:kullaniciGirisSayfasi.php");
  exit();
}
?>