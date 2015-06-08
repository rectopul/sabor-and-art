<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require('conn.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Controle Guaimbê - Login</title>
<link rel="stylesheet" type="text/css" href="styles_login.css"  />
</head>

<body>

<div class="fomulario_login">
<?php



if(isset($_POST['entrar']) && $_POST['entrar'] == 'ok'){
		require('userauthentication.php');
		
		
}else{
}
?>
<br />
<form method="post" action="" name="startsession" enctype="multipart/form-data" class="font1">
<table width="136" border="0" align="center" >
    <tr>
    <td width="130"><span>
    <?php if(isset($print_empty)){echo "<span class=\"validation\">".$print_empty."</span>"."<br />";} ?>
    <label>Login</label><br />
	<?php if(isset($print_validate_login)){echo "<span class=\"validation\">".$print_validate_login."</span>";} ?>
    </span></td>
    </tr>
    <tr>
    <td><input type="text" name="login" /></td>
    </tr>
    <tr>
    <td>
    <span><label>Senha</label><br />
    <?php if(isset($print_validate_senha)){echo "<span class=\"validation\">".$print_validate_senha."</span>";} ?>
    </span>
    </td>
    </tr>
    <tr>
    <td><input type="password" name="senha" /></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td><input type="hidden" name="entrar" value="ok" />
        <span class="btn"><input type="submit" name="start_session" value="Entrar"  /></span></td>
    </tr>
    </table>
  
 </form>
</div>



</body>
</html>