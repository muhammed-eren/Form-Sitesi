<?php
    include 'datebase.php';
    $harf = @$_POST['harf'];
    

    if(!empty($harf))
    {
        $stmt = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi LIKE '".$harf."%'"); 
        if($stmt->rowCount() == 0)
        {
            echo "<center><i class='fa-solid fa-magnifying-glass fs-1'></center>";
            echo "<center></i>Sonuc bulunamadı...</center>";
        }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($row["kullaniciadi"] != "admin")
            {
            ?>
                <li class="list-group-item mb-1 d-flex justify-content-between align-items-center" style="padding-right: 40px">
                    <div class="d-flex  gap-3 align-items-center">
                        <a href="profil.php?kadi=<?= $row["kullaniciadi"] ?>&p=a">
                            <img src="<?=$row["pp"]?>   "
                                alt="" class="rounded-circle"
                                style="width: 100px;height:100px; object-fit:cover;">
                        </a>
                        <div>
                            <div class="d-flex gap-2 alin-items-center">
                                <a href="profil.php?kadi=<?= $row["kullaniciadi"] ?>&p=a"><p class="mt-3 mb-0 fs-4"><?=$row["kullaniciadi"]?></p></a>
                                <p class="mt-4 text-muted mb-0 fs-6"><?=$row["yetki"]?></p>
                            </div>
                            <p class="mt-3 mb-0 text-muted fs-6 text-start"><?=$row["biyo"]?></p>
                        </div>
                    </div>
                    <form action="" method="post" class="d-flex">
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" style="color:var(--color);" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Yetki
                                </button>
                            <ul class="dropdown-menu">
                                <?php

                                    $sql1 = $db->query("SELECT * FROM roller");
                                    while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <li class="w-100">
                                                <input type="hidden" name="id" value="<?=$row["id"]?>">
                                                <button type="submit" name="yetkiBTN" class="btn w-100 text-start" value="(<?= $row1["rol"] ?>)"><?= $row1["rol"] ?></button>
                                            </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                            </div>
                            <button class="btn btn-danger justify-content-end" name="ban" value="<?=$row["kullaniciadi"]?>" styel="margin-left: 100px">Yasakla</button>
                        </div>
                    </form>
                </li>
            <?php
            }
            else
            {
                echo "<center><i class='fa-solid fa-magnifying-glass fs-1'></center>";
                echo "<center></i>Sonuc bulunamadı...</center>";
            }
        }
    }
    else
    {
        $stmt = $db->query("SELECT * FROM kayitbilgi order by id DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if($row["kullaniciadi"] != "admin")
          {
          ?>
            <li class="list-group-item mb-1 d-flex justify-content-between align-items-center" style="padding-right: 40px">
                <div class="d-flex gap-3 align-items-center">
                    <a href="profil.php?kadi=<?= $row["kullaniciadi"] ?>&p=a">
                        <img src="<?=$row["pp"]?>   "
                            alt="" class="rounded-circle"
                            style="width: 100px;height:100px; object-fit:cover;">
                    </a>
                    <div>
                        <div class="d-flex gap-2 alin-items-center">
                            <a href="profil.php?kadi=<?= $row["kullaniciadi"] ?>&p=a"><p class="mt-3 mb-0 fs-4"><?=$row["kullaniciadi"]?></p></a>
                            <p class="mt-4 text-muted mb-0 fs-6"><?=$row["yetki"]?></p>
                        </div>
                        <p class="mt-3 mb-0 text-muted fs-6 text-start"><?=$row["biyo"]?></p>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="d-flex gap-2">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" style="color:var(--color);" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Yetki
                            </button>
                            <ul class="dropdown-menu">
                                <?php

                                    $sql1 = $db->query("SELECT * FROM roller");
                                    while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <li class="w-100">
                                                <input type="hidden" name="id" value="<?=$row["id"]?>">
                                                <button type="submit" name="yetkiBTN" class="btn w-100 text-start" value="(<?= $row1["rol"] ?>)"><?= $row1["rol"] ?></button>
                                            </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <button class="btn btn-danger justify-content-end" name="ban" value="<?=$row["kullaniciadi"]?>" styel="margin-left: 100px">Yasakla</button>
                    </div>
                </form>
            </li>
          <?php 
          }
        }
    }
?>