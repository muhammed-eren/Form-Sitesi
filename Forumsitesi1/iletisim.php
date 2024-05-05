<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MesamMutfakİletişim</title>
    <link rel="shortcut icon" href="icons8-tv-50.png" type="image/x-icon">
    <link rel="stylesheet" href="css/iletisim.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    </style>
</head>
<body>
    <header>
        <span class="logo">
            <h2>SARILAR</h2>
        </span>
        <nav>
            <ul class="navbar">
                <li>
                    <a href="anasayfa.php">
                        <button class="btn2">
                            Ana Sayfa
                        </button>
                    </a>
                </li>
                <li>
                    <a href="hakkimizda.php">
                        <button class="btn">
                            <label for="">Hakkımızda</label>
                        </button>
                    </a>
                </li>
            </ul>
            <div class="navbar2">
                <label class="cizgi2" for="cizgi">
                    <input type="checkbox" id="cizgi">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
        </nav>
    </header>

    <div class="form">
        <div class="col-1">
            <div class="yazi">
                <h2>İletişim</h2>
                <p>
                    <address>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi, ratione!</address>
                    <br>
                    Çalışma saatleri: 8:00-19:00
                    <br>
                    <a href="#">mesammutfak@gmail.com</a>
                </p>
                <div class="icon">
                    <a href="http://" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram insta"></i></a>
                    <a href="http://" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f face"></i></a>
                    <a href="http://" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-x-twitter x"></i></a>
                    <a href="http://" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-google-plus-g google"></i></a>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="inputs">
                <form action="" method="post">
                    <input type="text" name="" id="" placeholder="İsminiz" required>
                    <input type="email" name="" id="" placeholder="Email adresiniz" required>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Mesajınız" required></textarea>
                    <button class="submitBtn">
                        Gönder
                        <svg fill="white" viewBox="0 0 448 512" height="1em" class="arrow"><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"></path></svg>
                      </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        var toggleButton = document.getElementById('cizgi');
        var menu = document.querySelector('.navbar');

        toggleButton.addEventListener('click', function () {
            menu.classList.toggle('active');
        });
    </script>
</body>
</html>