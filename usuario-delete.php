<?php
// Inicia a sessão
session_start();
// Verifica se o índice 'usuario_id' NÃO está definido na sessão
if (!isset($_SESSION['usuario_id']))
	// Se não estive, redireciona o usuário para o login.php
	header('location:login.php');

// Inclui o arquivo de conexão com o banco de dados
include "includes/conexao.php";

// Recebe a id do usuário a ser excluído
$id = $_GET['id'];

// Monta o comando SQL para excluir um comentário do banco
$query = "DELETE FROM usuario WHERE id = '$id'";

// Verifica se o comando foi executado corretamente
if (mysql_query($query)) {
	// Exclui da sessão os índices 'usuario_id' e 'usuario_nome'
	unset($_SESSION['usuario_id']);
	unset($_SESSION['usuario_nome']);
	// Se sim, o comentário foi cadastrado e o usuário é redirecionado para o index.php
	header("location:index.php");
} else {
	// Se não, exibe o erro ocorrido no MySQL
	echo mysql_error();
	exit;
}

?>