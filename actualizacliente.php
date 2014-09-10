<?php require_once('Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");
session_start();
 if ( empty($_SESSION["nomb"])) 
 {
 	header("location:index.php");
 }

?>
<?php 
	
		$id = ($_GET['id']);
		$sql="SELECT idCliente, DNI_RUC,nombres FROM cliente WHERE idCliente='$id'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		if ($row = mysql_fetch_array($result)){ 
			echo "<form action='Procesamiento/updatecliente.php' method='post'>";
			echo "<input type='hidden'  name='idcliente' required value='".$row["idCliente"]."'><br>";
			
			echo "Nombres :<input type='text'  name='nombres' required value='".$row["nombres"]."'><br>";
			echo " Documento (Dni o Ruc)<input type='text'  name='documento' required value='".$row["DNI_RUC"]."'><br>";
			
			echo "<input type='submit' value='Actualizar datos'><br>";
			echo "</form>";
			}
		if($count==1){		 
		}
		else {
		echo "No existe cliente";
		}
	
?>