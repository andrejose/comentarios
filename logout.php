<?php

// Inicia a sessão
session_start();
// Exclui da sessão os índices 'usuario_id' e 'usuario_nome'
unset($_SESSION['usuario_id']);
unset($_SESSION['usuario_nome']);
// Redireciona o usuário para a página inicial
header("location:index.php");

?>