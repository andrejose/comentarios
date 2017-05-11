<?php

// Verifica se a requisição é do tipo POST  e está setada o índice 'conteudo' no $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {
	// Inclui o arquivo de conexão com o banco de dados
	include "includes/conexao.php";
	// Associa os dados recebidos ou da sessão a variáveis
	$nome 	= $_POST['nome'];
	$email 	= $_POST['email'];
	$senha 	= $_POST['senha'];
	// Monta o comando SQL para inserir um usuário no banco
	$query = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
	// Verifica se o comando foi executado corretamente
	if (mysql_query($query)) {
		// Se sim, resgata a última id inserida no MySQL
		$usuario_id = mysql_insert_id();
		// Inicia a sessão
		session_start();
		// Define na sessão os índices 'usuario_id' e 'usuario_nome'
		$_SESSION['usuario_id'] = $usuario_id;
		$_SESSION['usuario_nome'] = $nome;
		// Redireciona o usuário para a página de cadastro de comentário
		header("location:comentario-create.php");
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
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>Sistema de comentários</h1>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Novo usuário</h4>
					</div>
					<div class="panel-body">
						<?php /* Verifica se houve erro no cadastro */ ?>
						<?php if (isset($erro)) : ?>
						<?php /* Se sim, exibe o erro ocorrido */ ?>
						<div class="alert alert-danger"><?php echo $erro; ?></div>
						<?php endif; ?>
						<form action="usuario-create.php" method="POST">
							<div class="form-group">
								<label for="nome">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" autofocus>
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email" name="email">
							</div>
							<div class="form-group">
								<label for="senha">Senha</label>
								<input type="password" class="form-control" id="senha" name="senha">
							</div>
  							<button type="submit" class="btn btn-lg pull-right btn-success">Entrar</button>
  							<a href="login.php">Login</a> | <a href="index.php">Comentários</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>