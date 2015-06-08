<?php
require('../conn.php');
if(isset($_POST['phone']) && isset($_POST['cpf'])):
 $phone = str_replace(array('(', ')', '-', ' '), "", $_POST['phone']);
 $cpf = str_replace(array('(', ')', '-', ' ', '.'), "", $_POST['cpf']);
 
 if(empty($cpf) && empty($phone)):
   echo "Digite um CPF ou um TELEFONE para Consulta!";
 else:
 
   $query = mysql_query("SELECT * FROM clientes WHERE (telefone='$phone' OR cpf='$cpf') ")or die(mysql_error());
   $dadosQuery = mysql_fetch_assoc($query);
   if($dadosQuery['id'] == false):
     
     echo "Cliente não cadastrado! para cadastra-lo <a href=\"cad_client.php?telefone=".$phone."?cpf=".$cpf."\"> clique aqui </a> "; 
	 
   else:
     session_start();
	 $_SESSION['client'] = $dadosQuery['id'];
        
     echo "Nome: ".$dadosQuery['nome']."<br />";
     echo "Endereço: ".$dadosQuery['endereco']."<br />";
     echo "Bairro: ".$dadosQuery['bairro']."<br />";
	 echo "Cidade: ".$dadosQuery['cidade']."<br />";
	 $pattern = '/(\d{2})(\d{5})(\d*)/';
     $telefoneN = preg_replace($pattern, '($1) $2-$3', $dadosQuery['telefone']);
     echo "Telefone: ".$telefoneN."<br />";
	 
   endif;
   
 endif;
 
endif;



?>