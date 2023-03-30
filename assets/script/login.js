let menu = '';
let logged = localStorage.getItem('isLogged');

if (logged === 'true') {
  menu = `<ul id="dropdown1" class="dropdown-content">
    <li><a href="./app/pages/login.html">Perfil</a></li>
    <li><button id="logout">Sair</button></li>
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
            <li><a href="sass.html">Cadastrar produto</a></li>
            <li><a href="./offers.html">Ofertas</a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
                <img class="profile-icon" src="../../assets/images/profile.svg" alt="Icone">
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

document.getElementById("form-login").addEventListener('submit', () => {
  alert('Aqui');
  let email = document.querySelector("#email").value;
  let pass = document.querySelector("#password").value;

  let userString = localStorage.getItem(email);

  let user = JSON.parse(userString);
  console.log(user.password);
  if (user.password === pass) {
    localStorage.setItem('isLogged', 'true');
    return true;
  } else {
    alert('Senha Incorreta!');
    return false;
  }
});

document.getElementById('logout').onclick = () => {
  localStorage.setItem('isLogged', false);
  document.location.reload();
};