<?php

require_once("baglan.php");

if(isset($_POST["Hakkimizda_Guncelle"])){

    $Bilgiler = Filtre($_POST["hakkimizda"]);
    
    $BilgileriGuncelle = mysqli_query($veritabaniBaglantisi ,"UPDATE sirketinbilgileri SET Aciklama = '$Bilgiler'");
    header("Location:Sirketin_Bilgilerini_Duzelt.php");
}

if(isset($_POST["iletisim_Guncelle"])){
    $yeniEmail = Filtre($_POST["iletisim_email"]);
    $yeniTelefon = Filtre($_POST["iletisim_telefon"]);
    $yeniAdres = Filtre($_POST["iletisim_adres"]);

    $İletisimBilgileri = mysqli_query($veritabaniBaglantisi , "UPDATE sirketinbilgileri SET email='$yeniEmail',telefon='$yeniTelefon',adres='$yeniAdres'");
    header("Location:Sirketin_Bilgilerini_Duzelt.php");

}
?>