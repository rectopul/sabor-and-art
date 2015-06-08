<?php

if(isset($_POST['dinheiro']) && isset($_POST['valor'])):

$dinheiro = str_replace(",", ".", $_POST['dinheiro']);
$valor = str_replace(",", ".", $_POST['valor']);

$soma = $dinheiro - $valor;

echo "R$ ".str_replace(".", ",", $soma);

else:

endif;


?>