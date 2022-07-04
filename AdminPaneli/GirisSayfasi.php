<?php
require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="CSS/Giris_Sayfasi.css">
</head>
<body>
    <div class="sayfa">
        <?php 
        
        if(!(isset($_SESSION["kullanici"]))){
        ?>
        <img id="logo" src="resimler/logo.png">
        <div class="formAlani">
            <table>
                <form action="uyegiris.php" method="post">
                    <tr>
                        <td><input type="text" placeholder="Email" id="email" name="email"></td>
                    </tr>
                    <tr>
                        <td><input type="password" placeholder="Şifre" id="password" name="password"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Giriş" id="girisButonu"></td>
                    </tr>
                </form>
            </table>
        </div>
        <?php 
        }
        else if((isset($_SESSION["kullanici"]))){
            header("Location:AnaSayfa.php");
        }
        ?>
    </div>
</body>
</html>