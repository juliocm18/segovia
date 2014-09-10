<?php require_once('Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");
session_start(); 
 session_destroy();?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>

</head>

<body>

<form action="Procesamiento/logueo.php" method="post" >
	 <input type="text" name="myusername"  value="admin" />
	 <input type="password" name="mypassword"  value="adminpass" />	
	<input type="submit" value="ingresar" />

</form>
<a href="consulta.php" >Consultar Historial</a>
</body>
</html>