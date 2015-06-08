<?php
date_default_timezone_set('America/Sao_Paulo');
require("conn.php");
header("Content-Type: text/html; charset=UTF-8");
//Select no banco
$selectMesas = @mysql_query("SELECT id, pedido, valor, status FROM mesa");


//While do select com array
while($listaMesas = mysql_fetch_array($selectMesas)):
//Quando o status estiver ocupado exibir na cor branca e livre na cor verde


//Condição para quando o status for livre mostrar Verde
if($listaMesas['status'] == 'livre'):

echo "<ul id=\"Mesas\">";

echo "<li id=\"livre\"><a href=\"venda.php?mesa=".$listaMesas['id']."\">Mesa ".$listaMesas['id']."</a>";
//Botão de Adicionar produtos ao pedido
echo "<ul id=\"btn_add_mesa\"><a href=\"insertItem.php\"><li></li></a></ul></li>";

echo "</ul>";

else:
$valorFormat = $listaMesas['valor']/100;
echo "<ul id=\"Mesas\">";

echo "<li>Mesa ".$listaMesas['id']."<br />";
echo "Pedido: ".$listaMesas['pedido']."<br />";
echo "Valor: <font id=\"valorMesa\">".$valorFormat."</font>";
//Botão de Adicionar produtos ao pedido
echo "<ul id=\"btn_add_mesa\">";
echo "<a href=\"insertItem.php\"><li></li></a>";
echo "<a href=\"insertItem.php\"><li></li></a>";
echo "<a href=\"insertItem.php\"><li></li></a>";
echo "</ul>";

echo "</li></ul>";

endif;

endwhile;
?>