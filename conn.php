<?php 
// Informações para conexão
$host = "localhost";
$usuario = "root";
$senha = "mateus230";
$banco = "saboreart";
// Realizando conexão e selecioando banco de dados
$conn = @mysql_connect($host, $usuario, $senha) or die(mysql_error());
$db = mysql_select_db($banco, $conn) or die(mysql_error()); 
// Alterando o charset para utf8, para evitar problemas de acentuação
mysql_set_charset('utf8');

 ?>