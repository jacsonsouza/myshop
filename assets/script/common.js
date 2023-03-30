$(document).ready(function () {
  $('select').formSelect();
});

setTimeout(function () {
  $('.sidenav').sidenav();
  $('.dropdown-trigger').dropdown({
    alignment: 'left',
    hover: false,
    coverTrigger: false,
  });
}, 1000);