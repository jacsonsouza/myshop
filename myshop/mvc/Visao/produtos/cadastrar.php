<main>    
    <div class="fields">
        <img src="<?= URL_IMG . 'logo.png'?>" alt="">
        <div class="container">
            <form id="form-data" enctype="multipart/form-data" action="<?= URL_RAIZ . 'produtos/cadastrar'?>" method="post" class="col s12">
                <div class="container">
                    <div class="input-field">
                        <input id="nome" name="nome" type="text" data-length="10" autofocus>
                        <label for="nome">Nome do produto</label>
                    </div>
                </div>
                <div class="container">
                    <div class="input-field">
                        <input id="descricao" name="descricao" type="text" data-length="10">
                        <label for="descricao">Descrição do produto</label>
                    </div>
                </div>
                <div class="container">
                    <div class="input-field">
                        <input id="preco" name="preco" type="text" data-prefix="R$ " data-thousands="." data-decimal="," data-length="10">
                        <label for="preco">Preço</label>
                    </div>
                </div>
                <div class="container">
                    <div class="file-field input-field" <?= $this->getErroCss('imagem') ?>>
                        <div class="btn #1b5e20 green darken-4">
                            <span>Imagem</span>
                            <input name="imagem" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" value="imagem de 500 kb" type="text">
                        </div>
                        <?= $this->incluirVisao('util/formErro.php', ['campo' => 'imagem'])?>
                    </div>
                </div>
                <button class="button-submit" type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
</main>