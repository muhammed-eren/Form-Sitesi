<?php include 'datebase.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php
        include 'header.php';  
        echo $ka = @$_GET["kadi"];
    ?>
    <div class="container-lg pt-5" id="as">
        <div class="d-flex icerik mt-5" id="geri" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div>
        <div class="w-100 anasayfa pt-2">
            <?php
                $stmt = $db->prepare("SELECT * FROM tartisma WHERE kadi=:kadi ORDER BY id DESC");
                $stmt->bindParam(':kadi', $ka, PDO::PARAM_STR);
                $stmt->execute();
                if($stmt->rowCount()) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="card shadow">
                <center><img class="card-img-top" src="<?= $row["img"] ?>" alt="" style="object-fit: contain; max-height: 350px;"></center>
                <div class="card-body">
                    <div class="d-flex mb-4 align-items-center gap-2">
                        <?php
                            $sql = $db->prepare("SELECT * FROM kayitbilgi WHERE kullaniciadi = :kadi");
                            $sql->bindParam(':kadi', $row['kadi'], PDO::PARAM_STR);
                            $sql->execute();
                            $row1 = $sql->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <img src="<?= $row1["pp"] ?>" class="rounded-circle" alt="" width="40px" height="40px">
                        <div class="m-3">
                            <h5 class="card-title isim"><?= $row["kadi"] ?></h5>
                            <h4 class="card-text fs-5"><?= $row["baslik"] ?></h4>
                        </div>
                    </div>
                    <p class="card-text px-5 m-3 mb-5" style="max-height: 90px; overflow: hidden;">
                        <?php
                            $metin = $row["yazi"];
                            if (strlen($metin) > 300) {
                                echo substr($metin, 0, 300) . " ...";
                            } else {
                                echo $metin;
                            }
                        ?>
                    </p>
                    <a class="btn primary shadow text-white w-100" style="background-color: #484e5c;" href="sohbet.php?id=<?= $row["id"] ?>">Daha fazla</a>
                </div>
            </div>
            <?php 
                    }
                } else {
                    echo '<center>Sonuç Yok</center>';
                }
            ?>
        </div>
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
            } else {
                $("body").removeClass("dark");
                check.checked = false;
            }
        });

        check.onchange = function() {
            if(check.checked) {
                localStorage.setItem('darkMode', 'true');
                $("body").addClass("dark");
            } else {
                localStorage.setItem('darkMode', 'false');
                $("body").removeClass("dark");
            }
        }
    </script>
</body>
</html>
