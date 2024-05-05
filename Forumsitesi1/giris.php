<?php
    @session_start();

    include("datebase.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $kullanici_adi = trim($_POST['kullaniciadi']);
        $sifre = trim($_POST['pwd']);
        
        if(!$kullanici_adi || !$sifre)
        {
            echo "boş";
        }

        $param_kullanici_adi = $kullanici_adi;
        $param_sifre = md5($sifre);

        $sql = $db->query("SELECT * FROM kayitBilgi WHERE kullaniciadi = '$param_kullanici_adi' AND pwd = '$param_sifre'");
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql)
        {
            if($sql->rowCount())
            {
                $_SESSION['giris'] = true;
                $_SESSION['kullanici_adi'] = $kullanici_adi;
                $_SESSION['rol'] = $row["yetki"];
    
                
                if($row["yetki"] == "(Admin)")
                {
                    echo "admin";
                }
                else
                {
                    echo "anasayfa";
                }
            }
            else
            {
                echo "error";
            }
        }
        
        unset($stmt);
        unset($db);
    }
    ?>