<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="icon" href="img/logo.png">
    <title>Şifre değiştir</title>
</head>

<body>
    <?php
        include 'datebase.php';

        $posta = @$_POST["mail"];
        $sifre = @md5($_POST["sifre"]);
        if(!empty($posta))
        {
            $sql = $db->query("SELECT COUNT(*) FROM kayitBilgi WHERE eposta='$posta'");
            $say = $sql->fetchColumn();

            if($say != 0)
            {
                $sql = $db->query("UPDATE kayitbilgi SET pwd = '$sifre' WHERE eposta = '$posta'");
                echo '<div class="output succsess text-black">Şifreniz değiştirildi</div>';
            }
            else
            {
                echo '<div class="output danger">Böyle bir e-posta bulunamadı</div>';
            }
        }
        
    ?>

    <form action="" method="post">
        <div style="position: fixed; top: 10px; left: 10px; z-index: 23; transform: scaleX(-1); font-size: 20px;">
            <a href="index.php"><i class="fa-solid fa-right-to-bracket text-black"></i></a>
        </div>
        <div class="container py-5">
            <div class="d-flex flex-column gap-3">
                <input placeholder="E-posta" type="email" name="mail" id="" class="form-control">
                <input placeholder="Yeni şifreniz" type="text" name="sifre" id="" class="form-control">

                <button type="submit" class="btn btn-primary">Değiştir</button>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
</body>
</html>