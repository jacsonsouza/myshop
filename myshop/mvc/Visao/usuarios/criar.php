<main>
    <div class="fields">
        <img src="<?= URL_IMG . 'logo.png' ?>" alt="">
        <div class="container">
            <div class="container">
                <form class="col s12" id="form-data" action="<?= URL_RAIZ . 'usuarios' ?>" method="post">

                    <div class="container">
                        <div class="input-field" <?= $this->getErroCss('email') ?>">
                            <input id="email" type="email" name="email" class="validate" autofocus>
                            <label for="email">Email</label>
                        </div>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
                    </div>

                    <div class="container">
                        <div class="input-field">
                            <input id="input-name" type="text" name="full-name" data-length="10">
                            <label for="input-name">Nome Completo</label>
                        </div>
                    </div>

                    <div class="container">
                        <div class="input-field" <?= $this->getErroCss('senha') ?>>
                            <input id="password" name="password" type="password" class="validate">
                            <label for="password">Senha</label>
                        </div>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
                    </div>

                    <div class="container">
                        <div class="input-field" <?= $this->getErroCss('confim-password') ?>>
                            <input id="confirm-password" type="password" name="confirm-password" class="validate">
                            <label for="confirm-password">Confirmar Senha</label>
                        </div>
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'confirm-password']) ?>
                    </div>
                    <div class="div-direction">
                        <p>Já tem conta?</p>
                        <a href="<?= URL_RAIZ . "login"?>"> Entre!</a>
                    </div>
                    <button class="button-submit" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</main>
