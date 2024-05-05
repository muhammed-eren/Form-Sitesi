<?php
    include 'datebase.php';
    $ka = @$_POST['ka'];
    $yorum = @$_POST['yorum'];
    $id = @$_POST['id'];
    if(!empty($yorum))
    {
        $sql = $db->prepare("INSERT INTO yorumlar (kadi, yorum, makaleid) VALUES (:kadi, :yorum, :makaleid)");
        $sql->bindParam(':kadi', $ka, PDO::PARAM_STR);
        $sql->bindParam(':yorum', $yorum, PDO::PARAM_STR);
        $sql->bindParam(':makaleid', $id, PDO::PARAM_STR);
        $sql->execute();

        ?>
        <?php
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
                                        <li><button name="silinecek" onclick="sil(<?= $row['id']?>)" class="w-100 btn sil text-start"
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
                                                    <li><button name="silinecek" class="w-100 text-white btn sil text-start"
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
        <?php
    }
    try {
        $id = @$_POST['silinecek'];
        $sql1 = $db->query("DELETE FROM yorumlar WHERE id = '$id'");
        $row = $sql1->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $m) {
        echo"Hata";
    }


    // Yanıt
    $YanitYorum = @$_POST['yanit'];
    $YanitId = @$_POST['yanitId'];
    $Yid = @$_POST['Yid'];
    if(!empty($YanitYorum))
    {
        $sql2 = $db->query("INSERT INTO yorumlar (kadi, yorum, makaleid,ust_yorum) VALUES ('$ka', '$YanitYorum', '$Yid','$YanitId')");
        header("Location:sohbet.php?id=$Yid");
    }
?>