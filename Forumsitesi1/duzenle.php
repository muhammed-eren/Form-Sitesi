<?php include 'datebase.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Düzenle</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="icon" href="img/logo.png">
    <style>
        body
        {
            background-color: #414141!important;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        $ka = @$_SESSION["kullanici_adi"];
        
        $newka = @$_POST["kadi"];
        $isim = @$_POST["isim"];
        $soyisim =@$_POST["soyisim"];
        $biyo = @$_POST["biyo"];
        
        $yol = "img/";

        @$pp = $yol.basename($_FILES['pp']['name']);
        move_uploaded_file(@$_FILES['pp']['tmp_name'], $pp);

        @$afis = $yol . basename($_FILES['afis']['name']);
        move_uploaded_file(@$_FILES['afis']['tmp_name'], $afis);



        try
        {
            if(isset($newka))
            {
                $sql = $db->query("UPDATE kayitBilgi SET kullaniciadi = '$newka', isim = '$isim', soyisim = '$soyisim', biyo = '$biyo' WHERE kullaniciadi = '$ka'");
                
                echo "<div class='output succsess text-black'>Kaydedildi</div>";
            }
            if($pp != $yol)
            {
                $sql = $db->query("UPDATE kayitBilgi SET pp = '$pp' WHERE kullaniciadi = '$ka'");
            }
            if($afis != $yol)
            {
                $sql = $db->query("UPDATE kayitBilgi SET afis = '$afis' WHERE kullaniciadi = '$ka'");
            }
        }
        catch(PDOException $e)
        {
            echo "Bir sorun oluştu lütfen daha sonra tekrar deneyiniz";
        }
    ?>
    <div class="container p-5">

        <div class="d-flex icerik mt-5 bg-dark text-white border" id="geri" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div>
        <div  class="w-100 anasayfa pt-2">
        <?php
            $sql = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$ka'");
            $row = $sql->fetch(PDO::FETCH_ASSOC);
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="slot d-none">
                <label class="text-white" for="ka">Kullanıcı adı</label>
                <input name="kadi" type="text" id="ka" class="form-control bg-dark text-white mb-4" value="<?=$ka?>">
            </div>

            <div class="slot ">
                <label class="text-white" for="isim">İsiminiz</label>
                <input name="isim" type="text" id="isim" class="form-control bg-dark text-white mb-4" value="<?=$row["isim"]?>">
            </div>

            <div class="slot ">
                <label class="text-white" for="soyisim">Soyisminiz</label>
                <input name="soyisim" type="text" id="soyisim" class="form-control bg-dark text-white mb-4" value="<?=$row["soyisim"]?>">
            </div>

            <div class="slot ">
                <label class="text-white" for="biyo">Biyografi</label>
                <input name="biyo" type="text" id="biyo" class="form-control bg-dark text-white mb-4" value="<?=$row["biyo"]?>">
            </div>

            <div class="slot ">
                <label class="text-white" for="file">Profil resmi</label>
                <input name="pp" type="file" id="file" class="form-control bg-dark text-white mb-4" value="<?=$row["pp"]?>">
            </div>

            <div class="slot ">
                <label class="text-white" for="afis">Afis resmi</label>
                <input name="afis" type="file" id="afis" class="form-control bg-dark text-white mb-4" value="<?=$row["afis"]?>">
            </div>

            <button type="submit" class="btn btn-outline-primary w-100">Kaydet</button>
        </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {

    function removeOutputDiv() {
        var outputDiv = document.querySelector(".output");
        if (outputDiv) {
            outputDiv.remove();
        }
    }

    setTimeout(() => {
        var outputDiv = document.querySelector(".output");
        if (outputDiv) {
            outputDiv.style.transition = "opacity 1s";
            outputDiv.style.opacity = "0";
        }
    }, 3000);

    setTimeout(removeOutputDiv, 4000);
    });
</script>
<script>
        document.getElementById("geri").addEventListener("click", function(){
            window.history.back();
        });
</script>
</body>
</html>