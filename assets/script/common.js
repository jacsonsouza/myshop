$(".dropdown-trigger").dropdown(
    {
        hover: false,
        coverTrigger: false
    }
);

$(document).ready(function () {
    $('.sidenav').sidenav();
});

$(document).ready(function () {
    $('.carousel').carousel(
        {
            duration: 200,
            fullWidth: true,
            indicators: true
        }
    );
});

$(document).ready(function () {
    $('select').formSelect();
});