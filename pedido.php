<?php
date_default_timezone_set('America/Sao_Paulo');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="estilos.css">
<title>Painel do Pedido</title>
<script type="text/javascript" language="javascript" src="jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="jquery.maskMoney.min.js"></script>
<script type="text/javascript" language="javascript">
$(function(){ // declaro o início do jquery
		        $("input[name='id_product']").blur( function(){//botão para disparar a ação
                        var id_product = $("input[name='id_product']").val();
                        //alert(nomeUsuario);
                        $.ajax({
                        type: 'POST',
                        url: 'consult_produto.php',
                        data: {id_product: id_product},
                        dataType: 'json',
                        success: function(data) {
						   $('#produto').val(data.produto);
						   $('#valor').val(data.valor_venda);
						   $('#valor').priceFormat({
							    prefix: '',
                                centsSeparator: ',',
                                thousandsSeparator: '.'
							   });
                      } 
});
});
});

 
 jQuery('#formulario').submit(function(){
			var dados = jQuery( this ).serialize();
 
			jQuery.ajax({
				type: "POST",
				url: "venda.php",
				data: dados,
				success: function( inserir )
				{
					$("#idProduto").val("");
					$("#qtdProduto").val("1");
					$('#valor').val("");
					$('#descipt').val("");
					document.getElementById("idProduto").focus();
				}
				
			});
			
			return false;
		});
		
		
		document.onkeydown=function(e){
		
	if(e.which == 119) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="mesa.php";
	}
	
	if(e.which == 120) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="caixa.php";
	}
}

 
</script>
</head>

<body>
<div id="require"><?php require("venda.php"); ?></div>
<div id="topo"></div>
<div id="corpo">
<div id="conteudoMesa">
<form id="formulario" name="caixaform" action="" method="post">
 <label><input type="text" id="produto" readonly></label>
  Código: <input type="text" id="idProduto" name="id_product" class="inputUnico">
  Quantidade: <input type="text" id="qtdProduto" name="qtdProduto" value="1" class="inputUnico"><br />
   <input id="enviaPost" type="submit" name="Enviar" value="Inserir Produto">
</form><br /><br />
<div id="clear"></div><br />
  <table width="100%" border="1">
    <tr>
      <td>ID Produto</td>
      <td>Quantidade</td>
      <td>Descrição do Produto</td>
      <td>Valor</td>
      <td>Ação</td>
    </tr>
<?php
 require("conn.php");
 foreach($_SESSION['venda'] as $PrdctID => $Prdctqtd):
 foreach($Prdctqtd as $QTDPDT => $OBSPDT):
  $sqlVendaAtiva = mysql_query("SELECT * FROM products WHERE id = '$PrdctID'");
  $selecaoProdutos = mysql_fetch_assoc($sqlVendaAtiva);
  $valorVenda = $selecaoProdutos['valor_venda']*$QTDPDT;
  $ValorVendaTotal = $valorVenda/100;
  
  
 
?>	
    <tr>
      <td><?php echo $selecaoProdutos['id']; ?></td>
      <td><?php echo $QTDPDT; ?></td>
      <td><?php echo $selecaoProdutos['produto']; ?></td>
      <td><?php echo "R$".number_format($ValorVendaTotal,2,",","."); ?></td>
      <td><a href="?Del=<?php echo $selecaoProdutos['id']; ?>">Excluir Item</a></td>
    </tr>
 <?php 
 endforeach;
 endforeach;
 if(isset($_GET['Del'])):
 $Del = $_GET['Del'];
 unset($_SESSION['venda'][$Del]);
 header('location: pedido.php');
 endif;
 ?>
   <tr>
      <td colspan="5">
        <?php echo "TOTAL: R$".number_format($totalReal,2,",","."); ?>
      </td>
   </tr>
   
    <tr>
      <td colspan="5" style="text-align:center;" align="center">
       
       <ul id="BT-Pagamentos">
         <li><a href="mesa.php">(F8) - Mesas</a></li>
         <li><a href="mesa.php">(F9) - Caixa</a></li>
       </ul>
       
      </td>
   </tr>
  </table>







</div>

</div>


</body>
</html>