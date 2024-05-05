<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
      include 'datebase.php';
      $baslik = $db->query("SELECT * FROM tartisma WHERE id = '$_GET[id]'");
      $brow = $baslik->fetch(PDO::FETCH_ASSOC);
    ?>
    <title><?=$brow["baslik"]?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/sohbet.css">
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="icon" href="img/logo.png">

    
</head>
<body>

      <?php 
        include 'islemler.php';
        include 'header.php';

        $sil = @$_POST["silinecek"];
        $yeni = @$_POST["yeni"];
        $YBTN = @$_POST["yetkiBTN"];
        $yid = @$_POST["id"];
        if(!empty($YBTN))
        {
            $sql = $db->query("UPDATE kayitbilgi SET yetki = '$YBTN' WHERE id = '$yid'");
            echo "<div class='output succsess'>İşlem başarılı</div>";
        }
        if(!empty($sil))
        {
            try {
                $sql1 = $db->query("DELETE FROM tartisma WHERE id = '$sil'");
                echo "<div class='output succsess'>İşlem başarılı</div>";
            } catch (PDOException $th) {
                echo "<div class='output danger'>Sistemsel bir hata oluştu, lütfen tekrar deneyin</div>";
            }
        }
        if($yeni != null)
        {
            try {
                $sql = $db->query("INSERT INTO kategoriler (kad) VALUES ('$yeni')");
                echo "<div class='output succsess'>Kategori eklendi</div>";
            } catch (PDOException $th) {
                echo "<div class='output danger'>Sistemsel bir hata oluşut lütfen tekrar deneyin</div>";
            }
        }

        $k = @$_POST["kEkle"];
        if($k != null)
        {
            $stmt = $db->prepare("INSERT INTO roller (rol) VALUES (?)");
            $stmt->execute([$k]);
            echo '<div class="output succsess">Rol eklendi</div>';
        }
      ?>

      <div class="row w-100" style="position: absolute;">
        <!-- Nav Menü -->
          <div class="menu">
            <div class="side_menu ">
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
              <div class="px-5">
                <h2 class="menu_title" style="color: yellow;">SARILAR</h2>
                <ul class="list_load">
                  <?php
                    @session_start();
                    if($_SESSION['rol'] == "(Admin)")
                    {
                      ?>
                        <li><a class="list_item" href="admin.php">Anasayfa</a></li>
                      <?php
                    }
                    else
                    {
                        ?>
                          <li><a class="list_item" href="anasayfa.php">Anasayfa</a></li>
                        <?php
                    }
                  ?>
                  <li class="list_item m-btn">Sohbet</li>
                  <li class="list_item m-btn">Bildirimler</li>
                  <li class="list_item m-btn">Profil</li>
                  <li class="list_item m-btn">Tartışma aç</li>
                  <li class="list_item m-btn">Ayarlar</li>
                </ul>
                <hr>
                <div class="spacer_box"><p></p></div>
                <?php
                  @session_start();
                  if($_SESSION['rol'] == "(Admin)")
                  {
                    ?>
                      <a href="msjList.php" class="text-white"><li class="list_item">Mesajlaşmalar</li></a>
                      <li class="list_item m-btn">Kullanıcı listesi</li>
                      <li class="list_item m-btn">Kategori listesi</li>
                      <li class="list_item m-btn">Rol eklme</li>
                    <?php
                  }
                  else
                  {
                    ?>
                      <a href="msjList.php" class="text-white"><li class="list_item">Mesajlaşmalar</li></a>
                      <a href="hakkımızda.html" class="text-white"><li class="list_item">Hakkımızda</li></a>
                      <a href="iletisim.php" class="text-white"><li class="list_item">İletişim</li></a>
                    <?php
                  }
                ?>
                
              </div>
            </div>
          </div>
      </div>
        <div class="depo panels mt-5">
          <div class="col d-flex position-relative w-100 flex-row align-items-start justify-content-center gap-3">
              <div class="w-100" style="margin-top: -7px;">
                <div  class="w-100 anasayfa rounded" >
                <?php
                @session_start();
                if($_SESSION['rol'] == "(Admin)")
                {
                  echo '<div class="icerik d-flex"><a href="admin.php" style="color: var(--color); display: flex; align-items: center; gap: 10px;"><i class="fa-solid fa-house" style="margin-bottom: 6px;"></i>Anasayfa</a></div>';
                }
                else
                {
                  echo '<div class="icerik d-flex"><a href="anasayfa.php" style="color: var(--color); display: flex; align-items: center; gap: 10px;"><i class="fa-solid fa-house" style="margin-bottom: 6px;"></i>Anasayfa</a></div>';
                }
                ?>

                <div class="etkilesim icerik">
                  <div class="icerik border-0 text-start d-flex p-2 fs-5">
                    <div class=" rounded-circle">
                        <?php
                            $id = @$_GET["id"];
                            $sql = $db->prepare("SELECT * FROM tartisma WHERE id = :id");
                            $sql->bindParam(':id', $id, PDO::PARAM_INT);
                            $sql->execute();
                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                            
                            $isim = $row["kadi"];

                            $sql1 = $db->prepare("SELECT * FROM kayitBilgi WHERE  kullaniciadi='$isim'");
                            $sql1->execute();
                            $row1 = $sql1->fetch(PDO::FETCH_ASSOC);
                            $row1["pp"];
                        ?>
                        <a href="profil.php?kadi=<?= $row["kadi"] ?>"><img src="<?= $row1["pp"] ?>" class="rounded-circle border border-warning border-2" alt="" width="50px" height="50px" style="object-fit:cover; border 2px solid #8847A4;"></a>
                      </div>
                    <?php
                        $id = @$_GET["id"];
                        $sql = $db->prepare("SELECT * FROM tartisma WHERE id = :id");
                        $sql->bindParam(':id', $id, PDO::PARAM_INT);
                        $sql->execute();
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <a class="isim" href="profil.php?kadi=<?=$row['kadi']?>&p=<?=@$_GET["id"]?>"><?=$row['kadi']." "?> <label for="" style="font-size:15px; opacity:0.7"><?=$row1["yetki"]?></label></a>
                        <h4 style="margin: auto;"><?=$row["baslik"]?></h4>
                </div>
                <br>
                  <div class="icerik border-0">
                    <?php
                        $id = @$_GET["id"];
                        $sql = $db->prepare("SELECT * FROM tartisma WHERE id = :id");
                        $sql->bindParam(':id', $id, PDO::PARAM_INT);
                        $sql->execute();
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                        echo $row['yazi'];
                    ?>
                  </div>
                <hr>
                <br>
                  <div class="d-flex px-3 justify-content-between">
                    <div class="like">
                        <?php
                            $sql = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$ka'");
                            $row = $sql->fetch(PDO::FETCH_ASSOC);
                            $myid = $row['id'];

                            $begenbtn = $db->query("SELECT * FROM begeni WHERE k_id = '$myid' AND makale_id = '$id'");

                            $begeni = $db->query("SELECT * FROM tartisma WHERE id = '$id'");
                            $bRow = $begeni->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <span id="area">
                            <button id="btn" class="btn d-flex <?=!$begenbtn->rowCount() ? 'btn-outline-warning' : 'btn-warning'?> me-1 flex-grow-1 w-100" 
                                    data-my="<?=$myid?>" 
                                    data-id="<?=$id?>" 
                                    data-islem="<?= !$begenbtn->rowCount() ? 'begen' : 'begenme'?>">
                                <?= !$begenbtn->rowCount() ? 'Beğen' : 'Beğenme'?>
                                <span class="text-black text-black" style="margin: 0px 10px;" id="begeniSayisi"><?=$bRow['begeni']?></span>
                            </button>
                        </span>
                      
                    </div>

                    <div class="paylas d-flex align-items-center">

                    <button class="ybtn" onclick="window.dialog4.showModal()">
                        <span class="icont"> 
                          <svg fill="white" viewBox="0 0 512 512" height="1em"><path d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z"></path></svg>
                        </span>
                        <p class="txt">Yorum yap</p>
                      </button>

                      <!-- Modal -->
                      <div style="display: flex; justify-content: center; align-items: center;">
                        <dialog id="dialog4" class="w-100" style="background-color: var(--card);">
                            <div class="modal-body">
                              <h3 style="color: var(--color);">Lütfen bir mesaj yazınız</h3>
                              <textarea id="yorum" name="yorum" cols="30" rows="10" class="form-control" require></textarea>
                              <input type="hidden" name="ka" id="ka" value="<?=$ka?>">
                              <input type="hidden" name="id" id="id" value="<?=$_GET["id"]?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="yy"  onclick="window.dialog4.close();">Gönder</button>
                            </div>
                            <button onclick="window.dialog4.close();" aria-label="close" class="x">❌</button>
                        </dialog>
                    </div>

                    </div>
                  </div>
                  <br>
                  <hr>
                  <div class="icerik yorumlar border-0">
                      <?php
                        $id = $_GET["id"];
                        $asd = "0";
                        $sql = $db->query("SELECT * FROM yorumlar WHERE makaleid = '$id' AND ust_yorum = $asd order by id desc");
                        $sql1 = $db->query("SELECT * FROM yorumlar WHERE makaleid = '$id' AND kadi = '$ka'");
                        $row1 = $sql1->fetch(PDO::FETCH_ASSOC);
                      if ($sql->rowCount() > 0) {
                          while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <div class="yorum">
                                  <div class="d-flex align-items-center" style="gap: 10px;">
                                      <?php
                                      $isim = $row["kadi"];
                                      $sorgu = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$isim'");
                                      $row1 = $sorgu->fetch(PDO::FETCH_ASSOC);
                                      ?>
                                      <a href="profil.php?kadi=<?= $row["kadi"] ?>&p=<?=@$_GET["id"]?>"><img src="<?= $row1["pp"] ?>"
                                                                                          class="rounded-circle border border-warning border-2"
                                                                                          alt="" width="50px" height="50px"
                                                                                          style="object-fit:cover; border 2px solid #8847A4;"></a>
                                      <a class="isim" href="profil.php?kadi=<?= $row["kadi"] ?>&p=<?=@$_GET["id"]?>"><p class="m-0"
                                                                                                        style="font-size:20px"><?= $row["kadi"] . " " ?><label
                                                      for="" style="font-size:15px; opacity:0.7"><?= $row1["yetki"] ?></label></p></a>
                                      <?php
                                      if ($row["kadi"] == $ka) {
                                          ?>
                                          <details class="dropdown">
                                              <summary role="button b" style="font-size: 20px;">
                                                  ︙
                                              </summary>
                                              <ul>
                                                  <li><button name="silinecek" class="w-100 btn sil text-start"
                                                              id="<?= $row["id"] ?>" style="margin-left: auto;" value=""><i
                                                                  class="fa-solid fa-trash-can"
                                                                  style="margin-right: 5px;"></i>Sil</button></li>
                                                  <li><button class="w-100 btn text-start"
                                                              onclick="window.dialog5.showModal()"><i class="fa-solid fa-pencil"
                                                                                                      style="margin-right: 5px;"></i>Düzenle</button>
                                                  </li>
                                              </ul>
                                          </details>
                                          <!-- yorum düzenlemek için -->
                                          <div style="display: flex; justify-content: center; align-items: center;">
                                              <dialog id="dialog5" class="w-100">
                                                  <div class="modal-body">
                                                      <h3>Yorumunuzu düzenleyin</h3>
                                                      <form action="" method="post">
                                                          <textarea name="dyorum" id="" cols="30" rows="10"
                                                                    class="form-control"></textarea>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="submit" class="btn btn-primary"
                                                              onclick="window.dialog.close();">Kaydet
                                                      </button>
                                                      <button type="submit" class="btn btn-primary"
                                                              onclick="window.dialog.close();">Vazgeç
                                                      </button>
                                                      </form>
                                                  </div>
                                                  <button onclick="window.dialog.close();" aria-label="close"
                                                          class="x">❌
                                                  </button>
                                              </dialog>
                                          </div>
                                          <?php
                                      }
                                      ?>
                                  </div>
                                  <p class="mt-3 mb-5 px-2"><?= $row["yorum"] ?></p>

                                  <form action="yorum.php" method="post">
                                      <div class="form d-flex justify-content-between">
                                          <input class="input" placeholder="Yanıtla" type="text" name="yanit" required autocomplete="off">
                                          <button class="Ybtn btn btn-primary rounded-pill">Yanıtla</button>
                                          <span class="input-border"></span>
                                          <input type="hidden" name="Yid" value="<?= $id ?>">
                                          <input type="hidden" name="yanitId" value="<?= $row["id"] ?>">
                                          <input type="hidden" name="ka" value="<?= $ka ?>">
                                      </div>
                                  </form>

                                  <!-- Yanıt -->
                                  <div class="w-100 mt-3">
                                      <?php
                                      $yID = $row['id'];
                                      $sorgu_yanit = $db->query("SELECT * FROM yorumlar WHERE ust_yorum = '$yID' order by id desc");
                                      if ($sorgu_yanit->rowCount() > 0) {
                                          while ($row_yanit = $sorgu_yanit->fetch(PDO::FETCH_ASSOC)) {
                                              ?>
                                              <div class="d-flex align-items-center" style="gap: 10px; margin-left: 50px;">
                                                  <?php
                                                  $isim_yanit = $row_yanit["kadi"];
                                                  $sorgu_yanit2 = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$isim_yanit'");
                                                  $row1_yanit = $sorgu_yanit2->fetch(PDO::FETCH_ASSOC);
                                                  ?>
                                                  <a href="profil.php?kadi=<?= $row_yanit["kadi"]?>&p=<?=@$_GET["id"]?>"><img
                                                              src="<?= $row1_yanit["pp"] ?>"
                                                              class="rounded-circle border border-warning border-2"
                                                              alt="" width="50px" height="50px"
                                                              style="object-fit:cover; border 2px solid #8847A4;"></a>
                                                  <a class="isim" href="profil.php?kadi=<?= $row_yanit["kadi"] ?>&p=<?=@$_GET["id"]?>"><p class="m-0"
                                                                                                                          style="font-size:20px"><?= $row_yanit["kadi"] . " " ?><label
                                                                  for=""
                                                                  style="font-size:15px; opacity:0.7"><?= $row1_yanit["yetki"] ?></label></p></a>
                                                  <?php
                                                  if ($row_yanit["kadi"] == $ka) {
                                                      ?>
                                                      <details class="dropdown">
                                                          <summary role="button b" style="font-size: 20px;">
                                                              ︙
                                                          </summary>
                                                          <ul>
                                                              <li><button name="silinecek" onclick="sil(<?= $row_yanit['id'] ?>)" class="w-100 text-white btn sil text-start"
                                                                          id="<?= $row_yanit["id"] ?>"
                                                                          style="margin-left: auto;" value=""><i
                                                                              class="fa-solid fa-trash-can"
                                                                              style="margin-right: 5px;"></i>Sil
                                                                  </button></li>
                                                              <li><button class="w-100 btn text-start text-white"
                                                                          onclick="window.dialog5.showModal()"><i
                                                                              class="fa-solid fa-pencil"
                                                                              style="margin-right: 5px;"></i>Düzenle
                                                                  </button>
                                                              </li>
                                                          </ul>
                                                      </details>
                                                      <!-- yorum düzenlemek için -->
                                                      <div style="display: flex; justify-content: center; align-items: center;">
                                                          <dialog id="dialog5" class="w-100">
                                                              <div class="modal-body">
                                                                  <h3>Yorumunuzu düzenleyin</h3>
                                                                  <form action="" method="post">
                                                                      <textarea name="dyorum" id="" cols="30" rows="10"
                                                                                class="form-control"></textarea>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="submit" class="btn btn-primary"
                                                                          onclick="window.dialog.close();">Kaydet
                                                                  </button>
                                                                  <button type="submit" class="btn btn-primary"
                                                                          onclick="window.dialog.close();">Vazgeç
                                                                  </button>
                                                                  </form>
                                                              </div>
                                                              <button onclick="window.dialog.close();" aria-label="close"
                                                                      class="x">❌
                                                              </button>
                                                          </dialog>
                                                      </div>
                                                  <?php }
                                                  ?>
                                              </div>
                                              <p class="mt-3 mb-5 mx-5 px-2"><?= $row_yanit["yorum"] ?></p>
                                              <?php
                                          }
                                      }
                                      ?>
                                  </div>
                              </div>
                              <?php
                          }
                      } else {
                          echo "<center>İlk yorum yapan kişi sen ol</center>";
                      }
                      ?>
                  </div>


                </div>


                
              </div>
              <!-- Popiler -->
              </div>
            <div class="pt-4 pos" style="max-width: 350px;">
                  <?php
                    $son = $db->query("SELECT * FROM tartisma ORDER BY begeni DESC LIMIT 5");
                    
                    while ($row = $son->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="card mb-2">
                      <center><img class="card-img-top" src="<?= $row["img"] ?>" alt="" style="object-fit: contain; max-height: 350px;"></center>

                      <div class="card-body">
                          <div class="d-flex mb-4 align-items-center gap-2">
                              <?php
                                  $sql = $db->prepare("SELECT * FROM kayitbilgi WHERE kullaniciadi = :kadi");
                                  $sql->bindParam(':kadi', $row['kadi'], PDO::PARAM_STR);
                                  $sql->execute();
                                  $row1 = $sql->fetch(PDO::FETCH_ASSOC);
                              ?>
                              <a href="profil.php?kadi=<?= $row["kadi"] ?>&p=<?=@$_GET["id"]?>"><img src="<?= $row1["pp"] ?>" class="rounded-circle border border-warning border-2" alt="" width="40px" height="40px" style="object-fit:cover;"></a>
                              <div class="m-3">
                                  <h5 class="card-title"><a class="isim" href="profil.php?kadi=<?= $row["kadi"] ?>&p=<?=@$_GET["id"]?>"><?= $row["kadi"] ?><?=$row1["yetki"]?></a></h5>
                                  <h4 class="card-text fs-5"><?= $row["baslik"] ?></h4>
                              </div>
                          </div>
                          <p class="card-text px-5 m-3 mb-5" style="max-height: 90px; overflow: hidden;">
                              <?php
                                  $metin = $row["yazi"];
                                  if (strlen($metin) > 100) {
                                      echo substr($metin, 0, 100) . " ...";
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
                  ?>
              
            </div>
          </div>
        </div>
      <!-- Paneller -->
      <div class="mt-5 pt-3">
        <?php 
        @session_start();
        if($_SESSION['rol'] == "(Admin)")
          include 'adminPanel.php';
        else
          include 'paneller.php';
        ?>
      </div>

            

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/sohbet.js"></script>
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
<script>
    $(function(){
        $(document).on("click", "#btn", function(){
            const $my = $(this).data('my');
            const $id = $(this).data('id');
            const $islem = $(this).data('islem');

            $.post( "begeni.php", { my: $my, id: $id, islem: $islem}, function(gelen){
                const data = JSON.parse(gelen);
                $("#area").html(data.button);
                $("#begeniSayisi").html(data.begeni);
            });
        });
    });
</script>
<script>
        var kl = $("#kl");
        var tl = $("#tl");
        $.post("ajax.php",
              {
                  harf: $("#ara").val(),       
              },
              function(data){
                  kl.html(data);
              }
          );
        $("#ara").on("keyup", function(){
          $.post("ajax.php",
                {
                    harf: $(this).val(),       
                },
                function(data){
                    kl.html(data);
                }
            );
        });
    </script>
<?php 
        if(isset($_POST["yid"]) || isset($_POST["tsil"]))
        {
            ?>
                <script>
                    openPanel(1);
                </script>
            <?php
        }
        if(isset($_POST["tartisma"]))
        {
            ?>
                <script>
                    openPanel(3);
                </script>
            <?php
        }
        if(isset($_POST["g"]))
        {
            ?>
                <script>
                    openPanel(4);
                </script>
            <?php
        }
        if(isset($_POST["ban"]) || isset($_POST["yetkiBTN"]))
        {
            ?>
                <script>
                    openPanel(5);
                </script>
            <?php
        }
        if(isset($_POST["sil"]) || isset($_POST["yeni"]))
        {
            ?>
                <script>
                    openPanel(6);
                </script>
            <?php
        }
        if(isset($_POST["rol"]))
        {
            ?>
                <script>
                    openPanel(7);
                </script>
            <?php
        }
    ?>
</body>
</html>