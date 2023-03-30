let menu = '';
let logged = localStorage.getItem('isLogged');

if (logged === 'true') {
    menu = `<ul id="dropdown1" class="dropdown-content">
    <li><a href="./app/pages/login.html">Perfil</a></li>
    <li><a href="./app/pages/register.html">Sair</a></li>
    <!-- <li class="divider"></li> -->
  </ul>
  <div class="navbar-fixed">
    <nav>
      <div class="container">
        <div class="nav-wrapper">
          <a href="../../index.html" class="brand-logo">
            <img src="../../assets/images/logo.png" alt="gtiLogo">
          </a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="sass.html">Pesquisar</a></li>
            <li><a href="./register-offers.html">Cadastrar produto</a></li>
            <li><a href="./offers.html">Ofertas</a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
                <!--<img class="profile-icon" src="./assets/images/profile.svg" alt="Icone">-->
                <span class="tiny material-icons">account_circle</span>
                <i class="material-icons right">arrow_drop_down</i></a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">Javascript</a></li>
    <li><a href="mobile.html">Mobile</a></li>
  </ul>`;

    document.getElementById('menu').innerHTML = menu;
}

let reader = new FileReader();

document.getElementById("form-data").addEventListener('submit', () => {
    let email = document.querySelector("#input_title").value;
    let name = document.querySelector("#input_description").value;
    alert('Cadastrado com sucesso!');
});