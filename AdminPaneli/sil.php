<?php

require_once("baglan.php");

$Gelenad = $_GET["ad"];
$Gelensoyad = $_GET["soyisim"];

$Sil = mysqli_query($veritabaniBaglantisi , "DELETE FROM eleman WHERE ad='$Gelenad' AND soyad='$Gelensoyad'");

header("Location:Eleman_Ekle.php");

?>