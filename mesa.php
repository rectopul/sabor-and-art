<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="estilos.css">
<title>Painel de Mesas</title>
<script type="text/javascript" language="javascript" src="jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="jquery.maskMoney.min.js"></script>
<script type="text/javascript" language="javascript">
  
 

$("#valorMesa").maskMoney({
  symbol:'R$',
  showSymbol:true, 
  thousands:'.', 
  decimal:',', 
  symbolStay: true,
  allowNegative:true
 });
 
</script>
</head>

<body>
<div id="require"><?php require("venda.php"); ?></div>
<div id="topo"></div>
<div id="corpo">
Para cadastrar uma mesa clique <a href="insertMesa.php?acao=insert">aqui</a>
<div id="conteudoMesa">

<?php
require("conn.php");
//Select no banco
$selectMesas = @mysql_query("SELECT id, pedido, valor, status FROM mesa");


//While do select com array
while($listaMesas = mysql_fetch_array($selectMesas)):
//Quando o status estiver ocupado exibir na cor branca e livre na cor verde


//Condição para quando o status for livre mostrar Verde
if($listaMesas['status'] == 'livre'):
?>
<!-- Teste de comentário HTML -->
<ul id="Mesas">

<li id="livre">
<?php
if($totalReal >= '1'):

?>
<a href="venda.php?mesa=<?php echo $listaMesas['id']; ?>">Mesa <?php echo $listaMesas['id']; ?></a>
<?php
else:
?>
Mesa <?php echo $listaMesas['id']; ?>
<?php
endif;
?>
</ul>

<?php
else:
$valorFormat = $listaMesas['valor'];
?>
<ul id="Mesas">

<li> <a href="venda.php?mesa=<?php echo $listaMesas['id']; ?>"> Mesa <?php echo $listaMesas['id']; ?> </a> <br />
Pedido: <?php echo $listaMesas['pedido']; ?> <br />
Valor: <font id="valorMesa"> <?php echo "R$ ".number_format($valorFormat,2,",",".") ?> </font>

<ul id="btn_add_mesa">
<a href="insertItem.php"><li></li></a>
<a href="pgto.php?pedido=<?php echo $listaMesas['pedido']; ?>"><li class="chekin"></li></a>
<a href="cancel.php?cancelar=<?php echo $listaMesas['pedido'];?>"><li class="delete"></li></a>
</ul>

</li></ul>
<?php
endif;
endwhile;
?>

</div>

<div id="stopbtn" style="width:120px;height:50px;background:#666;"></div>
</div>


</body>
</html>