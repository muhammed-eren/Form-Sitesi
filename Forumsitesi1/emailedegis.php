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
        session_start();
        $ka = @$_SESSION['kullanici_adi'];
        $eskiposta = @$_POST["eskiposta"];
        $yeniposta = @$_POST["yeniposta"];

        try {
            if(empty($eskisifre))
            {
                $sql = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$ka'");
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                if($row["eposta"] == $eskiposta)
                {
                    $sql = $db->query("UPDATE kayitbilgi SET eposta = '$yeniposta' WHERE kullaniciadi = '$ka'");
                    echo '<div class="output succsess text-black">E-postanız değiştirildi</div>';
                }
                else
                {
                    echo '<div class="output danger">Eski e-postanız hatalı</div>';
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        
    ?>

    <form action="" method="post">
        <div class="container py-5">
            <?php
                if($ka =="admin"){
                    echo '<div class="icerik d-flex mb-3"><a href="admin.php" style="color: var(--color); display: flex; align-items: center; gap: 10px; text-decoration: none;"><i class="fa-solid fa-house" style="margin-bottom: 6px;"></i>Anasayfa</a></div>';
                }
                else
                {
                    echo '<div class="icerik d-flex mb-3"><a href="admin.php" style="color: var(--color); display: flex; align-items: center; gap: 10px; text-decoration: none;"><i class="fa-solid fa-house" style="margin-bottom: 6px;"></i>Anasayfa</a></div>';
                }
            ?>
            <div class="d-flex flex-column gap-3">
                <input placeholder="Eski e-postanız" type="text" name="eskiposta" id="" class="form-control">
                <input placeholder="Yeni e-postanız" type="text" name="yeniposta" id="" class="form-control">

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

<script>
  const check = document.getElementById("alert1");
  document.addEventListener("DOMContentLoaded", function() {
    const darkMode = localStorage.getItem("darkMode");

    if (darkMode === "true") {
      $("body").addClass("dark");
      check.checked = true;
    }
    else
    {
      $("body").removeClass("dark");
      check.checked = false;
    }
  });
      check.onchange = function() {
        if(check.checked)
        {
          localStorage.setItem('darkMode', 'true');
          $("body").addClass("dark");
        }
        else
        {
          localStorage.setItem('darkMode', 'false');
          $("body").removeClass("dark");
        }
    }
</script>
</body>

</html>