<?php

require_once("baglan.php");
session_start(); ob_start();

if(isset($_SESSION["user"])){

    if(isset( $_GET["Urunid"])){
        $GelenID = Filtre($_GET["Urunid"]);
    
    }else{
        $GelenID = "";
    }

    $KullaniciID = $_SESSION["user"];

    if($GelenID != ""){
        
        $UrunGuncellemeSorgusu = mysqli_query($veritabaniBaglantisi, "UPDATE sepet SET UrunAdedi = UrunAdedi+1 WHERE  UyeId=$KullaniciID AND UrunId=$GelenID ");
        header("Location:sepetSayfasi.php");

    }
}else{
    header("Location:kullaniciGirisSayfasi.php");
}

?>