<?php
require('conn.php');
if(isset($_POST['nota1']) && isset($_POST['nota2']) && isset($_POST['troco'])):

 $Nota1 = $_POST['nota1'];
 $Nota2 = $_POST['nota2'];
 $Nota3 = $_POST['troco'];
 
endif;

if(isset($_SESSION['tesao'])):


else:

$_SESSION['tesao'] = array();

endif;

if(isset($_POST['nota1'])):

 $_SESSION['tesao'] [$Nota1] = $Nota2;
 
 echo "Não foi enviado dados para esta página ainda";

endif;
print_r($_SESSION['tesao']);


?>