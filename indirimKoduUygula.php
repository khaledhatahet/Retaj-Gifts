<?php

require_once("baglan.php");
session_start(); ob_start();

if(isset($_SESSION["user"])){

    if(isset( $_POST["indirimkuponu"])){
        $GelenKod = Filtre( $_POST["indirimkuponu"]);
        
    
    }else{
        $GelenKod = "";
    }


    $KullaniciID = $_SESSION["user"];

    if($GelenKod != ""){

        $KodKontrol = mysqli_query($veritabaniBaglantisi , "SELECT * FROM indirimkodlari WHERE İndirimKodu='$GelenKod' LIMIT 1");
        $KodKontrolSatirSayisi = mysqli_num_rows($KodKontrol);
        $KodBilgileri = mysqli_fetch_assoc($KodKontrol);

        if($KodKontrolSatirSayisi > 0){

            $indirimMiktari = $KodBilgileri["İndirimMiktari"];

            $UrunGuncellemeSorgusu = mysqli_query($veritabaniBaglantisi, "UPDATE sepet SET SepetToplamIndirimMiktari = $indirimMiktari WHERE  UyeId=$KullaniciID ");
            header("Location:sepetSayfasi.php");

        }else{
            header("Location:sepetSayfasi.php");

        }
        
        
      

    }
}else{
    header("Location:kullaniciGirisSayfasi.php");
}

?>