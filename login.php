<?php

// Verifica se a requisição é do tipo POST  e estãos setados os índices 'email' e 'senha' no $_POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {

	// Inclui o arquivo de conexão com o banco de dados
	include "includes/conexao.php";

	// Associa os dados recebidos ou da sessão a variáveis
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	// Comando para selecionar um usuário com o email e a senha fornecidos
	$query = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";

	// Executa a consulta no banco
	$result = mysql_query($query);

	// Verifica se nenhum registro foi encontrado
	if (mysql_affected_rows() == 0) {
		// Define a mensagem de erro
		$erro = 'Dados incorretos!';
	} else {
		// Se encontrou algum registro, associa o resultado a uma variável $usuario
		$usuario = mysql_fetch_assoc($result);
		// Inicia uma sessão
		session_start();
		// Define na sessão os índices 'usuario_id' e 'usuario_nome'
		$_SESSION['usuario_id'] = $usuario['id'];
		$_SESSION['usuario_nome'] = $usuario['nome'];
		// Redireciona o usuário para a tela de cadastro de comentário
		header('location:comentario-create.php');
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
						<h4>Área de identificação</h4>
					</div>
					<div class="panel-body">
						<?php /* Verifica se houve erro no login */ ?>
						<?php if (isset($erro)) : ?>
						<?php /* Se sim, exibe o erro ocorrido */ ?>
						<div class="alert alert-danger"><?php echo $erro; ?></div>
						<?php endif; ?>
						<form action="login.php" method="POST">
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email" name="email" autofocus required>
							</div>
							<div class="form-group">
								<label for="senha">Senha</label>
								<input type="password" class="form-control" id="senha" name="senha" required>
							</div>
  							<button type="submit" class="btn btn-lg pull-right btn-success">Entrar</button>
  							Não tem um login? <a href="usuario-create.php">CADASTRE-SE</a>.
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>