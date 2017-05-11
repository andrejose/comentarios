<?php

// Define os tipos de erro que serão exibidos na execução do sistema
// http://php.net/manual/en/function.error-reporting.php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

//Se conecta ao servidor de banco de dados MySQL
$conexao = mysql_connect("localhost", "root", "");

//Define o tipo de acentuação do banco de dados
mysql_set_charset('utf8' , $conexao);

//Seleciona o banco de dados que será utilizado
mysql_select_db("comentarios2");

?>