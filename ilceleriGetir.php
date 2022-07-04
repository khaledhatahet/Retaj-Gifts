<?php

require_once("baglan.php");
session_start(); ob_start();

if(isset($_SESSION["user"])){

    if(isset( $_POST["il"])){
        $GelenIl = Filtre( $_POST["il"]);
        
    
    }else{
        $GelenIl = "";
    }


    $KullaniciID = $_SESSION["user"];

    if($GelenIl != ""){

        $İlceleriGetir = mysqli_query($veritabaniBaglantisi , "SELECT * FROM ilceler WHERE sehirid=$GelenIl ORDER BY ilceadi ASC");
        $İlcelerSayisi = mysqli_num_rows($İlceleriGetir);

        if($İlcelerSayisi > 0){
            
            while($ilceler = mysqli_fetch_assoc($İlceleriGetir)){
                echo  '<option value="' . $ilceler["id"] . '">' .  $ilceler["ilceadi"] . '</option>';

            }

            return $ilceler;


        }else{

        }
        
        
      

    }
}else{
    header("Location:kullaniciGirisSayfasi.php");
}

?>