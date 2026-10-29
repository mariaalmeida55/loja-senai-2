
<?php
include 'conexao.php';
include 'funcoes.php';

$clientes = $pdo->query(
    'SELECT id, nome FROM cliente ORDER BY nome'
)->fetchAll(PDO::FETCH_ASSOC);

$produtos = $pdo->query(
    'SELECT id, nome, preco FROM produto ORDER BY nome'
)->fetchAll(PDO::FETCH_ASSOC);

$venda = [
    'id' => '',
    'cliente_id' => '',
    'produto_id' => '',
    'quantidade' => 1,
    'data_venda' => date('Y-m-d')
];

$titulo = 'Nova venda';

if (isset($_GET['id'])) {
    $sql = $pdo->prepare('SELECT * FROM venda WHERE id = ?');
    $sql->execute([$_GET['id']]);
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $venda = $resultado;
        $titulo = 'Editar venda';
    }
}

$pagina = 'vendas.php';
include 'topo.php';
?>

<div class="caixa">
    <h1><?= $titulo ?></h1>

    <form method="post" action="venda_salvar.php" class="formulario">

        <input type="hidden" name="id"
               value="<?= e($venda['id']) ?>">

        <div class="campo">
            <label for="cliente_id">Cliente</label>

            <select id="cliente_id" name="cliente_id" required>
                <option value="">Escolha o cliente</option>

                <?php foreach ($clientes as $cliente) {
                    $marcado = (
                        $cliente['id'] == $venda['cliente_id']
                    ) ? 'selected' : '';
                ?>
                    <option value="<?= e($cliente['id']) ?>"
                        <?= $marcado ?>>
                        <?= e($cliente['nome']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="campo">
            <label for="produto_id">Produto</label>

            <select id="produto_id" name="produto_id" required>
                <option value="">Escolha o produto</option>

                <?php foreach ($produtos as $produto) {
                    $marcado = (
                        $produto['id'] == $venda['produto_id']
                    ) ? 'selected' : '';
                ?>
                    <option value="<?= e($produto['id']) ?>"
                        <?= $marcado ?>>
                        <?= e($produto['nome']) ?>
                        (<?= dinheiro($produto['preco']) ?>)
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="campo">
            <label for="quantidade">Quantidade</label>
            <input type="number" id="quantidade"
                   name="quantidade" min="1"
                   value="<?= e($venda['quantidade']) ?>" required>
        </div>

        <div class="campo">
            <label for="data_venda">Data da Venda</label>
            <input type="date" id="data_venda"
                   name="data_venda"
                   value="<?= e($venda['data_venda']) ?>" required>
        </div>

        <div class="dica">
            O total é calculado ao salvar: preço do produto x quantidade.
        </div>

        <div class="acoes">
            <button type="submit" class="botao">Salvar</button>
            <a href="vendas.php" class="botao claro">Cancelar</a>
        </div>

    </form>
</div>

<?php include 'rodape.php'; ?>