<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_CSS . 'materialize.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'style.css' ?>">
    <link rel="icon" type="image/x-icon" href="<?= URL_IMG . 'logo.png' ?>">
    <script src="<?= URL_JS . 'jquery-3.1.1.min.js' ?>"></script>
    <script src="<?= URL_JS . 'materialize.min.js' ?>"></script>
    <script src="<?= URL_JS . 'jquery.maskMoney.min.js' ?>"></script>    
    <script src="<?= URL_JS . 'comum.js' ?>"></script>
</head>
<body>

<ul id="dropdown1" class="dropdown-content">
    <?php if ($usuarioLogado) : ?>
      <li><a href="<?= URL_RAIZ . 'relatorios' ?>">Relatórios</a></li>
      <li><a href="<?= URL_RAIZ . 'logout' ?>">Sair</a></li>
    <?php else : ?>
      <li><a href="<?= URL_RAIZ . 'login' ?>">Entrar</a></li>
      <li><a href="<?= URL_RAIZ . 'usuarios/criar' ?>">Cadastrar</a></li>
    <?php endif ?>
  </ul>
  <div class="navbar-fixed">
    <nav>
      <div class="container">
        <div class="nav-wrapper">
          <a href="<?= URL_RAIZ . 'home' ?>" class="brand-logo">
            <img src="<?= URL_IMG . 'logo.png'?>" alt="gtiLogo">
          </a>
          <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
          <?php if ($usuarioLogado) : ?>
            <li><a href="<?= URL_RAIZ . "produtos/cadastrar"?>">Cadastrar produtos</a></li>
          <?php endif ?>
            <li><a href="<?= URL_RAIZ . "produtos"?>">Produtos</a></li>
            <!-- Dropdown Trigger -->
            <li>
              <a class="dropdown-trigger" href="#!" data-target="dropdown1">
                <!-- <img class="profile-icon" src="./assets/images/profile.svg" alt="Icone"> -->
                <i class="material-icons left md-36">account_circle</i>
                <i class="material-icons right">arrow_drop_down</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <ul class="sidenav" id="mobile-demo">
    <li><a href="<?= URL_RAIZ . 'login'?>">Entrar</a></li>
    <li><a href="<?= URL_RAIZ . 'usuarios/criar'?>">Cadastra</a></li>
    <li><a href="<?=URL_RAIZ . 'produtos'?>">Ofertas</a></li>
  </ul>
  </div>

<?php $this->imprimirConteudo() ?>

<footer class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">MyShop</h5>
          <p class="grey-text text-lighten-4">Tudo o que um sonho precisa para ser realizado é alguém que acredite que
            ele possa ser realizado. - Roberto Shinyashiki
          </p>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © 2023 Copyright MyShop
      </div>
    </div>
</footer>

</body>
</html>
