<main>
    <div class="container">
        <h2>Relatórios</h2>
        <div class="row">
            <div class="input-field col s6">
                <select id="select-profile">
                    <option value="1" selected>Minhas vendas</option>
                    <option value="2">Minhas compras</option>
                </select>
                <label>Buscar</label>
            </div>
        </div>

        <?php foreach($produtoscomprados as $produto) : ?>
        <div class="row">
		<div class="col s12">
			<div class="card-panel">
				<div class="img-relatorio">
                    <img src="<?= URL_IMG . $produto['id'] . '.png' ?>" alt="">
                </div>
                <div>
                    <h5><?= $produto['nome']?></h5>
                    <p>Descrição: <?= $produto['descricao']?></p>
                    <p>Valor da compra: <?= $produto['preco']?></p>
                    <p>Data da compra: <?= $produto['data']?></p>
                </div>
			</div>
		</div>
	    </div>
        <?php  endforeach ?>
    </div>
</main>
