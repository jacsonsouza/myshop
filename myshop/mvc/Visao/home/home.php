<main> 
    <div class="container">
        <h3>Alguns produtos</h3>
        <hr>
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
                            <span class="card-title activator grey-text text-darken-4">
                                <?= $produto->getNomeProduto()?><i class="material-icons right">more_vert</i>
                            </span>
                            <p><?= 'Preço: R$ ' . number_format($produto->getPreco(), 2, ',', '.') ?></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"
                            ><?= $produto->getNomeProduto()?><i class="material-icons right">close</i></span
                            >
                            <p><?= $produto->getDescricao()?></p>
                            <p>Vendido por <?= $produto->getUsuario()->getNome()?></p>
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
    </div>
</main>