<?php include'conexao.php';
include'funcoes.php';
 
$titulo = 'Novo cliente';
$pagina = 'clientes.php';
include 'topo.php';
?>
 
<div class="caixa">
    <h1>Novo cliente</h1>
 
    <form method="post" action="cliente_salvar.php" class="formulario">
 
        <div class="campo">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
        </div>
 
        <div class="campo">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email">
        </div>
 
        <div class="campo">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="(11) 99999-9999">
        </div>
 
        <div class="campo">
            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="cidade">
        </div>
 
        <div class="acoes">
            <button type="submit" class="botao">Salvar</button>
            <a href="clientes.php" class="botao claro">Cancelar</a>
        </div>
    </form>
</div>
 
<?php include 'rodape.php'; ?>