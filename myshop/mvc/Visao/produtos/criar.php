<main>
    <?php if ($mensagemFlash) : ?>
        <div class="container">
            <div class="alert card green lighten-4 green-text text-darken-4">
                <div class="card-content">
                    <p><i class="material-icons">check_circle</i><span><?= $mensagemFlash ?></span></p>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="fields">
        <img src="<?= URL_IMG . 'logo.png'?>" alt="">
        <div class="container">
            <form id="form-data" enctype="multipart/form-data" action="<?= URL_RAIZ . 'produtos/criar'?>" method="post" class="col s12">
                <div class="container">
                    <div class="input-field" <?= $this->getErroCss('nomeProduto') ?>>
                        <input id="nome" name="nome" type="text" value="<?= $this->getPost('nome') ?>" data-length="10" autofocus>
                        <label for="nome">Nome do produto</label>
                    </div>
                </div>
                <div class="div-direction">
                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nomeProduto']) ?>
                </div>
                <div class="container">
                    <div class="input-field" <?= $this->getErroCss('descricao') ?> >
                        <input id="descricao" name="descricao" type="text" value="<?= $this->getPost('descricao') ?>" data-length="10">
                        <label for="descricao">Descrição do produto</label>
                    </div>
                </div>
                <div class="div-direction">
                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'descricao']) ?>
                </div>
                <div class="container">
                    <div class="input-field" <?= $this->getErroCss('preco') ?> >
                        <input id="preco" name="preco" type="text" data-prefix="R$ " data-thousands="." data-decimal="," data-length="10">
                        <label for="preco">Preço</label>
                    </div>
                </div>
                <div class="div-direction">
                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'preco']) ?>
                </div>
                <div class="container">
                    <div class="file-field input-field" <?= $this->getErroCss('imagem') ?>>
                        <div class="btn #1b5e20 green darken-4">
                            <span>Imagem</span>
                            <input name="imagem" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" value="Tamanho máximo: 500 kb" type="text">
                        </div>
                    </div>
                    <div class="div-direction">
                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'imagem']) ?>
                    </div>
                </div>
                <button class="button-submit" type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
</main>