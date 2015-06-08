<html>
<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
if(!isset($_SESSION['login']) & !isset($_SESSION['senha'])){
	header('location: login.php');
}else{
}

if(isset($_GET['sair']) && $_GET['sair'] == 'ok'):
 session_destroy;
 header('location: login.php');
endif;
?>
<head>
<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<script type="text/javascript" language="javascript" src="jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="jquery.price_format.2.0.min.js"></script>
<script type="text/javascript" language="javascript">
function setFocus() {
document.getElementById("idProduto").focus();
}


        $(function(){ // declaro o início do jquery
		        $("input[name='id_product']").blur( function(){//botão para disparar a ação
                        var id_product = $("input[name='id_product']").val();
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
		
		

 $("input[name='qtdProduto']").blur(function(){
 //declaração das variáveis
 var nota1 = 0,nota2 = 0,media = 0;
 //pegando as notas dos campos inputs
 nota1 = parseFloat($("input[id=qtdProduto]").val());
 nota2 = parseFloat($("input[id=valor]").val());
 //formula para cálculo de média
 media = parseFloat(nota2) * parseFloat(nota1);
 //mostra o resultado no input name=media
 $("#total").val(media*100);
 $('#total').priceFormat({
		prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.'
 });
 });


});

var tempo = window.setInterval(carrega, 1000);
function carrega()
{
$('#conteudo').load("venda.php");
}

document.onkeydown=function(e){
	if(e.which == 114) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="venda.php?cancel=excluir";
	}
	
	if(e.which == 115) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="pedido.php";
	}
	
	if(e.which == 113) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="pgto.php";
	}
	
	if(e.which == 119) { 
		//Aqui vai o código e chamadas de funções para o ctrl+s
		window.location="mesa.php";
	}
}

</script>
<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body onLoad="setFocus()">
<div id="topo"></div>
<div id="corpo">

<div id="campos">
<form id="formulario" name="caixaform" action="" method="post">

  <label><input type="text" id="produto"></label>
 <label id="codigo"> Código: <input type="text" id="idProduto" name="id_product" class="inputUnico"></label><br />
 <label id="obervation"><textarea id="descipt" name="descipt" rows="7" cols="50"></textarea>
 <label id="qtd"> Quantidade: <input type="text" id="qtdProduto" name="qtdProduto" value="1" class="inputUnico"></label><br />
 <label id="vlr">Valor: <input type="text" id="valor" name"vlrpdt" readonly ></label><br />
 <label id="vlr">Total: <input type="text" id="total" readonly ></label><br />
 
 <input id="enviaPost" type="submit" name="Enviar" value="Inserir Produto">
</form>

<div id="botoes_atalhos">
<ul id="comandos">
<a href="pedido.php"><li><span>(F4)<br /><br />Comanda</span></li></a>
<a href="venda.php?cancel=excluir"><li><span>(F3)<br /><br />Cancelar Venda</span></li></a>
<a href="pgto.php"><li><span>(F2)<br /><br />Concluir</span></li></a>
<a href="#"><li><span>(F1)<br /><br />Excluir item</span></li></a>
<a ref="mesa.php" accesskey="H"><li><span>(F8)<br /><br />Mesas</span></li></a>
<a href="#"><li><span>(F7)<br /><br />Orçamento</span></li></a>
<a href="#"><li><span>(F6)<br /><br />Pagamento</span></li></a>
<a href="#"><li><span>(F5)<br /><br />Produtos</span></li></a>

</ul>
<div id="clear"></div>
</div>
<div id="previewComanda">

</div>
</div>

<div id="preview">
<div id="conteudo">

</div>
</div>
<div id="clear"></div>
</div>
</body>
</html>