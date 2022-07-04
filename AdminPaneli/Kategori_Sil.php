<?php

require_once("baglan.php");

$Gelenad = $_GET["ad"];


$Sil = mysqli_query($veritabaniBaglantisi , "DELETE FROM kategori WHERE KategoriAdi='$Gelenad'");
$UrunSil = mysqli_query($veritabaniBaglantisi , "DELETE FROM urun WHERE KategoriAdi='$Gelenad'");

header("Location:Kategori_Ekle.php");

?>