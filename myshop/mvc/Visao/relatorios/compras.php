<main>
    <div class="container">
        <h2>Minhas compras</h2>
        <div class="col s12 m5">
            <div class="card-panel">
                <?php 
                    $totalGasto = 0.0;
                    $totalCompras = 0;
                    foreach($produtoscomprados as $produto) 
                    {
                        $totalGasto += $produto['preco'];
                        $totalCompras++;
                    }
                ?>
                <span class="white-text">
                    <h6>Valor total de compras: <?= 'R$ ' . number_format($totalGasto, 2, ',', '.') ?></h6>
                    <h6>Quantidade de compras: <?= $totalCompras . ' produto(s)' ?></h6>
                </span>
            </div>
        </div>

        <table class="highlight">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Data da compra</th>
                </tr>
            </thead>
            <!--floatval(str_replace(',', '.', substr($produto['preco'], 2))) -->
            <tbody>
                <?php foreach($produtoscomprados as $produto) : ?>
                    <tr>
                        <td><?=$produto['nome']?></td>
                        <td><?=$produto['descricao']?></td>
                        <td><?='R$' . number_format($produto['preco'], 2, ',', '.')?></td>
                        <td><?=$produto['data']?></td>
                    </tr>
                <?php  endforeach ?>
            </tbody>
        </table>
    </div>
</main>
