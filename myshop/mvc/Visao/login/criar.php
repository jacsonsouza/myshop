<main>
    <div class="fields">
        <img src="<?= URL_IMG . 'logo.png' ?>" alt="">
        <div class="container">
            <div class="container">
                <form id="form-login" action="<?= URL_RAIZ . 'login' ?>" method="post" class="col s12">
                    <div class="container">
                        <div class="input-field" <?= $this->getErroCss('login') ?>>
                            <input id="email" name="email" type="email" class="validate" value="<?= $this->getPost('email') ?>" autofocus>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="container">
                        <div class="input-field" <?= $this->getErroCss('login') ?>>
                            <input id="password" name="password" type="password" class="validate" value="<?= $this->getPost('password') ?>">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="div-direction">
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
                    </div>
                    <div class="div-direction">
                        <p>Não tem uma conta?</p>
                        <a href="<?= URL_RAIZ . "usuarios/criar"?>">  Cadastre-se!</a>
                    </div>
                    <button class="button-submit" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</main>
