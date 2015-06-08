<?php
require('conn.php');

$login = $_POST['login'];
$senha = $_POST['senha'];

$select_test = mysql_query("
SELECT
id,
login,
senha
FROM users
WHERE login = '$login' and senha = '$senha'
")
or die(mysql_error());



$validation = mysql_num_rows($select_test);
    
	if($validation > 0 ){
		$captura_dados = mysql_fetch_array($select_test);
		
		$id_user = $captura_dados[0];
		
		session_start();
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['senha'] = $_POST['senha'];
		
		header("location: caixa.php");
}else{
	 $veryfy_login = $_POST['login'];
     $veryfy_senha = $_POST['senha'];
	 
     if(empty($veryfy_senha) && empty($veryfy_login)){
      $print_empty = "Voce não forneçeu os dados de Login e Senha";
		 }
     elseif(empty($veryfy_login)){
	$print_validate_login = "Ensira seu Login!";
     }elseif(empty($veryfy_senha)){
	$print_validate_senha = "Insira sua Senha!";
     
     }else{
		 
			  echo "Usuário e senha incorretos";
		 
	 }
}