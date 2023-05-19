$(document).ready(function () {
  $("select").formSelect();
});

setTimeout(function () {
  $(".sidenav").sidenav();
  $(".dropdown-trigger").dropdown({
    alignment: "left",
    hover: false,
    coverTrigger: false,
  });
}, 1000);

let buttons = document.querySelectorAll(".bt-buy");

for (let bt of buttons) {
  bt.onclick = () => {
    if (logged === "true") {
      alert("Compra realizada com sucesso!");
    } else {
      alert("Faça o login para começar a comprar!");
    }
  };
}

$(function () {
  $("#preco").maskMoney();
});
