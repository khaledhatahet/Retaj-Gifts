<?php

require_once("baglan.php");

$GelenFotoAdi = $_GET["fotoAdi"];
$GelenFotoNo = $_GET["foto"];
$GelenId = $_GET["id"];

if($GelenFotoNo == 1){
    $DatabastenSil = mysqli_query($veritabaniBaglantisi , "UPDATE urun SET KucukFotograf1='' WHERE id = $GelenId");
}
if($GelenFotoNo == 2){
    $DatabastenSil = mysqli_query($veritabaniBaglantisi , "UPDATE urun SET KucukFotograf2='' WHERE id = $GelenId");
}
if($GelenFotoNo == 3){
    $DatabastenSil = mysqli_query($veritabaniBaglantisi , "UPDATE urun SET KucukFotograf3='' WHERE id = $GelenId");

}

 unlink("Resimler/$GelenFotoAdi");

 header("Location:urun_duzelt.php?id=$GelenId");
?>