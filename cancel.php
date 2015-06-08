<?php
require("conn.php");

if(isset($_GET['cancelar'])):
$idPedido = $_GET['cancelar'];

$cancelPedido = mysql_query("UPDATE pedidos SET status='cancelado' WHERE id = $idPedido");
$atualizaMesa = mysql_query("UPDATE mesa SET pedido=' ', valor=' ', status='livre' WHERE pedido = $idPedido");
header('location: mesa.php');
endif;


?>
