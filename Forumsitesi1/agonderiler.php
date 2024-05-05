<?php include 'datebase.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/anasayfa.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sohbet.css">
    <link rel="icon" href="img/logo.png">
    <style>
      :root {
        --button-background: dodgerblue;
        --button-color: white;
        
        --dropdown-highlight: dodgerblue;
        --dropdown-width: 160px;
        --dropdown-background: #262627;
        --dropdown-color: black;
      }
      
      b {
        display: inline-block;
        border-radius: 50%;
        box-sizing: border-box;
        width: 40px;
        height: 40px;
        border: none;
        font-size: 30px;
        cursor: pointer;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      
      b:active {
        background: #797979;
      }
      
      .dropdown {
        margin: auto;
        position: relative;
        padding: 0;
        margin-right: 1em;
        border: none;
      }
      
      .dropdown summary {
        list-style: none;
        list-style-type: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .dropdown summary:active
      {
        background-color: rgb(146, 146, 146);
      }
      .dropdown > summary::-webkit-details-marker {
        display: block;
      }
      
      .dropdown summary:focus {
        outline: none;
      }
      .dropdown summary:focus {
        outline: none;
      }
      
      .dropdown ul {
        position: absolute;
        margin: 20px 0 0 0;
        padding: 20px 0;
        width: var(--dropdown-width);
        left: 50%;
        margin-left: calc((var(--dropdown-width) / 2)  * -1);
        box-sizing: border-box;
        z-index: 2;
        
        background: var(--dropdown-background);
        border-radius: 6px;
        list-style: none;
      }
      
      .dropdown ul li {
        padding: 0;
        margin: 0;
        transition: 0.3s;
      }
      
      .dropdown ul li a:link, .dropdown ul li a:visited {
        display: inline-block;
        padding: 10px 0.8rem;
        width: 100%;
        box-sizing: border-box;
        
        color: var(--dropdown-color);
        text-decoration: none;
      }
      
      .dropdown ul li:hover {
        background-color: var(--dropdown-highlight);
        color: var(--dropdown-background);
      }
      
      .dropdown ul::before {
        content: ' ';
        position: absolute;
        width: 0;
        height: 0;
        top: -10px;
        left: 50%;
        margin-left: -10px;
        border-style: solid;
        border-width: 0 10px 10px 10px;
        border-color: transparent transparent var(--dropdown-background) transparent;
      }
      
      
      .dropdown > summary::before {
        display: none;
      }
      
      .dropdown[open] > summary::before {
          content: ' ';
          display: block;
          position: fixed;
          top: 0;
          right: 0;
          left: 0;
          bottom: 0;
          z-index: 1;
      }
      
    </style>
</head>
<body>
    <?php
        $ka = @$_GET["ka"];
    ?>
    <?php
        include 'header.php';

        $sil = @$_POST["silinecek"];

        if(!empty($sil))
        {
          $db->query("DELETE FROM tartisma WHERE id = '$sil'");
        }
      ?>
        <div class="container-lg pt-5"id="as">
          <div class="d-flex icerik mt-5" id="geri" style="cursor: pointer;"><i class="fa-solid fa-angle-left"></i>Geri</div><div  class="w-100 anasayfa pt-2">
        
            <div  class="w-100 anasayfa">
              <?php
                $stmt = $db->prepare("SELECT * FROM tartisma WHERE kadi='$ka' ORDER BY id DESC");

                $stmt->execute();
                if($stmt->rowCount())
                {
                    
                

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="card" style="background-color: var(--card;">
                    
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

                            <details class="dropdown">
                              <summary role="button b" style="font-size: 20px;">
                                ︙
                              </summary>
                              <ul>
                                <form action="" method="post">
                                  <li><button type="submit" name="silinecek" class="w-100 text-white btn sil text-start" id="<?=$row["id"]?>" style="margin-left: auto;" value=""><i class="fa-solid fa-trash-can" style="margin-right: 5px;"></i>Sil</button></li>
                                </form>
                              </ul>
                            </details>
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
              <?php }
                }
                else{
                    echo '<center>Sonuç Yok</center>';
                }
              ?>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    let hed = document.getElementById("hed");
	let img = document.getElementById("img");
	var yurut;
	window.addEventListener("scroll", () => {
		if (window.scrollY >= 100) {
			hed.classList.add("active");
			yurut = false;
		}
		else {
			hed.classList.remove("active");
			yurut = true;
		}
		if (yurut) {
			img.style.left = 0 + "%";
		}
		else {
			img.style.left = 43 + "%";
		}
	});
</script>
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