<main>
    <div class="container">
        <h2>Minhas vendas</h2>
        <div class="col s12 m5">
            <div class="card-panel">
                <?php 
                $totalVendido = 0.0;
                $totalVendas = 0;
                foreach($produtosvendidos as $produto) 
                {
                    $totalVendido += $produto['preco'];
                    $totalVendas++;
                }
                ?>
                <span class="white-text">
                    <h6>Valor total de vendas: <?= 'R$ ' . number_format($totalVendido, 2, ',', '.') ?></h6>
                    <h6>Quantidade de vendas: <?= $totalVendas . ' produto(s)' ?></h6>
                </span>
            </div>
        </div>

        <table class="highlight">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Comprador</th>
                </tr>
            </thead>
            <!--floatval(str_replace(',', '.', substr($produto['preco'], 2))) -->
            <tbody>
                <?php foreach($produtosvendidos as $produto) : ?>
                    <tr>
                        <td><?=$produto['nome']?></td>
                        <td><?=$produto['descricao']?></td>
                        <td><?='R$' . number_format($produto['preco'], 2, ',', '.')?></td>
                        <td><?=$produto['nomeComprador']?></td>
                    </tr>
                <?php  endforeach ?>
            </tbody>
        </table>
    </div>
</main>
