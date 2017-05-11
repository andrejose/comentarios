<?php

// Inclui o arquivo de conexão com o banco de dados
include "includes/conexao.php";

// Monta o comando SQL para selecionar os comentários cadastrados no banco
$query = "SELECT c.*, u.nome AS autor FROM comentario c
			INNER JOIN usuario u ON c.usuario_id = u.id
			ORDER BY data DESC ";

// Efetua a consulta no banco
$result = mysql_query($query);

// Inicia a sessão
session_start();

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
			<div class="col-md-8 col-md-offset-2">
				<h1>Sistema de comentários
					<?php /* Verifica se há algum usuário logado. Se houver, exibe os botões */ ?>
					<?php if (isset($_SESSION['usuario_id'])): ?>
					<div class="pull-right">
						<a href="usuario-delete.php?id=<?php echo $_SESSION['usuario_id'] ?>" class="btn btn-sm btn-danger">Deletar minha conta</a> <a href="logout.php" class="btn btn-sm btn-info">Sair</a>
					</div>
					<?php endif ?>
				</h1>

				<?php /* Percorre todos os comentários cadastrados no banco */ ?>
				<?php while($comentario = mysql_fetch_assoc($result)) : ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<?php /* Se o usuário logado é dono do comentário atual, exibe o botão de exclusão */ ?>
						<?php if ($comentario['usuario_id'] == $_SESSION['usuario_id']): ?>
						<a href="comentario-delete.php?id=<?php echo $comentario['id'] ?>" class="btn btn-xs btn-default pull-right">Apagar</a>
						<?php endif ?>
						<h4><?php echo $comentario['autor'] ?> <small>em <?php echo $comentario['data'] ?></small></h4>
					</div>
					<div class="panel-body">
						<?php echo $comentario['conteudo'] ?>
					</div>
				</div>
				<?php endwhile; ?>
				<hr>
				<div class="text-center">
					<a href="comentario-create.php" class="btn btn-success">Adicionar um comentário</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>