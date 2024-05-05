<?php include 'datebase.php'; $kadi = $_GET["kadi"];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5 pt-5">
    <div class="d-flex icerik mt-5 mb-3" id="geri" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div>
        <?php
            $sql = $db->query("SELECT * FROM yorumlar WHERE kadi = '$kadi'");
            
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $id = $row["makaleid"];
                $makale = $db->query("SELECT * FROM tartisma WHERE id = '$id'");
                $mrow = $makale->fetch(PDO::FETCH_ASSOC);
                ?>
                    <div class="card mb-3">
                        <center><img class="card-img-top" src="<?= $mrow["img"] ?>" alt="" style="object-fit: contain; max-height: 350px;"></center>
                        <div class="card-body">
                            <a class="card-title text-decoration-none isim" href="sohbet.php?id=<?= $mrow["id"] ?>"><?=$mrow["baslik"]?></a>
                            <hr>
                            <div class="card-text">
                                <div class="d-flex align-items-center gap-3">
                                    <?php
                                        $isim = $row["kadi"];
                                        $sorgu = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$isim'");
                                        $row1 = $sorgu->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <img src="<?= $row1["pp"] ?>"
                                            class="rounded-circle border border-warning border-2"
                                            alt="" width="50px" height="50px"
                                            style="object-fit:cover; border 2px solid #8847A4;">
                                        <p class="m-0"
                                            style="font-size:20px"><?= $row["kadi"] . " " ?><label
                                            for="" style="font-size:15px; opacity:0.7"><?= $row1["yetki"] ?></label></p>
                                </div>
                                <div class="mt-3" style="margin-left: 60px;">
                                    <?php
                                    
                                        $metin = $row["yorum"];
                                        if (strlen($metin) > 300) {
                                            echo substr($metin, 0, 300) . " ...";
                                        } else {
                                            echo $metin;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
        document.getElementById("geri").addEventListener("click", function(){
            window.history.back();
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