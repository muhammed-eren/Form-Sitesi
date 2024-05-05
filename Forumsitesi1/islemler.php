<?php 
      session_start();
      
      include 'datebase.php';
      
      // Kullanıcı adı
      $ka = @$_SESSION['kullanici_adi'];

      // İşlem paneli
      $panel = @$_POST["panel"];

      switch ($panel) {
          case 'hata':
              try {
                  $hata = @$_POST["hata"];
                  $sorgu = $db->prepare("INSERT INTO raporoneri SET isim=:ka, mesaj=:hata");
                  $sorgu->bindParam(':ka', $ka, PDO::PARAM_STR);
                  $sorgu->bindParam(':hata', $hata, PDO::PARAM_STR);
                  $sorgu->execute();
                  if($sorgu)
                  {
                    echo "<div class='output succsess'>Mesajınız için teşekkür ederiz</div>";
                  }
              } catch(PDOException $e){
                  echo "<div class='output danger'>Mesajınız gönderilmedi</div>";
              }
                ?>
                    <script>
                        openPanel(3);
                    </script>
                <?php
              break;

          case 'bildirim':
              try {
                  $yid = @$_POST["yid"];
                  $ayid = @$_POST["ayid"];
                  $sql = $db->prepare("DELETE FROM yanit WHERE id = :yid");
                  $sql->bindParam(':yid', $yid, PDO::PARAM_INT); 
                  $sql->execute();

                  if(!empty($ayid))
                  {
                      $sql = $db->query("DELETE FROM raporoneri WHERE id = '$ayid'");
                  }
                  echo "<div class='output succsess'>Silindi</div>";
              } catch(PDOException $e) {       
                  echo "<div class='output danger'>Bir sorun oluştu lütfen daha sonra tekrar deneyiniz</div>";
              }
              break;

          case 'tartisma':
              try {
                  $yazi = @$_POST["yazi"];
                  $baslik = @$_POST["baslik"];
                  $kategori = @$_POST["kategori"];
                
                  $uploadDir = 'img/';
                  $uploadFile = $uploadDir . basename($_FILES['resim']['name']);
                  $imagePath = $uploadFile;
                    
                $sql1 = $db->prepare("INSERT INTO tartisma SET kadi = :ka, img  = :imagePath, yazi = :yazi, baslik = :baslik, kategori = :kategori");
                $sql1->bindParam(':ka', $ka, PDO::PARAM_STR);
                $sql1->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
                $sql1->bindParam(':yazi', $yazi, PDO::PARAM_STR);
                $sql1->bindParam(':baslik', $baslik, PDO::PARAM_STR);
                $sql1->bindParam(':kategori', $kategori, PDO::PARAM_STR);
                $sql1->execute();

                $gudate = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$ka'");
                $r = $gudate->fetch(PDO::FETCH_ASSOC);
                $gonderi = $r["gonderi"]+1;

                $arttir = $db->query("UPDATE kayitbilgi SET gonderi = '$gonderi' WHERE kullaniciadi = '$ka'");
                echo "<div class='output succsess'>Yayınlandı</div>";
              } catch(PDOException $e) {
                  echo "<div class='output danger'>Yayınlanmadı</div>";
              }
              break;

          case 'ppb':
              try {
                  $b = $_POST["biyografiye-yaz"];
                  $sql = $db->prepare("UPDATE kayitbilgi SET biyo = :b WHERE kullaniciadi = :ka");
                  $sql->bindParam(':b', $b, PDO::PARAM_STR);
                  $sql->bindParam(':ka', $ka, PDO::PARAM_STR);
                  $sql->execute();
                  echo "<div class='output succsess'>Kaydedildi</div>";
              } catch(PDOException $e) {
                  echo "<div class='output danger'>Bir sorun oluştu lütfen daha sonra tekrar deneyiniz</div>";
              }
              break;

          case 'pp':
              $uploadDir = 'img/';
              $uploadFile = $uploadDir . basename($_FILES['image']['name']);

              if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                  echo "<div class='output succsess'>Kaydedildi</div>";
                  $imagePath = $uploadFile;

                  $sql = "UPDATE kayitbilgi SET pp = :imagePath WHERE kullaniciadi = :ka";
                  $stmt = $db->prepare($sql);
                  $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
                  $stmt->bindParam(':ka', $ka, PDO::PARAM_STR);
                  $stmt->execute();
              } else {
                  echo "<div class='output danger'>Kaydedilmedi</div>";
              }
              break;

          default:
              # code...
          break;
      }
      $tsil = @$_POST["tsil"];
      $ka = $_SESSION['kullanici_adi'];
      if(isset($tsil))
      {
        $db->query("DELETE FROM yanit WHERE isim = '$ka'");
        $db->query("DELETE FROM raporoneri");
      }
?> 