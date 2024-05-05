// Admin
const btn = document.querySelectorAll(".m-btn");
const panels = document.querySelectorAll(".panels");
const as = document.getElementById("as");
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
  if (as === null) {
    as = document.getElementById("s");
  }

  if (as !== null) {
    as.style.display = "none";
  }
}
$(document).ready(function () {
  $(document).on("click", ".js-menu_toggle.closed", function (e) {
    e.preventDefault();
    $(".list_load, .list_item").stop();
    $(this).removeClass("closed").addClass("opened");

    $(".side_menu").css({ left: "0px" });

    var count = $(".list_item").length;
    $(".list_load").slideDown(count * 0.6 * 100);
    $(".list_item").each(function (i) {
      var thisLI = $(this);
      timeOut = 100 * i;
      setTimeout(function () {
        thisLI.css({
          opacity: "1",
          "margin-left": "0",
        });
      }, 100 * i);
    });
  });

  $(document).on("click", ".js-menu_toggle.opened", function (e) {
    e.preventDefault();
    $(".list_load, .list_item").stop();
    $(this).removeClass("opened").addClass("closed");

    $(".side_menu").css({ left: "-250px" });

    var count = $(".list_item").length;
    $(".list_item").css({
      opacity: "0",
      "margin-left": "-20px",
    });
    $(".list_load").slideUp(300);
  });
});

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

$(document).ready(function () {
  $(document).on("click", ".js-menu_toggle.closed", function (e) {
    e.preventDefault();
    $(".list_load, .list_item").stop();
    $(this).removeClass("closed").addClass("opened");

    $(".side_menu").css({ left: "0px" });

    var count = $(".list_item").length;
    $(".list_load").slideDown(count * 0.6 * 100);
    $(".list_item").each(function (i) {
      var thisLI = $(this);
      timeOut = 100 * i;
      setTimeout(function () {
        thisLI.css({
          opacity: "1",
          "margin-left": "0",
        });
      }, 100 * i);
    });
  });

  $(document).on("click", ".js-menu_toggle.opened", function (e) {
    e.preventDefault();
    $(".list_load, .list_item").stop();
    $(this).removeClass("opened").addClass("closed");

    $(".side_menu").css({ left: "-250px" });

    var count = $(".list_item").length;
    $(".list_item").css({
      opacity: "0",
      "margin-left": "-20px",
    });
    $(".list_load").slideUp(300);
  });
});


var kl = $("#kl");
var tl = $("#tl");
$.post("ajax.php",
  {
    harf: $("#ara").val(),
  },
  function (data) {
    kl.html(data);
  }
);
$("#ara").on("keyup", function () {
  $.post("ajax.php",
    {
      harf: $(this).val(),
    },
    function (data) {
      kl.html(data);
    }
  );
});


const check = document.getElementById("alert1");
document.addEventListener("DOMContentLoaded", function () {
  const darkMode = localStorage.getItem("darkMode");

  if (darkMode === "true") {
    $("body").addClass("dark");
    check.checked = true;
  }
  else {
    $("body").removeClass("dark");
    check.checked = false;
  }
});
check.onchange = function () {
  if (check.checked) {
    localStorage.setItem('darkMode', 'true');
    $("body").addClass("dark");
  }
  else {
    localStorage.setItem('darkMode', 'false');
    $("body").removeClass("dark");
  }
}
// Admin sonu
