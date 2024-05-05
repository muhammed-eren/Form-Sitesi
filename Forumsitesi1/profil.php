<?php 
    include 'datebase.php';

    $ka = $_GET["kadi"];
    session_start();
    $my = $_SESSION["kullanici_adi"];
    $sql = $db->prepare("SELECT * FROM kayitbilgi WHERE kullaniciadi = :ka");
    $sql->bindParam(':ka', $ka, PDO::PARAM_STR);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);



    function kisalt($sayi) {
        $sinirlar = array(
            1000000000 => 'G',
            1000000 => 'M',
            1000 => 'k'
        );
    
        foreach ($sinirlar as $sinir => $etiket) {
            if ($sayi >= $sinir) {
                return round($sayi / $sinir, 1) . $etiket;
            }
        }
        return $sayi;
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/profil.css">
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="icon" href="img/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container-xl rounded" style="margin-top:100px">
        <?php
            $gelen = @$_GET["p"];
            if($gelen == "a")
            {
                @session_start();
                if($_SESSION['rol'] == "(Admin)")
                {
                    ?>
                       <a href="admin.php" class="text-decoration-none"><div class="d-flex icerik mt-5" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div></a>
                    <?php
                }
                else
                {
                    ?>
                        <a href="anasayfa.php" class="text-decoration-none"><div class="d-flex icerik mt-5" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div></a>
                    <?php 
                }
            }
            elseif($gelen == "m")
            {
                ?>
                    <a href="anasayfa.php" class="text-decoration-none"><div class="d-flex icerik mt-5" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div></a>
                <?php 
            }
            else
            {
                ?>
                    <a href="sohbet.php?id=<?=$gelen?>" class="text-decoration-none"><div class="d-flex icerik mt-5" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div></a>
                <?php
            }
        ?>
        <div class="kapak mt-3">
            <section style="background-color: var(--card);" class="w-100">
                <div class="py-3 px-3">
                    <img src="<?=$row["afis"]?>" alt="" style=" width: 100%; height: 300px; object-fit: cover; margin: auto;">
                    <div class="row h-100">
                        <div class="col col-md-9 col-lg-7 col-xl-5 w-100 d-flex res">
                            <div class="card pcard2 w-100" style="background-color: #fff; border:none;">
                                <div class="card-body p-0 border-0 pt-3" style="background-color: var(--card);">
                                    <div class="d-flex res text-black">
                                        <div class="flex-shrink-0 d-flex align-items-center">
                                            <img src="<?=$row["pp"]?>"
                                                alt="Generic placeholder image" class="img-fluid rounded-circle"
                                                style="width: 150px;height:150px; object-fit:cover;">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h3 class="mb-1" style="font-size:25px"><?=$row["kullaniciadi"]." "?><label for="" style="font-size:15px; opacity:0.7"><?=$row["yetki"]?></label></h3>
                                            <p style="opacity:0.5;"><?=$row["isim"]." ".$row["soyisim"]?></p>
                                            <div class="d-flex res justify-content-start rounded-3 p-2 mb-2" style="background-color: var(--bg-color); gap:1rem;">
                                                <div>
                                                    <p class="small text-muted mb-1 text-start">Takipçi</p>
                                                    <p class="mb-0" id="takpsayisi"><?=kisalt($row["takipci"])?></p>
                                                </div>
                                                <div>
                                                    <p class="small text-muted mb-1 text-start">Beğeni</p>
                                                    <p class="mb-0"><?=kisalt($row["begeni"])?></p>
                                                </div>
                                                <div>
                                                    <p class="small text-muted mb-1 text-start">Gönderi</p>
                                                    <p class="mb-0"><?=kisalt($row["gonderi"])?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex pt-1">
                                                <a href="kullanicisohbet.php?id=<?=$row["kullaniciadi"]?>" class="btn btn-outline-warning me-1 flex-grow-1 w-50">Sohbet</a>
                                                
                                                <?php
                                                    $kaMy = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$my'");
                                                    $MyRow = $kaMy->fetch(PDO::FETCH_ASSOC);
                                                
                                                    $query = $db->query("SELECT * FROM follows WHERE follower_id = '$MyRow[id]' AND following_id = '$row[id]'");
                                                ?>
                                                
                                                <span id="area">
                                                    <button id="btn" class="btn <?= !$query->rowCount() ? 'btn-outline-warning' : 'btn-warning'?> me-1 flex-grow-1 w-100" data-my="<?=$MyRow["id"]?>" data-id="<?=$row["id"]?>" data-islem="<?= !$query->rowCount() ? 'takip' : 'bırak'?>"><?= !$query->rowCount() ? 'Takip Et' : 'Takiptesin'?></button>
                                                </span>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="" style="width: 350px;">
                                <p class="mt-4 px-2 text-start w-100" style="overflow-wrap: break-word;"><?=$row["biyo"]?></p>
                            </div>
                        </div>
                        <div class="d-flex res gap-5">
                            <a href="gonderiler.php?kadi=<?=$row["kullaniciadi"]?>" style="text-decoration: none;" class="w-100">
                                <div class="d-flex align-items-center gap-3 bg-dark p-4 rounded">
                                    <svg style="fill: rgb(0, 54, 201);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="30" height="30">
                                        <path d="M0 1.75A.75.75 0 0 1 .75 1h4.253c1.227 0 2.317.59 3 1.501A3.743 3.743 0 0 1 11.006 1h4.245a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75h-4.507a2.25 2.25 0 0 0-1.591.659l-.622.621a.75.75 0 0 1-1.06 0l-.622-.621A2.25 2.25 0 0 0 5.258 13H.75a.75.75 0 0 1-.75-.75Zm7.251 10.324.004-5.073-.002-2.253A2.25 2.25 0 0 0 5.003 2.5H1.5v9h3.757a3.75 3.75 0 0 1 1.994.574ZM8.755 4.75l-.004 7.322a3.752 3.752 0 0 1 1.992-.572H14.5v-9h-3.495a2.25 2.25 0 0 0-2.25 2.25Z"/>
                                    </svg>
                                    <p style="opacity: 0.7; margin: 0 auto; color: #f1f1f1;">Gönderiler</p>
                                </div>
                            </a>

                            <a href="gonderiYourm.php?kadi=<?=$row["kullaniciadi"]?>" style="text-decoration: none;" class="w-100">
                                <div class="d-flex align-items-center gap-3 bg-dark p-4 rounded">
                                    <svg style="fill: rgb(0, 54, 201);" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                                        <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
                                    </svg>
                                    <p style="opacity: 0.7; margin: 0 auto; color: #f1f1f1;">Yorumlar</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(function(){
            $(document).on("click", "#btn", function(){
                const $my = $(this).data('my');
                const $id = $(this).data('id');
                const $islem = $(this).data('islem');

                console.log($my, $id, $islem);

                $.post( "Takip.php", { my: $my, id: $id, islem: $islem}, function(gelen){
                    const data = JSON.parse(gelen);
                    console.log(data);
                    $("#area").html(data.button);
                    $("#takpsayisi").html(data.takipci);
                });
            });
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
