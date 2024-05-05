<?php
	include 'datebase.php';
	@session_start();
	$kid = $_SESSION['kullanici_adi'];
	$alici = $_GET["id"];

	$abilgi = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$alici'");
	$arow = $abilgi->fetch(PDO::FETCH_ASSOC);

	$kbilgi = $db->query("SELECT * FROM kayitbilgi WHERE kullaniciadi = '$kid'");
	$krow = $kbilgi->fetch(PDO::FETCH_ASSOC);

	$sorgu = $db->query("DELETE FROM yanit WHERE sohbetisim = '$alici'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/mesajlasma.css">
    <link rel="stylesheet" href="css/anasayfa.css">
</head>
<body>
<main class="content">
    <div class="container p-0">
		<?php
			@session_start();
			if($_SESSION['rol'] == "(Admin)"){
				echo '<div class="icerik d-flex mb-3"><a href="admin.php" style="color: var(--color); display: flex; align-items: center; gap: 10px; text-decoration: none;"><i class="fa-solid fa-house" style="margin-bottom: 6px;"></i>Anasayfa</a></div>';
			}
			else
			{
				echo '<div class="icerik d-flex mb-3"><a href="anasayfa.php" style="color: var(--color); display: flex; align-items: center; gap: 10px; text-decoration: none;"><i class="fa-solid fa-house" style="margin-bottom: 6px;"></i>Anasayfa</a></div>';
			}
		?>
		<div class="card">
			<div class="row g-0">
				<div class="col col-lg col-xl">
					<div class="py-2 px-4 border-bottom">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="<?=$arow["pp"]?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3" style="margin-left: 10px;">
								<strong><?=$alici?></strong>
							</div>
							<div>
								<?php
									$b1 = @$_POST["1"];
									$b2 = @$_POST["2"];

									if(isset($b1))
									{
										echo '<div class="output danger">Bir sorun oluştu lütfen daha sonra tekrar deneyiniz</div>';
									}
									if(isset($b2))
									{
										echo '<div class="output danger">Kamera bulunamadı</div>';
									}
								?>
								<form action="" method="post">
									<button type="submit" name="1" class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>
									<button type="submit" name="2" class="btn btn-info btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
									<button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
								</form>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4" id="chat">
							
							<?php
								$mesaj = @$_POST["mesaj"];
									try {
										if(!empty($mesaj))
										{
											
											date_default_timezone_set('Europe/Istanbul');
											$tarih = date('H:i');
											$sorgu = $db->prepare("INSERT INTO sohbet SET alici_id=:alici,gonderici_id=:g_id ,mesaj=:mesaj,tarih=:tarih");
											
											$sorgu->bindParam(':alici', $alici, PDO::PARAM_STR);
											$sorgu->bindParam(':mesaj', $mesaj, PDO::PARAM_STR);
											$sorgu->bindParam(':g_id', $kid, PDO::PARAM_STR);
											$sorgu->bindParam(':tarih', $tarih, PDO::PARAM_STR);
											$sorgu->execute();

											$msj =  $kid."<br>" . substr($mesaj, 0, 25);
											$bildirim = $db->prepare("INSERT INTO yanit (isim, mesaj,sohbetisim) VALUES (:alici, :msj ,:sohbetisim)");
											$bildirim->execute(array(':alici' => $alici, ':msj' => $msj, ':sohbetisim' => $kid));
										}
										try {
											$sql = $db->query("SELECT * FROM sohbet WHERE alici_id='$kid' AND gonderici_id='$alici' OR alici_id='$alici' AND gonderici_id='$kid'");
											if($sql->rowCount())
											{
												while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
													if($row["alici_id"] == $alici)
													{
														?>
															<div class="chat-message-right mb-4">
																<div>
																	<img src="<?=$krow["pp"]?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
																	<div class="text-muted small text-nowrap mt-2"><?=$row["tarih"]?></div>
																</div>
																<div class="flex-shrink-1 rounded py-2 px-3 mr-3 m">
																	<div class="font-weight-bold mb-1"><?=$kid?></div>
																	<?=$row["mesaj"]?>
																</div>
															</div>
														<?php
													}
													else{
														?>
															<div class="chat-message-left mb-4">
																<div>
																	<img src="<?=$arow["pp"]?>" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
																	<div class="text-muted small text-nowrap mt-2"><?=$row["tarih"]?></div>
																</div>
																<div class="flex-shrink-1 rounded py-2 px-3 mr-3 m" id="mesaj">
																	<div class="font-weight-bold mb-1"><?=$alici?></div>
																	<?=$row["mesaj"]?>
																</div>
															</div>
														<?php
													}
												}
											}
											else
											{
												echo "<center>Sohbette başlayın...</center>";
											}
										} catch (PDOExcaption $m) {
											echo "Mesaj yok";
										}
									} catch (PDOExcaption $m) {
										echo m->getMesagge();
									}
									finally{
									}
								
							?>
						</div>
					</div>
					<form action="" method="post" class="w-100">
						<div class="flex-grow-0 py-3 px-4 border-top">
							<div class="input-group">
								<input type="text" id="msj" name="mesaj" class="form-control" placeholder="Bir mesaj yaz..." autocomplete="off">
								<button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
	$(document).ready(function () {

	function removeOutputDiv() {
		var outputDiv = document.querySelector(".output");
		if (outputDiv) {
			outputDiv.remove();
		}
	}

	setTimeout(() => {
		var outputDiv = document.querySelector(".output");
		if (outputDiv) {
			outputDiv.style.transition = "opacity 1s";
			outputDiv.style.opacity = "0";
		}
	}, 3000);

	setTimeout(removeOutputDiv, 4000);
	});
	if (window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href);
	}
	window.onload = function() {
    	window.scrollTo(0, document.body.scrollHeight);
    	document.getElementById('chat').scrollTo(0, document.getElementById('chat').scrollHeight);
	}
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