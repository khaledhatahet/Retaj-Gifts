<?php
require_once("baglan.php");
session_start(); ob_start();

    if(isset( $_SESSION["user"])){

        if(isset( $_POST["ad"])){
            $ad = Filtre($_POST["ad"]);
        
        }else{
            $ad = "";
        }

        if(isset( $_POST["soyad"])){
            $soyad = Filtre($_POST["soyad"]);
        
        }else{
            $soyad = "";
        }
        
        if(isset( $_POST["adres"])){
            $adres = Filtre($_POST["adres"]);
        
        }else{
            $adres = "";
        }

        if(isset( $_POST["il"])){
            $il = Filtre($_POST["il"]);
        
        }else{
            $il = "";
        }

        if(isset( $_POST["ilce"])){
            $ilce = Filtre($_POST["ilce"]);
        
        }else{
            $ilce = "";
        }

        if(isset( $_POST["telefonno"])){
            $telefonno = Filtre($_POST["telefonno"]);
        
        }else{
            $telefonno = "";
        }

        if(isset( $_POST["aciklama"])){
            $aciklama = Filtre($_POST["aciklama"]);
        
        }else{
            $aciklama = "";
        }

        if(isset( $_GET["Toplam"])){
            $sonToplamFiyat = Filtre($_GET["Toplam"]);
        
        }else{
            $sonToplamFiyat = "";
        }
     
        if(isset( $_GET["kargo"])){
            $kargo = Filtre($_GET["kargo"]);
        
        }else{
            $kargo = "";
        }

       

        if( ($ad != "") && ($soyad != "") && ($adres != "") && ($il != "") && ($ilce != "") && ($telefonno != "")  && ($sonToplamFiyat != "") && ($kargo != "") ){

            $ilGetir = mysqli_query($veritabaniBaglantisi , 'SELECT * FROM iller WHERE id =' . $il);
            $ilBilgileri = mysqli_fetch_assoc($ilGetir);
            $il = $ilBilgileri["sehiradi"];

            $ilceGetir = mysqli_query($veritabaniBaglantisi , 'SELECT * FROM ilceler WHERE id =' . $ilce);
            $ilceBilgileri = mysqli_fetch_assoc($ilceGetir);
            $ilce = $ilceBilgileri["ilceadi"];


            $UyeId = $_SESSION["user"];
            $adres = $adres . "/" . $ilce . "/" . $il;


            $sepetBilgileriGetir = mysqli_query($veritabaniBaglantisi,'SELECT * FROM sepet WHERE UyeId =' . $UyeId);
            $sepetKontrol = mysqli_num_rows($sepetBilgileriGetir);
            if($sepetKontrol > 0){

                while($sepet = mysqli_fetch_assoc($sepetBilgileriGetir)){
                    

                    $UrunId = $sepet["UrunId"];
                    $ToplamUrunFiyati = $sonToplamFiyat;
                    $KargoUcreti = $kargo;
                    $ad = $ad;
                    $soyad = $soyad;
                    $TelefonNumarasi = $telefonno;
                    $Aciklama = $aciklama;
                    $SiparisTarihi = time(); // date("Y-m-d H:i:s", 1640149864);
                    $SiparisDurumu = 1;
                    $İndirimMiktari = $sepet["SepetToplamIndirimMiktari"];

                    $urunBilgileriGetir = mysqli_query($veritabaniBaglantisi,'SELECT * FROM urun WHERE id =' . $UrunId);
                    $urunKontrol = mysqli_num_rows($urunBilgileriGetir);

                    if($urunKontrol > 0){
                        $urun = mysqli_fetch_assoc($urunBilgileriGetir);

                        $UrunAdi = $urun["urunadi"];
                        $UrunFiyati = $urun["UrunFiyati"];
                    }

                    $UrunAdedi = $sepet["UrunAdedi"];
                    $SepetNumarasi = $sepet["SepetNumarasi"];
                    $UrunAdedi = $sepet["UrunAdedi"];
                    
                    $sipariseEkle = mysqli_query($veritabaniBaglantisi , "INSERT INTO 
                    siparisler(UyeId,SiparisNumarasi,Urunid,UrunAdi,UrunFiyati,UrunAdedi,ToplamUrunFiyati,KargoUcreti,ad,soyad,adres,TelefonNumarasi,Aciklama,SiparisTarihi,SiparisDurumu,İndirimMiktari)
                    VALUES($UyeId,$SepetNumarasi,$UrunId,'$UrunAdi',$UrunFiyati,$UrunAdedi,$ToplamUrunFiyati,$KargoUcreti,'$ad','$soyad','$adres','$TelefonNumarasi','$Aciklama',$SiparisTarihi,$SiparisDurumu,$İndirimMiktari) ");
                }
               
                if($sipariseEkle){

                    $sepettenSil = mysqli_query($veritabaniBaglantisi , "DELETE FROM sepet WHERE SepetNumarasi = $SepetNumarasi AND UyeId = $UyeId");
                   
                    if($sepettenSil){

                    header('Location:index.php');

                    }
                }

            }



        }
        
    }else{
        header("Location:kullaniciGirisSayfasi.php");
        exit();
    }


?>