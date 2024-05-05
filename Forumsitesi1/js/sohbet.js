const btn = document.querySelectorAll('.m-btn');
const panels = document.querySelectorAll(".panels");

openPanel(0);
for (let i = 0; i < panels.length; i++) {
	btn[i].addEventListener("click", function () {
	  openPanel(i);
	});
  }
function openPanel(index) {
	for (let i = 0; i < panels.length; i++) {
		panels[i].classList.remove("active");
	}
	panels[index].classList.add("active");
}
$(document).ready(function () {
	$(document).on('click', '.js-menu_toggle.closed', function (e) {
		e.preventDefault(); $('.list_load, .list_item').stop();
		$(this).removeClass('closed').addClass('opened');

		$('.side_menu').css({ 'left': '0px' });

		var count = $('.list_item').length;
		$('.list_load').slideDown((count * .6) * 100);
		$('.list_item').each(function (i) {
			var thisLI = $(this);
			timeOut = 100 * i;
			setTimeout(function () {
				thisLI.css({
					'opacity': '1',
					'margin-left': '0'
				});
			}, 100 * i);
		});
	});

	$(document).on('click', '.js-menu_toggle.opened', function (e) {
		e.preventDefault(); $('.list_load, .list_item').stop();
		$(this).removeClass('opened').addClass('closed');

		$('.side_menu').css({ 'left': '-250px' });

		var count = $('.list_item').length;
		$('.list_item').css({
			'opacity': '0',
			'margin-left': '-20px'
		});
		$('.list_load').slideUp(300);
	});
});

document.addEventListener("DOMContentLoaded", function () {

	function removeOutputDiv() {
		var outputDiv = document.querySelector(".output"); // Div'i seç
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


$(document).ready(function () {
	$(document).on('click', '.js-menu_toggle.closed', function (e) {
		e.preventDefault(); $('.list_load, .list_item').stop();
		$(this).removeClass('closed').addClass('opened');

		$('.side_menu').css({ 'left': '0px' });

		var count = $('.list_item').length;
		$('.list_load').slideDown((count * .6) * 100);
		$('.list_item').each(function (i) {
			var thisLI = $(this);
			timeOut = 100 * i;
			setTimeout(function () {
				thisLI.css({
					'opacity': '1',
					'margin-left': '0'
				});
			}, 100 * i);
		});
	});

	$(document).on('click', '.js-menu_toggle.opened', function (e) {
		e.preventDefault(); $('.list_load, .list_item').stop();
		$(this).removeClass('opened').addClass('closed');

		$('.side_menu').css({ 'left': '-250px' });

		var count = $('.list_item').length;
		$('.list_item').css({
			'opacity': '0',
			'margin-left': '-20px'
		});
		$('.list_load').slideUp(300);
	});



	$('#yy').on('click', function () {
		var yorum = document.getElementById('yorum').value;
		var ka = document.getElementById('ka').value;
		var id = document.getElementById('id').value;

		$.ajax({
			url: "yorum.php",
			method: "POST",
			data: { yorum: yorum, ka, id },
			success: function (data) {
				setTimeout(() => {
					$(".yorumlar").html(data);
					yorum.value = "";
				}, 500);
			},
		});
	});

	$(document).on("click", ".sil", function(){
		var silinecek = $(this).attr('id');

		$.ajax({
			url: "yorum.php",
			method: "POST",
			data: { silinecek },
			success: function (data) {

			},
		});
	});

	$(document).on("click", ".sil", function(){
		setTimeout(() => {
			location.reload();
		}, 500);
	});
});