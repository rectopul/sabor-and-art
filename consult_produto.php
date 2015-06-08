<?php
date_default_timezone_set('America/Sao_Paulo');
//envio o charset para evitar problemas
        header("Content-Type: text/html; charset=ISO-8859-1");
$con = @mysql_connect('localhost', 'root', 'mateus230');//faço a conexão com o banco
        mysql_select_db('saboreart', $con);//seleciono a tabela no banco
        $sql = "SELECT * FROM `products`
                WHERE `id` = '{$_POST['id_product']}' ";//monto a query
        $q = mysql_query( $sql );//executo a query
        if( mysql_num_rows( $q ) > 0 )://se retornar algum resultado
                $collect_date = mysql_fetch_assoc($q);
				  echo json_encode($collect_date);
        else:
                 echo "Produto nao existente!";
		endif;
?>