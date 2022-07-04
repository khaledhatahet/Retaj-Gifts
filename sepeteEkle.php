<?php

require_once("baglan.php");
session_start(); ob_start();
// require_once("kullaniciBilgileri.php");

//dd($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if(isset($_SESSION["user"])){

    if(isset( $_GET["Urunid"])){
        $GelenID = Filtre($_GET["Urunid"]);
    
    }else{
        $GelenID = "";
    }

    $KullaniciID = $_SESSION["user"];

    // dd($GelenID,$KullaniciID);

            if($GelenID != ""){


    $KullanicininSepetKontrolSorgu = mysqli_query($veritabaniBaglantisi , "SELECT * FROM sepet WHERE UyeId=$KullaniciID ORDER BY id DESC LIMIT 1");
    $KullaniciIcinSepetSayisi = mysqli_num_rows($KullanicininSepetKontrolSorgu);
    $KullanicininSepetKaydi = mysqli_fetch_assoc($KullanicininSepetKontrolSorgu);

    if($KullaniciIcinSepetSayisi > 0){


        
        $UrunSepetKontrolSorgu = mysqli_query($veritabaniBaglantisi , "SELECT * FROM sepet WHERE UyeId=$KullaniciID AND UrunId=$GelenID ORDER BY id DESC LIMIT 1");
        $UrunIcinSepetSayisi = mysqli_num_rows($UrunSepetKontrolSorgu);
        $UrunKaydi = mysqli_fetch_assoc($UrunSepetKontrolSorgu);
        $id = @$UrunKaydi['id'];
        if($UrunIcinSepetSayisi > 0){

            $UrunGuncellemeSorgusu = mysqli_query($veritabaniBaglantisi, "UPDATE sepet SET UrunAdedi = UrunAdedi+1 WHERE id = $id AND UyeId=$KullaniciID AND UrunId=$GelenID ");

            if($UrunGuncellemeSorgusu){
             ?>
             <script>
                 alert("Sepete Ekleme İşlemi Başarılı");
              
             </script>
             <?php
               header("Location:index.php");

            }else{
                echo"Bir hata Oluştu";
                
            }

        }else{

            $UrunEklemeSorgusu = mysqli_query($veritabaniBaglantisi , "INSERT INTO sepet(UyeId,UrunId,UrunAdedi) VALUES($KullaniciID,$GelenID,1)");
            $SonIdDegeri = mysqli_insert_id($veritabaniBaglantisi);
            // echo $SonIdDegeri;

            if($UrunEklemeSorgusu){
                $siparisNumarasiGuncelle = mysqli_query($veritabaniBaglantisi, "UPDATE sepet SET SepetNumarasi = $SonIdDegeri WHERE UyeId = $KullaniciID");
                if($siparisNumarasiGuncelle){
                    ?>
                    <script>
                        alert("Sepete Ekleme İşlemi Başarılı");
                    </script>
                    <?php
                    header('Location:index.php');
                }else{
                    echo"Bir hata Oluştu 1";

                }
            }
            else{
                echo"Bir hata Oluştu 2";

            }

        }

    }else{
        $UrunEklemeSorgusu = mysqli_query($veritabaniBaglantisi , "INSERT INTO sepet(UyeId,UrunId,UrunAdedi) VALUES($KullaniciID,$GelenID,1)");
        $SonIdDegeri = mysqli_insert_id($veritabaniBaglantisi);

        if($UrunEklemeSorgusu){
            $siparisNumarasiGuncelle = mysqli_query($veritabaniBaglantisi, "UPDATE sepet SET SepetNumarasi = $SonIdDegeri WHERE UyeId = $KullaniciID");
            if($siparisNumarasiGuncelle){
                ?>
             <script>
                 alert("Sepete Ekleme İşlemi Başarılı");
             </script>

             <?php
            header("Location:index.php");
            }else{
                echo"Bir hata Oluştu 3";

            }
        }
        else{
            echo"Bir hata Oluştu 4";

        }


    }


    }
    else{
        echo"Bir hata Oluştu 5";

    }
    
 }else{
    echo"Lütfen Önce Giriş Yapınız";

 }

// mysqli_close($veritabaniBaglantisi);
?>
    
</body>
</html>
