<?php

session_start(); ob_start();


try{
    $veritabaniBaglantisi = mysqli_connect("localhost" , "root" ,"" , "proje");
 }
 catch(Exception $Hata){
     echo $Hata->ErrorInfo;
     die();
 }
 
 function Filtre($deger){
     $Bir = trim($deger);
     $Iki = strip_tags($Bir);
     $Uc = htmlspecialchars($Iki , ENT_QUOTES);
     $Sonuc = $Uc;
     return $Sonuc;
 }
?>