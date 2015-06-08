<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Teste de filtro usando form</title>
<link rel="stylesheet" type="text/css" href="estilos.css" />
<script type="text/javascript" language="javascript" src="jquery-2.1.3.min.js"></script>
<script type="text/javascript">
              $(document).ready(function(e) {
                    
              $(function(){
              $("#form_filtro").submit(function(){
 
              $.ajax({
              type      : 'post',
 
              url       : 'teste_filtro.php',
 
              data      : 'start='+ $('#campo1').val() +'&end='+ $('#campo2').val(),
 
              dataType  : 'html',
 
              success : function(data){
                    $('#dados').html(data)
              }
        });
         return false;
        });
        });
                })

</script>
</head>

<body>

<form name="consultData" method="post" action="" id="form_filtro">
  <label id="start"><span>DATA: DE</span><input type="date" name="dateStart" id="campo1" /></label>
  <label id="end"><span>DATA: ATE</span><input type="date" name="dateEnd" id="campo2" /></label>
  <input type="submit" class="submit-btn" value="Filtrar" />
</form>
<hr /><br />

<div id="dados"></div>



</body>
</html>