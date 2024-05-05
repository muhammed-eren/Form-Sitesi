<?php
    include 'datebase.php';
	@session_start();
	$ka = $_SESSION['kullanici_adi'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaj listesi</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/anasayfa.css">
</head>
<body>
    <?php include 'header.php';?>
    <div class="container-sm pt-5">
            <div class="d-flex icerik mt-5 mb-3" id="geri" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div>
            <?php
            $sql = $db->query("SELECT DISTINCT alici_id FROM sohbet WHERE gonderici_id = '$ka' ORDER BY id DESC");
            if($sql->rowCount() == 0){
                echo "Henuz Mesajınız Bulunmamaktadır.";
            }
            else
            {
                echo '<ul class="list-group list-group-flush">';
                while ($row = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    $pp = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$row[alici_id]'");
                    $prow = $pp->fetch(PDO::FETCH_ASSOC);
                    ?>
                            <li class="list-group-item d-flex align-items-center gap-2 ">
                                <a href="profil.php?kadi=<?=$prow["kullaniciadi"]?>&p=m"><img src="<?= $prow["pp"]?>" class="rounded-circle border border-warning border-2" alt="" width="50px" height="50px" style="object-fit:cover; border 2px solid #8847A4;"></a>
                                <div class="mt-3 w-100">
                                    <a href="kullanicisohbet.php?id=<?=$row["alici_id"]?>" style="color:var(--color);" class="text-decoration-none w-100">
                                        <p class="text-start mb-0"><?= $row["alici_id"]?></p>
                                    </a>
                                    <?php
                                        $sql2 = $db->query("SELECT * FROM sohbet WHERE (alici_id='$ka' AND gonderici_id='$row[alici_id]') OR (alici_id='$row[alici_id]' AND gonderici_id='$ka') ORDER BY id DESC limit 1");
                                        if($sql2->rowCount()){
                                            $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                                <a href="kullanicisohbet.php?id=<?=$row["alici_id"]?>" class="text-decoration-none w-100">
                                                    <p class="text-muted text-start"><?=$row2['mesaj']?></p>
                                                </a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <p class="text-muted text-start">Hemen mesajlajmaya başla.</p>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </li>
                    <?php
                }
                echo '</ul>';
            }
        ?>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script></div>
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