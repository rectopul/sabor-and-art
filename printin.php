<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Impressão de Cupom</title>
</head>
<?php
date_default_timezone_set('America/Sao_Paulo');
if(isset($_GET['success_id'])):
$id_Pedido = $_GET['success_id'];

require('conn.php');
$SelectItens = mysql_query("SELECT * FROM itensvenda WHERE idPedido = '$id_Pedido'");
$SelectTotal = mysql_query("SELECT * FROM pedidos WHERE id = '$id_Pedido'");
if($SelectTotal >= '1'):
 $pegatotal = mysql_fetch_assoc($SelectTotal);
 $total = $pegatotal['valor']/100;
else:
 echo "Não foi possível capturar o Total";
endif;


$data = date('d/m/Y');
$hora = date('H:i:s');
endif;
?>
<table width="350" border="0" align="center" cellspacing="6">
  <tr>
    <td style=" width:350px; font:12px 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;" colspan="4">Sabor & ART <br /> Fone: (14) 3532-5718, (14) 99849-3778<br /><br />
    <?php echo $data." - ".$hora; ?>
    <br /><br />
    <hr /><br />
    </td>
  </tr>
  <tr>
    <td style="font:12px 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;" colspan="4">ID do pedido: <?php echo $id_Pedido; ?><br /><br />
    <hr /><br />
  </td>
  </tr>
  <tr style=" font:12px Verdana, Geneva, sans-serif;">
    
    <td align="left">QTD</td>
    <td align="left">Descrição</td>
    <td align="left">R$ UN</td>
    <td align="left">R$ TOTAL</td>
  </tr>
  <?php
   while($DadosPedido = mysql_fetch_assoc($SelectItens)):
   $idProduct = $DadosPedido['idProduto'];
   $selectDescription = mysql_query("SELECT * FROM products WHERE id = '$idProduct'");
   $DadosProduto = mysql_fetch_assoc($selectDescription);
   $PrecoUnidade = $DadosProduto['valor_venda']/100;
   $PrecoTotal = ($DadosProduto['valor_venda']*$DadosPedido['quantidadeProduto'])/100;
  
  ?>
  <tr style="font:12px 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
    <td><?php echo $DadosPedido['quantidadeProduto']; ?></td>
    <td align="left"><?php echo $DadosProduto['produto']; ?></td>
    <td align="left" valign="top"><?php echo "R$".number_format($PrecoUnidade,2,",",".");?></td>
    <td align="left" valign="top"><?php echo "R$".number_format($PrecoTotal,2,",",".");?></td>
  </tr>
  <?php
  endwhile;
  ?>
  <tr>
   <td colspan="4">
   <br /><br /><br />
   Total: <?php echo "R$".number_format($total,2,",","."); ?>
   <hr /><br />
   </td>
  </tr>
   <tr>
   <td colspan="4" style="font:12px Verdana, Geneva, sans-serif;" colspan="3">Endereço: Av. Pedro de toledo, 1221 Centro. CNPJ:154680/0001-98
   <br /><br /><br /> Deus seja Louvado<br /><br /><hr />
   </td>
  </tr>
</table>
<script type="text/javascript">
<!--
	print();
	location.href="caixa.php";
-->
</script>
<body>
</body>
</html>