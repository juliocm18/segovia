<?php require_once('Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
	<form action="consulta.php" method="post">
	probar con "123123"
		<input type="text" name="placa" placeholder="Ingrese el numero de placa" />
		<input type="submit" value="buscar" />
	</form>
	<br>
<a href="registrapedido.php">Volver al registro de los Servicios</a>
<hr />
	<?php 
	if (isset($_POST['placa']) ? $_POST['placa'] : null)
	{
		$placa = (isset($_POST['placa']) ? $_POST['placa'] : null);

		$sql="SELECT p.idpedido, s.idpedido, p.tipoComprobante, p.fecha, s.nombre, s.desacripcion, s.nombre, s.fechaprox_aceite, s.fechaprox_kil FROM servicio s  INNER JOIN pedido p  ON p.idpedido=s.idpedido WHERE s.placa='$placa' limit 30";

		$result=mysql_query($sql);
		  
		  if($result)
		  {
		  	echo "<table border='1'>";
			echo "<tr>";
			echo "<th>Descripción</th>";
			echo "<th>Comprobante</th>";
			echo "<th>Fecha de Pedido</th>";
			echo "<th>Próx. cambio por Aceite</th>";
			echo "<th>Próx. cambio por Kilometraje</th>";
			echo "</tr>";
			
		    while($row=mysql_fetch_array($result))
		    {
		      echo "<tr>";
			  echo "<td>".$row["nombre"]." - ".$row["desacripcion"]."</td>";
			  echo "<td>".$row["tipoComprobante"]."</td>";
			  echo "<td>".$row["fecha"]."</td>";
			  echo "<td>".$row["fechaprox_aceite"]."</td>";
			  echo "<td>".$row["fechaprox_kil"]."</td>";
			  
			echo "</tr>";
			
		    }
		    echo "</table>";
		  }
	}
?>
</body>
</html>