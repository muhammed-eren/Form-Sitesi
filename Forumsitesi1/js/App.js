// index
const ug = document.getElementById("ug");
const ag = document.getElementById("ag");

const uyeg = document.getElementById("uyegiris");
const kayit = document.getElementById("kayit");

uyeg.classList.add("active");
ug.classList.add("active");
ug.addEventListener("click", () => {
  ug.classList.add("active");
  ag.classList.remove("active");
  uyeg.classList.add("active");
  kayit.classList.remove("active");
});
ag.addEventListener("click", () => {
  ag.classList.add("active");
  ug.classList.remove("active");
  kayit.classList.add("active");
  uyeg.classList.remove("active");
});
// index sonu

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