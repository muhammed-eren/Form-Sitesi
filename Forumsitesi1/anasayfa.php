<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Güncel Makaleler</title>
    <!-- CSS dosyaları -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>

    <?php 
    include 'islemler.php';
    include 'header.php';
    ?>
      
    <div class="row">
        <!-- Sol Menü -->
        <div class="col">
            <div class="side_menu">
                <!-- Burger Menü -->
                <div class="burger_box">
                    <div class="menu-icon-container">
                        <a href="#" class="menu-icon js-menu_toggle closed">
                            <span class="menu-icon_box">
                                <span class="menu-icon_line menu-icon_line--1"></span>
                                <span class="menu-icon_line menu-icon_line--2"></span>
                                <span class="menu-icon_line menu-icon_line--3"></span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Kategoriler ve Oyunlar -->
                <div class="px-5">
                    <h2 class="menu_title" style="color: yellow;">SARILAR</h2>
                    <ul class="list_load">
                        <li><a class="list_item" href="anasayfa.php">Anasayfa</a></li>
                        <form action="" method="get">
                            <div class="btn-group dropend list_item">
                                <li class=" dropdown-toggle dt-button" data-bs-toggle="dropdown" aria-expanded="false">Kategori</li>
                                <ul class="dropdown-menu">
                                    <?php
                                    $sql = $db->query("SELECT * FROM kategoriler");
                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <li class="dropdown-item px-3">
                                        <button class="border border-0 w-100 bg-transparent text-start" name="k" type="submit" value="<?=$row["kad"]?>">
                                            <?= $row["kad"] ?>
                                        </button>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </form>
                        <div class="btn-group dropend list_item">
                            <li class=" dropdown-toggle dt-button" data-bs-toggle="dropdown" aria-expanded="false">Oyunlar</li>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="oyunlar/ADAMASMACAOYUN/">Adam asmaca</a></li>
                                <li><a class="dropdown-item" href="oyunlar/Gorillas - Plain JavaScript Game with HTML Canvas/index.html">Gorillas</a></li>
                                <li><a class="dropdown-item" href="oyunlar/ADAMASMACAOYUN/1v1lolX/index.html">1v1 LOL</a></li>
                            </ul>
                        </div>
                        <li class="list_item m-btn">Bildirimler</li>
                        <li class="list_item m-btn">Profil</li>
                        <li class="list_item m-btn">Tartışma aç</li>
                        <li class="list_item m-btn">Ayarlar</li>
                    </ul>
                    <!-- Diğer Bağlantılar -->
                    <div class="spacer_box"><p><hr></p></div>
                    <a href="msjList.php" class="text-white"><li class="list_item">Mesajlaşmalar</li></a>
                    <a href="hakkımızda.html" class="text-white"><li class="list_item">Hakkımızda</li></a>
                    <a href="iletisim.php" class="text-white"><li class="list_item">İletişim</li></a>
                </div>
            </div>
        </div>

        <!-- İçerik -->
        <div class="col-12 pt-5 mt-3">
            <div class="container-lg"id="as">
                <input type="text" name="" id="" class="w-100 mt-4 form-control" placeholder="Ara...">
                <div  class="w-100 anasayfa text-white">
                    <?php
                    $kategori = isset($_GET["k"]) ? $_GET["k"] : "";
                    if (!empty($kategori)) {
                        $stmt = $db->prepare("SELECT * FROM tartisma WHERE kategori = :kategori ORDER BY id DESC");
                        $stmt->bindParam(':kategori', $kategori, PDO::PARAM_STR);
                    } else {
                        $stmt = $db->prepare("SELECT * FROM tartisma ORDER BY id DESC");
                    }

                    $stmt->execute();
                    if($stmt->rowCount()) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="card shadow">
                        <center><img class="card-img-top" src="<?= $row["img"] ?>" alt="" style="object-fit: contain; max-height: 350px; "></center>
                        <div class="card-body">
                            <div class="d-flex mb-4 align-items-center gap-2">
                                <?php
                                $sql = $db->prepare("SELECT * FROM kayitbilgi WHERE kullaniciadi = :kadi");
                                $sql->bindParam(':kadi', $row['kadi'], PDO::PARAM_STR);
                                $sql->execute();
                                $row1 = $sql->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <a href="profil.php?kadi=<?= $row["kadi"] ?>&p=a"><img src="<?= $row1["pp"] ?>" class="rounded-circle border border-warning border-2" alt="" width="50px" height="50px" style="object-fit:cover; border 2px solid #8847A4;"></a>
                                <h5 class="card-title"><a class="isim" href="profil.php?kadi=<?= $row["kadi"]?>&p=a"><?= $row["kadi"]." " ?><label for="" style="font-size:15px; opacity:0.7"><?=$row1["yetki"]?></label></a></h5>
                            </div>
                            <p class="card-text px-5" style="max-height: 90px; overflow: hidden;">
                                <a class="isim" href="sohbet.php?id=<?= $row["id"] ?>"><h4 class="card-text fs-4"><?= $row["baslik"] ?></h4></a>
                                <?php
                                $metin = $row["yazi"];
                                if (strlen($metin) > 300) {
                                  echo substr($metin, 0, 300) . " ...";
                              } else {
                                  echo $metin;
                              }
                              ?>
                          </p>
                        <a href="sohbet.php?id=<?= $row["id"] ?>"><button class="button mt-4">Daha fazla</button></a>
                      </div>
                     </div>
                    <?php }
                  }
                  else{
                    echo "<center><i class='fa-solid fa-magnifying-glass fs-1'></center>";
                    echo "<center></i>Sonuc bulunamadı...</center>";
                  }
                  ?>
              </div>
          </div>
          <?php include 'paneller.php';?>
      </div>             
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="js/anasayfa.js"></script>
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
  <?php 
    if(isset($_POST["yid"]) || isset($_POST["tsil"]))
    {
        ?>
            <script>
                openPanel(0);
            </script>
        <?php
    }
    if(isset($_POST["tartisma"]))
    {
        ?>
            <script>
                openPanel(2);
            </script>
        <?php
    }
    if(isset($_POST["g"]))
    {
        ?>
            <script>
                openPanel(3);
            </script>
        <?php
    }
  ?>
</body>
</html>
