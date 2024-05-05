<header id="hed">
	<?php
		@session_start();
		$ka = $_SESSION['kullanici_adi'];

		@session_start();
		if($_SESSION['rol'] == "(Admin)")
		{
			?>
			<a href="admin.php"> <center><img src="img/Adsız.png" alt="" id="img"></center></a>
			<?php
		}
		else
		{
			?>
			<a href="anasayfa.php"> <center><img src="img/Adsız.png" alt="" id="img"></center></a>
			<?php
		}
	?>
</header>


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
			img.src = "img/Adsız.png";
			img.style.left = 0 + "%";
		}
		else {
			img.style.left = 43 + "%";
			img.src = "img/logo.png";
		}
	});
	if (window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href);
	}
</script>