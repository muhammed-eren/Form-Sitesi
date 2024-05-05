<div class="container-lg">
<div class="bildirim panels bg">
                <span class="baslik"></span>

                <?php
                    $ka = $_SESSION['kullanici_adi'];
                    $stmt = $db->query("SELECT * FROM yanit WHERE isim = '$ka' ORDER BY id DESC");
                    $sql1 = $db->query("SELECT * FROM raporoneri");
                    echo '<div class="row w-100 text-center"></div>';
                    echo '<form id="sonuc" action="" method="post" class="w-100" >'; 
                    ?>
                    <button class="btn btn-danger ms-auto" name="tsil" type="submit">Tümünü Sil</button>
                    <?php
                    if($stmt->rowCount() == 0 && $ka != "admin")
                    {
                        echo "Mesaj yok";
                    }
                    @session_start();
                    if($sql1->rowCount() == 0 && $_SESSION['rol'] == "(Admin)")
                    {
                        echo "Mesaj yok";
                    }
                    ?>
                    <ul class="list-group list-group-flush w-100">
                    <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <li class="list-group-item w-100 mb-2 px-3">
                                <div class="d-flex aling-items-center justify-content-between">
                                    <?php
                                        if($row["sohbetisim"] != "")
                                        {
                                    ?>
                                        <a class="cursor-pointer isim text-start" href="kullanicisohbet.php?id=<?=$row['sohbetisim']?>"><?=$row["mesaj"]?></a>
                                    <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <p class="cursor-pointer text-start"><?=$row["mesaj"]?></p>
                                            <?php
                                        }
                                    ?>
                                    </p>
                                        <button type="submit" class="delete" name="yid" value="<?=$row["id"]?>">
                                            <svg viewBox="0 0 448 512" class="svgIcon">
                                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                            </svg>
                                        </button>
                                </div>
                            </li>
                        <?php
                    }
                    ?>
                        </ul>
                    <?php
                    
                    echo '<input type="text" name="panel" value="bildirim" class="d-none" id=""/>';
                    echo '</form>';


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
            </div>

            <div class="panels rounded">
            <div class="kapak w-100">
                <section style="background-color: var(--card);" class="w-100">
                    <?php
                        $prof = $db->prepare("SELECT * FROM kayitbilgi WHERE kullaniciadi = :ka");
                        $prof->bindParam(':ka', $ka, PDO::PARAM_STR);
                        $prof->execute();
                        $row = $prof->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="py-3 px-3">
                        <img src="<?=$row["afis"]?>" alt="" style=" width: 100%; height: 300px; object-fit: cover; margin: auto;">
                        <div class="row h-100">
                            <div class="col col-md-9 col-lg-7 col-xl-5 w-100 d-flex res">
                                <div class="card pcard w-100" style="background-color: #fff; border:none;">
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
                                                    <a href="duzenle.php" class="btn btn-outline-warning me-1 flex-grow-1 w-100">Düzenle</a>
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

            <div class="tartisma panels">
                <form action="" method="post" class="w-100" enctype="multipart/form-data">
                    <!-- Resim yükleme alanı -->
                    <input type="file" class="form-control fc" name="resim" id="resim" accept="image/*">

                    <!-- Kategori seçimi -->
                    <select name="kategori" class="form-select fc" aria-label="Kategori Seç">
                        <?php
                            $stmt = $db->query("SELECT * FROM kategoriler");

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$row["kad"].'">'.$row["kad"].'</option>';
                            }
                        ?>
                    </select>

                    <!-- Başlık alanı -->
                    <input type="text" name="baslik" class="form-control fc" placeholder="Başlık Giriniz..." id="">

                    <!-- Tartışma içeriği -->
                    <textarea class="form-control fc" name="yazi" id="" cols="30" rows="10" placeholder="Buraya bir şeyler yazın..."></textarea>

                    <!-- Form panel bilgisi -->
                    <input type="text" name="panel" value="tartisma" class="d-none" id="">

                    <!-- Gönder butonu -->
                    <input type="submit" name="tartisma" value="Yayınla" class="button w-100" />
                </form>
            </div>


            <div class="row justify-content-center panels w-100">
                <div class="col-12 col-lg-10 col-xl-8 mx-auto w-100">
                    <h2 class="h3 mb-4 page-title">Ayarlar</h2>
                    <div class="my-4">
                        <strong class="mb-0">Sistem</strong>
                        <p>Arayüz ve sistem özelikleri.</p>
                        <div class="list-group mb-5 shadow">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <label for="alert1">
                                        <div class="col d-flex justify-content-between">
                                            <strong class="mb-0">Karanlık mod</strong>
                                            <div class="col-auto">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="alert1"/>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                <label for="alert2">
                                        <div class="col d-flex justify-content-between">
                                            <strong class="mb-0">Bildirimleri sustur</strong>
                                            <div class="col-auto">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input" id="alert2"/>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <strong class="mb-0">Diğer</strong>
                        <div class="list-group mb-5 shadow">
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                <a href="sifredegis.php" class="text-black">
                                        <div class="col">
                                            <strong class="mb-0">Şifrenizi değiştirin</strong>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <a href="emailedegis.php" class="text-black">
                                        <div class="col">
                                            <strong class="mb-0">E-postanızı değiştirin</strong>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col" onclick="window.dialog.showModal();">
                                        <strong class="mb-0">Rapor</strong>
                                        <p class="text-muted mb-0">Kullanıcılar raporlayabilir veya bir hata bildirirsiniz. </p>
                                    </div>
                                    <div class="col-auto">
                                        <div>
                                            <dialog id="dialog" class="w-100">
                                                <div class="modal-body">
                                                    <h3>Lütfen bir mesaj yazınız</h3>
                                                    <form action="" method="post">
                                                        <textarea name="hata" id="" cols="30" rows="10" class="form-control"></textarea>
                                                        <input type="text" name="panel" id="" value="hata" class="d-none">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="g" onclick="window.dialog.close();">Gönder</button>
                                                    </form>
                                                </div>
                                                <button onclick="window.dialog.close();" aria-label="close" class="x">❌</button>
                                            </dialog>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col" onclick="window.dialog1.showModal();">
                                        <strong class="mb-0">Çıkış yap</strong>
                                    </div>
                                    <div class="col-auto">
                                        <div>
                                            <dialog id="dialog1">
                                                <h3>Çıkmak İstediğinize Eminmisiniz?</h3>
                                                <div class="modal-footer">
                                                    <a href="index.php"><button type="button" class="btn btn-danger">Evet</button></a>
                                                    <button type="button" class="btn btn-secondary" onclick="window.dialog1.close();">Hayır</button>
                                                </div>
                                                <button onclick="window.dialog1.close();" aria-label="close" class="x">❌</button>
                                            </dialog>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>