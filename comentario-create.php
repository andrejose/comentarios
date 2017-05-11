<?php

// Inicia a sessão
session_start();

// Verifica se o índice 'usuario_id' NÃO está definido na sessão
if (!isset($_SESSION['usuario_id']))
	// Se não estive, redireciona o usuário para o login.php
	header('location:login.php');

// Verifica se a requisição é do tipo POST  e está setada o índice 'conteudo' no $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conteudo'])) {
	// Inclui o arquivo de conexão com o banco de dados
	include "includes/conexao.php";
	// Associa os dados recebidos ou da sessão a variáveis
	$conteudo 	= $_POST['conteudo'];
	$usuario_id = $_SESSION['usuario_id'];
	// Monta o comando SQL para inserir um comentário no banco
	$query = "INSERT INTO comentario (conteudo, usuario_id) VALUES ('$conteudo', '$usuario_id')";
	// Verifica se o comando foi executado corretamente
	if (mysql_query($query)) {
		// Se sim, o comentário foi cadastrado e o usuário é redirecionado para o index.php
		header("location:index.php");
	} else {
		// Se não, define a variável $erro com o erro ocorrido no MySQL
		$erro = "Erro: " . mysql_error();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema de comentários</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>Sistema de comentários</h1>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Novo comentário</h4>
					</div>
					<div class="panel-body">
						<?php /* Verifica se houve erro no cadastro */ ?>
						<?php if (isset($erro)) : ?>
						<?php /* Se sim, exibe o erro ocorrido */ ?>
						<div class="alert alert-danger"><?php echo $erro; ?></div>
						<?php endif; ?>
						<form action="comentario-create.php" method="POST">
							<div class="form-group">
								<label for="conteudo">Conteúdo</label>
								<textarea class="form-control" id="conteudo" name="conteudo" autofocus required rows="10"></textarea>
							</div>
  							<button type="submit" class="btn btn-lg pull-right btn-success">Salvar</button>
  							<a href="index.php">Voltar para comentários</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>