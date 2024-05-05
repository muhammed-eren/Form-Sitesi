<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Giriş İşlemleri</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="icon" href="img/logo.png">
</head>

<body>
  <?php 
        include 'datebase.php';
        @session_destroy();
        $isim = @trim($_POST["isim"]);
        $eposta = @trim($_POST["eposta"]);
        $pwd = @trim($_POST["pwd"]);
        $pwd2 = @trim($_POST["pwd2"]);
        
        $sql = $db->query("SELECT COUNT(*) FROM kayitBilgi WHERE kullaniciadi='$isim'");
        $say = $sql->fetchColumn();
        
        if(empty($isim) == false)
        {
          if($say <= 0)
          {
            if($pwd == $pwd2)
            {
              $pwd2 = md5($pwd2);
              $sorgu = $db->prepare("SELECT COUNT(*) FROM kayitBilgi WHERE eposta='$eposta'");
              $sorgu->execute();
              $say = $sorgu->fetchColumn();
              if($say <= 0) 
              { 
                $sorgu = $db->prepare("INSERT INTO kayitBilgi set kullaniciadi='$isim',eposta='$eposta',pwd='$pwd2',biyo='Merhaba',pp = 'img/blank-profile-picture-973460_1280.png',afis='img/tree-736885_1280.jpg'"); 
                $sorgu->execute(); 
                echo' <div class="output succsess">Aramıza Hoşgeldin</div> '; 
              }
              else 
              { 
                echo' <div class="output danger">Eposta zaten var</div> '; 
              } 
            } 
            else 
            { 
              echo' <div class="output danger">Şifre eşleşmiyor</div> '; 
            } 
          }
          else
          {
            echo' <div class="output danger">Kullanıcı zaten var</div> ';
          }
        } 
      ?>


  <div class="container-flud">
    <div class="menu-gecis">
      <button id="ug">Üye Giriş</button>
      <button id="ag">Kayıt Ol</button>
    </div>
    <div class="panel shadow rounded" style="height: 500px">
      <div class="menuler" id="uyegiris">
        <div class="form">
          <div class="Container">
            <input required="" autocomplete="off" type="text" name="kullaniciadi" class="input" id="ka" />
            <label class="label">Kullanıcı adı</label>
          </div>
          <div class="Container">
            <input required="" autocomplete="off" type="password" name="pwd" class="input" id="pwd" />
            <label class="label">Şifre</label>
          </div>
          <input type="button" value="Giriş Yap" onclick="gonder()" class="button" />

          <div class="giris-secenekleri">
            <button class="button" style="color: rgb(31, 78, 31)">
              <i class="fa-brands fa-google"></i>Google
            </button>
            <button class="button" style="color: rgb(69, 69, 219)">
              <i class="fa-brands fa-facebook-f"></i>Facebook
            </button>
          </div>

          <div style="
              display: flex;
              justify-content: space-evenly;
              margin-top: 10px;
            ">
            <a href="sifremiunutum.php" class="text-center">Şifremi Hatırlamıyorum</a>
          </div>
          <p class="w-100">
            Tüm hakklar saklıdır daha fazla bilgi almak için
            <a href="">Tıklayın</a>
          </p>
      </div>
      </div>  
      <div class="menuler" id="kayit">
        <form action="" method="post">
          <div class="Container">
            <input required="" autocomplete="off" type="text" name="isim" class="input" />
            <label class="label">Kullanıcı Adı</label>
          </div>
          <div class="Container">
            <input required="" autocomplete="off" type="email" name="eposta" class="input" />
            <label class="label">E-mail</label>
          </div>
          <div class="Container">
            <input required="" autocomplete="off" type="text" name="pwd" class="input" />
            <label class="label">Şifre</label>
          </div>
          <div class="Container">
            <input required="" autocomplete="off" type="text" name="pwd2" class="input" />
            <label class="label">Şifre(Tekrar)</label>
          </div>

          <input type="submit" value="Kayıt Ol" class="button" />
        </form>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="js/App.js"></script>
  <script>
    function gonder() {
      var kullaniciadi = $("#ka").val();
      var pwd = $("#pwd").val();
      $.post({
        url: "giris.php",
        data: { kullaniciadi: kullaniciadi, pwd: pwd },
        success: function (veri) {
          if (veri == "error") {
            swal({
              text: "Kullanıcı adı veya şifre hatalı",
              icon: "error",
              button: "Tamam",
            });
          }
          else if (veri == "anasayfa") {
            swal({
              text: "Giriş yapıldı",
              icon: "success",
              button: "Tamam",
            });
            setTimeout("location.href = 'anasayfa.php'", 1000);
          }
          else if (veri == "admin") {
            swal({
              text: "Admin Giriş yapıldı",
              icon: "success",
              button: "Tamam",
            });
            setTimeout("location.href = 'admin.php'", 1000);
          }
          else {
            swal({
              text: "Lütfen bilgileri eksiksiz giriniz",
              icon: "warning",
              button: "Tamam",
            });
          }
        }
      });
    }

    $(document).on('keypress', function (e) {
      if (e.keyCode === 13) {
        var kullaniciadi = $("#ka").val();
        var pwd = $("#pwd").val();
        $.post({
          url: "giris.php",
          data: { kullaniciadi: kullaniciadi, pwd: pwd },
          success: function (veri) {
            if (veri == "error") {
            swal({
              text: "Kullanıcı adı veya şifre hatalı",
              icon: "error",
              button: "Tamam",
            });
            }
            else if (veri == "anasayfa") {
              swal({
                text: "Giriş yapıldı",
                icon: "success",
                button: "Tamam",
              });
              setTimeout("location.href = 'anasayfa.php'", 1000);
            }
            else if (veri == "admin") {
              swal({
                text: "Admin Giriş yapıldı",
                icon: "success",
                button: "Tamam",
              });
              setTimeout("location.href = 'admin.php'", 1000);
            }
            else {
              swal({
                text: "Lütfen bilgileri eksiksiz giriniz",
                icon: "warning",
                button: "Tamam",
              });
            }
          }
        });
      }
    });
  </script>
</body>

</html>