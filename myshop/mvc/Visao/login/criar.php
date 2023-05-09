<main>
    <div class="fields">
        <img src="<?= URL_IMG . 'logo.png' ?>" alt="">
        <div class="row">
            <form id="form-login" action="<?= URL_RAIZ . 'login' ?> "method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12" <?= $this->getErroCss('login') ?>>
                        <input id="email" name="email" type="email" class="validate">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12" <?= $this->getErroCss('login') ?>>
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <?php $this->incluirVisao('util/formErro.php', ['campo' => 'login']) ?>
                <button class="bt" type="submit">Entrar</button>
            </form>
        </div>
    </div>
</main>
