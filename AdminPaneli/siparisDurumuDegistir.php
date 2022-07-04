<?php

require_once("baglan.php");

$GelenDurum = $_POST["yeniDurum"];
$SiparisNumarasi = $_POST["siparisNo"];

$duzelt = mysqli_query($veritabaniBaglantisi , "UPDATE siparisler SET SiparisDurumu = $GelenDurum WHERE SiparisNumarasi = $SiparisNumarasi");

// header("Location:Eleman_Ekle.php");

?>