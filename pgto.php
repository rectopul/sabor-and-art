<html>
<head>
<script type="text/javascript" language="javascript" src="jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="jquery.price_format.2.0.min.js"></script>
<script type="text/javascript" src="jquery.maskedinput.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
	
	 $('.phone').mask('(99) 99999-9999');
	 $('.cpf').mask('999.999.999-99', {reverse: true});
	 $('#valorPago').priceFormat({
     prefix: '',
     centsSeparator: ',',
     thousandsSeparator: '.'
	 })	
	});
    </script>
<script type="text/javascript">
$(document).ready(function setFocus() {
document.getElementById("number").focus();
})
</script>
<!--PRICE FORMAT NO FORMULÁRIO DE PREÇO -->

<script type="text/javascript">


        $(document).ready(function(){
			
			    $('#nota2').blur(function() {
				var nota1 = 0; var nota2 = 0;
				var soma = parseFloat('#nota2').val.replace(",", ".") + parseFloat('#nota1').val.replace(",", ".");
				
			    alert(soma.toFixed(2));
				});
				
        });
    
    

</script>

<!--SCRIPT DE ENVIO VIA POST SEM ATUALIZAR PAGINA-->
<script type="text/javascript">
function setFocus() {
        document.getElementById("valorPago").focus();
        }
jQuery(document).ready(function(){
	    
		jQuery('#formulario').submit(function(){
			var dados = jQuery( this ).serialize();

			jQuery.ajax({
				type: "POST",
				url: "coletadados.php",
				data: dados,
				success: function( data )
				{
				}
			});
			
			return false;
		});
	});
</script>

<!--SCRIPT DE SOMA DOS CAMPOS-->
<script type="text/javascript">
 $(document).ready(function(e) {
                    
              $(function(){
              $("#valorPago").blur(function(){
 
              $.ajax({
              type      : 'post',
 
              url       : 'calc_consult.php',
 
              data      : 'dinheiro='+ $('#valorPago').val() +'&valor='+ $('#Preco').val(),
 
              dataType  : 'html',
 
              success : function(data){
                    $('#troco').val(data)
              }
        });
         return false;
        });
        });
                })


</script>
<!--SCRIPT DE CONSULTA AO CLIENTE-->
<script type="text/javascript">
 $(document).ready(function(e) {
                    
              $(function(){
              $("#pesquisa").click(function(){
 
              $.ajax({
              type      : 'post',
 
              url       : 'consuts/consult_client.php',
 
              data      : 'cpf='+ $('.cpf').val() +'&phone='+ $('.phone').val(),
 
              dataType  : 'html',
 
              success : function(data){
                    $('#result_contult').html(data);
              }
        });
         return false;
        });
        });
                })


</script>

<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<div id="topo"></div>
<div id="corpo">
<div id="fonte-1">

<?php
date_default_timezone_set('America/Sao_Paulo');

require("conn.php");
require("venda.php");
$dataPedido = date('Y-m-d H:i:s');
$conclusion = "concluido";

if(isset($_GET['pedido']) && $_GET['pedido'] >= 1):
    $pedioMesa = $_GET['pedido'];
	$chekin = $pedioMesa;
    $selectPedidoMesa = mysql_query("SELECT * from mesa  WHERE pedido = $pedioMesa");

    $assoc_Mesa = mysql_fetch_assoc($selectPedidoMesa);
	$idMesaok = $assoc_Mesa['id'];
    $totalReal = $assoc_Mesa['valor'];
    $link = "pedidook";    
?>  
<script type="text/javascript">
document.onkeydown=function(e){
	if(e.which == 121) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="?pedidook="+<?php echo $chekin; ?>;
	}
}
</script>       
<?php
else:
?>
<script type="text/javascript">
document.onkeydown=function(e){
	if(e.which == 121) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="?venda=delivery";
	}
}
</script>  
<?php
$chekin = "delivery";
$link = "venda";
endif;


    if(isset($_GET['pedidook']) >= 1):
	$pedido = $_GET['pedidook'];
    $atualizaMesa = mysql_query("UPDATE mesa SET pedido=' ', valor=' ', status='livre' WHERE pedido = $pedido");
	$atualizaPedido = mysql_query("UPDATE pedidos SET status='$conclusion' WHERE id = $pedido");
	header('location: mesa.php');
	endif;
	
	
	    if(isset($_GET['venda']) == "delivery"):
		$clientPedido = $_SESSION['client'];
        $insertPedido = mysql_query("INSERT INTO pedidos (valor, data, idClient, status) VALUES ('$total', '$dataPedido', '$clientPedido', '$conclusion')");
  
        $selectID = mysql_insert_id();
  
        foreach($_SESSION['venda'] as $prodInsert => $ArrayQtd):
		foreach($ArrayQtd as $qtdProduct => $OBSProduct):
     
	    $insertItens = mysql_query("INSERT INTO itensvenda (idPedido, idProduto, quantidadeProduto)
        VALUES
        ('$selectID', '$prodInsert', '$qtdProduct')");
		
		 
  
        endforeach;
		endforeach;
		unset($_SESSION['venda']);
		unset($_SESSION['client']);
		unset($_SESSION['observation']);
		echo "<script language= \"JavaScript\">"."location.href=\"printin.php?success_id=".$selectID."\"</script>";
	    endif;
	
	


?>


</div>
<table width="600" border="0" align="center" id="check">
  <form id="formulario" action="" method="post">
  <tr>
    <td colspan="3" id="spacing">
    
    <div id="cpf">
    <i id="text_descript">CPF:</i>
    <input type="text" id="number" class="cpf"  name="cpf" autocomplete="off" />
    </div>
     
     <div id="tel">
     <i id="text_descript">TELEFONE:</i>
     <input type="text" class="phone" id="number" name="tel" autocomplete="off" />
     <a href="#" id="pesquisa"></a>
     </div>
     <br />
     <div id="separations"></div>
    </td>
  </tr>
  
  <tr>
  
    <td id="info_pedido">
    <div id="result_contult">
    
    </td>
    </td>
    <td>
    
    <span id="text_descript">TOTAL:</span>
    <input type="text" name="nota1" id="Preco" value="<?php echo number_format($totalReal,2,",","."); ?>" readonly />
    
    </td>
  </tr>
  <tr>
    <td colspan="3">
    <div id="separations"></div>
    
    <div id="trocos1">
    <div id="text_descript">VALOR PAGO:</div>
    <input type="text" name="nota2" id="valorPago" />
    </div>
    
    <div id="trocos">
    <div id="text_descript">TROCO:</div> <input type="text" name="troco" id="troco" readonly />
    </div>
    
    </td>
    </tr>
    <input id="somatudo" type="submit" name="Enviar" value="Inserir Produto">
  </form>
  
  <tr>
   <td colspan="3">
    <br />


 <ul id="BT-Pagamentos">

<li><a href="?<?php echo $link; ?>=<?php echo $chekin; ?>" id="concluir" >(F10) - Fechar Venda</a></li>
<li><a href="mesa.php" id="prev">(F8) - Atribuir á Mesa</a></li>
<li><a href="caixa.php">(F3) - Continuar Comprando</a></li>

</ul>
   
   </td>
  </tr>
</table>





</div>
</body>
</html>