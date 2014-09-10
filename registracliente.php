<?php require_once('Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="js/jquery-1.10.1.min.js"></script>
</head>

<body>
<h2>Registro del cliente</h2>
<form action="registracliente.php" method="post" >
	 Nombres: <input type="text" name="nombres"  value="" />
	 Documento (Dni o Ruc)<input type="text" name="doc"  value="" />	
	<input type="submit" value="ingresar" />

</form>
<?php require_once('Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");?>
<?php 
if (isset($_POST['nombres']) ? $_POST['nombres'] : null)
{
	$nombres=$_POST['nombres']; 
	$doc=$_POST['doc']; 
	$sql="insert into cliente (nombres,DNI_RUC) values ('$nombres','$doc')";

	$result=mysql_query($sql);

	if($result){
	echo "El cliente fue registrado con éxito";
	}else
	{
		echo "No se registro el cliente, revise que los campos no esten duplicados <br>";
	} 
}

?>
<a href="registrapedido.php">Volver al registro de los Servicios</a>
</body>
</html>