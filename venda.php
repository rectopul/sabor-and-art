<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
date_default_timezone_set('America/Sao_Paulo');

echo '<table width="450" cellspacing="3" align="center">';
echo '<tr align="center">';
echo '<td width="40">'."ID".'</td>';
echo '<td width="40">'."QTD".'</td>';
echo '<td>'."Descrição".'</td>';
echo '<td>'."Valor".'</td>';
echo '</tr>';
require("conn.php");
if(isset($_POST['id_product']) && isset($_POST['qtdProduto'])):
$id_Produto = $_POST['id_product'];
$qtd_produto = $_POST['qtdProduto'];
$obs_produto = $_POST['descipt'];
endif;

if(isset($_SESSION['venda'])):

$_SESSION['observation'] = array();

else:

$_SESSION['venda'] = array();
 


endif;

echo '<br />';
if(isset($_POST['id_product'])):


  
  $_SESSION['observation'] [$qtd_produto] = $obs_produto;
  $_SESSION['venda'] [$id_Produto] = $_SESSION['observation'];
 
endif;


if(isset($_GET['cancel']) && $_GET['cancel'] == 'excluir'):
  unset($_SESSION['venda']);
  header('location: caixa.php');
endif;
$soma = 0;
$total = 0;
$totalReal =0;

foreach($_SESSION['venda'] as $idProd => $array):
foreach($array as $Quantidade => $ObserVer):
    $sqlCarrinho = mysql_query("SELECT * FROM products WHERE id = '$idProd'");
	
    $RessAssoc = mysql_fetch_assoc($sqlCarrinho);
	
	$prodIFfinal = $RessAssoc['id'];
		
    $soma = $RessAssoc['valor_venda'] * $Quantidade;
	$total += $RessAssoc['valor_venda'] * $Quantidade;
	$somaReal = $soma/100;
	$totalReal = $total/100;
	echo '<tr align="center">';
	echo '<td>'.$idProd.'</td>';
	echo '<td>'.$Quantidade.'</td>';
	echo '<td>'.$RessAssoc['produto'].'</td>';
	echo '<td>'."R$".number_format($somaReal,2,",",".").'</td>';
	echo'</tr>';
	
endforeach;	
endforeach; 

echo '<tr align="center">';
	echo '<td>'.'</td>';
	echo '<td>'.'</td>';
	echo '<td>'.'</td>';
	echo '<td width="200" class="total">'."Total: "."R$".number_format($totalReal,2,",",".").'</td>';
	echo'</tr>'; 
echo '</table>';


if(isset($_GET['mesa']) >= '1'): 
$dataPedido = date('Y-m-d H:i:s');
$statusPedido = "aberto";
$idMesa = $_GET['mesa'];
$cliente = $_SESSION['client'];
$insertPedido = mysql_query("INSERT INTO pedidos (valor, data, idClient, status) VALUES ('$total', '$dataPedido', '$cliente', '$statusPedido')");

  $selectID = mysql_insert_id();  
  foreach($_SESSION['venda'] as $idPDT => $arrayFull):
  foreach($arrayFull as $QTD => $OBS):
	 $insertItens = mysql_query("INSERT INTO itensvenda (idPedido, idProduto, quantidadeProduto, mesa, obs)
  VALUES
  ('$selectID', '$idPDT', '$QTD', '$idMesa', '$OBS')");
endforeach;   
endforeach;
$insertPDDMesa = mysql_query("UPDATE mesa SET pedido='$selectID', valor='$totalReal', status='ocupada' WHERE id='$idMesa'");
unset($_SESSION['venda']); 
unset($_SESSION['client']); 
header('location: caixa.php');
else:

endif;
?>