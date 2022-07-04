<?php


try{
    $veritabaniBaglantisi = mysqli_connect("localhost" , "root" ,"" , "proje");
 }
 catch(Exception $Hata){
     echo $Hata->ErrorInfo;
     die();
 }

 $Sorgu = mysqli_query($veritabaniBaglantisi , "SELECT * FROM sirketinbilgileri");
 $SirketinBilgileri = mysqli_fetch_array($Sorgu);

 $Aciklama = $SirketinBilgileri["Aciklama"];
 $Email = $SirketinBilgileri["email"];
 $Telefon = $SirketinBilgileri["telefon"];
 $Adres = $SirketinBilgileri["adres"];
 
 function Filtre($deger){
    $Bir = trim($deger);
    $Iki = strip_tags($Bir);
    $Uc = htmlspecialchars($Iki , ENT_QUOTES);
    $Sonuc = $Uc;
    return $Sonuc;
}


 ?>