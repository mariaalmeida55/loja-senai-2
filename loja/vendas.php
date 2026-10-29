<?php
include 'conexao.php';
include 'funcoes.php';

$sql = 'SELECT
            venda.*,
            cliente.nome AS cliente,
            produto.nome AS produto,
            produto.imagem
        FROM venda
        JOIN cliente ON cliente.id = venda.cliente_id
        JOIN produto ON produto.id = venda.produto_id
        ORDER BY venda.data_venda DESC, venda.id DESC';

$vendas = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$total_geral = 0;

foreach ($vendas as $venda) {
    $total_geral += $venda['valor_total'];
}

$msg = $_GET['msg'] ?? '';

$titulo = 'Vendas';
$pagina = 'vendas.php';

include 'topo.php';
?>

<div class="titulo-pagina">
    <h1>Vendas</h1>
    <a href="venda_form.php" class="botao">+ Nova venda</a>
</div>

<?php if ($msg === 'salvo') { ?>
    <div class="aviso">Venda salva com sucesso!</div>
<?php } ?>

<?php if ($msg === 'excluido') { ?>
    <div class="aviso">Venda excluída.</div>
<?php } ?>

<div class="tabela">
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Qtd.</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php if (count($vendas) > 0) { ?>

                <?php foreach ($vendas as $venda) { ?>
                    <tr>
                        <td>
                            <?= e(data_br($venda['data_venda'])) ?>
                        </td>

                        <td>
                            <?= e($venda['cliente']) ?>
                        </td>

                        <td>
                            <div class="produto-celular">
                                <img
                                    src="<?= e($venda['imagem']) ?>"
                                    alt=""
                                >
                                <?= e($venda['produto']) ?>
                            </div>
                        </td>

                        <td>
                            <?= (int) $venda['quantidade'] ?>
                        </td>

                        <td>
                            <?= dinheiro($venda['valor_total']) ?>
                        </td>

                        <td>
                            <div class="acoes-tabela">
                                <a
                                    href="venda_form.php?id=<?= (int) $venda['id'] ?>"
                                    class="botao pequeno"
                                >
                                    Editar
                                </a>

                                <a
                                    href="venda_excluir.php?id=<?= (int) $venda['id'] ?>"
                                    class="botao pequeno perigo"
                                    onclick="return confirm('Deseja realmente excluir esta venda?');"
                                >
                                    Excluir
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>

            <?php } else { ?>
                <tr>
                    <td colspan="6">
                        Nenhuma venda cadastrada.
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include 'rodape.php'; ?>
