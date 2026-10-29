<?php
 
include 'conexao.php';
 
echo'<h1>Conexão OK!</h1>';
echo'<p>O PHP abriu o arquivo banco/loja.db.</p>';
 
$cliente = $pdo->query('SELECT COUNT(*) FROM cliente')->fetchColumn();
$produto = $pdo->query('SELECT COUNT(*) FROM  produto')->fetchColumn();
$venda = $pdo->query('SELECT COUNT(*) FROM  venda')->fetchColumn();

echo '<ul>';
echo '<li>Cliente: ' . $cliente . '</li>';
echo '<li>Produto: ' . $produto . '</li>';
echo '<li>Vendas: ' . $venda . '</li>';
echo'</ul>';