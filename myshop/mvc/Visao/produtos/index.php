<main>
    <div class="container">
        <div class="div-filtros">
            <h2>Produtos</h2>

            <div id="filtro">
                <div class="div-pesquisa">
                    <input id="input-pesquisa" type="text" placeholder="Pesquisar...">
                    <button id="button-pesquisa">
                        <span class="material-icons">search</span>
                    </button>
                </div>            
                <select class="select-filtro">
                    <option value="" disabled selected>Filtrar por...</option>
                    <option value="1">Antigos</option>
                    <option value="2">Novos</option>
                    <option value="3">Preço</option>
                </select>
            </div>
        </div>

        <div class="card-list">
            <?php foreach ($produtos as $produto) : ?>
            <div class="div-card">
                <div class="card small">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img
                        class="activator"
                        src="<?= URL_IMG . "{$produto->getId()}.png"?>"
                        />
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"
                        ><?= $produto->getNomeProduto()?><i class="material-icons right">more_vert</i></span
                        >
                        <p>Vendido por <?= $produto->getUsuario()->getNome()?></p>
                        <p><?= $produto->getPreco()?></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"
                        ><?= $produto->getNomeProduto()?><i class="material-icons right">close</i></span
                        >
                        <p>
                        <?= $produto->getDescricao()?>
                        </p>
                    </div>
                </div>
                <div class="buttons">
                    <?php if ($idUsuario != $produto->getUsuario()->getId()) : ?>
                        <div class="bt-buy">
                            <a href="<?= URL_RAIZ . 'produtos/' . $produto->getId()?>">Comprar</a>
                        </div>
                    <?php else : ?>
                        <form action="<?=URL_RAIZ . 'produtos/' . $produto->getId() ?>" method="post">
                        <input type="hidden" name="_metodo" value="DELETE">
                        <button type="submit" class="button-delete">
                            <span class="material-icons">delete</span>
                        </button>
                        </form>
                    <?php endif ?>
                </div>
            </div>
            <?php endforeach ?>
	</div>
</main>