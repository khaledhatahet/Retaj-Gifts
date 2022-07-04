<?php

require_once("baglan.php");

$Gelenid = $_GET["id"];

$fotoAdiGetir = mysqli_query($veritabaniBaglantisi , "SELECT * FROM urun WHERE id='$Gelenid'");
while($kayitlar = mysqli_fetch_assoc($fotoAdiGetir)){
    $AnaFoto = trim($kayitlar["Anafoto"]);
    $birincifoto = trim($kayitlar["KucukFotograf1"]);
    $ikincifoto = trim($kayitlar["KucukFotograf2"]);
    $ucuncufoto = trim($kayitlar["KucukFotograf3"]);

    unlink("Resimler/$AnaFoto");
    unlink("Resimler/$birincifoto");
    unlink("Resimler/$ikincifoto");
    unlink("Resimler/$ucuncufoto");
}

$Sil = mysqli_query($veritabaniBaglantisi , "DELETE FROM urun WHERE id='$Gelenid'");

header("Location:Urunleri_Sil.php");

?>