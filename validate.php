<?php

$veryfy_login = $_POST['login'];
$veryfy_senha = $_POST['senha'];

if(empty($veryfy_login)){
	$print_validate_login = "O Campo Login não pode estar em branco!";
}elseif(empty($veryfy_senha)){
	$print_validate_senha = "O Campo Senha não pode estar em Branco";
}else{

}
