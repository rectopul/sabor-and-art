<?php
require('conn.php');

if(isset($_POST['start']) && isset($_POST['end'])):
$data_start = $_POST['start'];
$data_end = $_POST['end'];


$data = date('Y-m-d');

$formata_data_end = implode("-",array_reverse(explode("/",$data_end)));
$formata_data_start = implode("-",array_reverse(explode("/",$data_start)));


$consult = mysql_query("SELECT * FROM pedidos WHERE data BETWEEN '$formata_data_start' AND '$formata_data_end'");


if($consult >= '1'):

echo 

"<table width=\"600\" border=\"1\" align=\"center\">".
  "<tr>".
   "<td colspan=\"5\" align=\"center\">RESULTADO</td>".
  "</tr>".
  "<tr>".
    "<td>Pedido</td>".
    "<td>Cliente</td>".
    "<td>Valor do pedido</td>".
    "<td>Tipo de pedido</td>".
    "<td>Data do pedido</td>".
  "</tr>";
  
while($RESULTADOS = mysql_fetch_assoc($consult)): 
$RESULTclient = $RESULTADOS['idClient'];
$consult_client = mysql_query("SELECT * FROM clientes WHERE id='$RESULTclient'");
$DADOCLIENT = mysql_fetch_assoc($consult_client);
  echo
  
  "<tr>".
    "<td><span>".$RESULTADOS['id']."</span></td>".
    "<td><span>".$DADOCLIENT['nome']."</span></td>".
    "<td><span>"."R$ ".number_format($RESULTADOS['valor']/100,2,",",".")."</span></td>".
    "<td><span>".$RESULTADOS['status']."</span></td>".
    "<td><span>".date('d/m/Y', strtotime($RESULTADOS['data']))."</span></td>".
  "</tr>";
  
endwhile;
echo "</table>";
else:

echo "Não foi encontrados dados nenhum!";
endif;
endif;

?>