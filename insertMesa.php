<?php
date_default_timezone_set('America/Sao_Paulo');
require("conn.php");
$statusMesa = "livre";
if(isset($_GET['acao'])):

$insertPedido = mysql_query("INSERT INTO mesa (status) VALUES ('$statusMesa')");
header('location:mesa.php');

else:
echo "Problemas ao cadastrar mesa favor contate o desenvolvedor!";
endif;
