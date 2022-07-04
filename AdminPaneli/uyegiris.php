<?php



require_once("baglan.php");

if(isset($_POST["email"])){
    $email = Filtre($_POST["email"]);
}else{
    $email = "";
}

if(isset($_POST["password"])){
    $GelenSifre = Filtre($_POST["password"]);
}else{
    $GelenSifre = "";
}



$KontrolSorgusu = mysqli_query($veritabaniBaglantisi , "SELECT * FROM eleman WHERE email='$email' AND password='$GelenSifre'");
$kayitSayisi = mysqli_num_rows($KontrolSorgusu);
if($kayitSayisi> 0){
    while($kayit = mysqli_fetch_assoc($KontrolSorgusu)){

    $_SESSION["kullanici"] = $email;
    header("Location:AnaSayfa.php");
    }
}
else{
    echo "HATA <br>";
    echo "Girilen Bilgiler Ile Eşleşen Kullanıcı Kaydı Bulunmamaktadır.";
    echo "Giriş Sayfasına Dön <a href='GirisSayfasi.php'>Tıklayınız</a>";
}

mysqli_close($veritabaniBaglantisi);
?>