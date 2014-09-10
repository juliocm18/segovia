<?php require_once('Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");
session_start();
 if ( empty($_SESSION["nomb"])) 
 {
 	header("location:index.php");
 }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script>
$(document).ready(function(){
 $("#nombres").autocomplete("Procesamiento/autocompletar.php", {
		selectFirst: true
	});
});

$(document).ready(function(){
	   $("#registropedido").submit(function(){	   
			   if ($("#idcli").val()==undefined)
			   {
			   	alert("Debe buscar un cliente");
			   	return false;
			   }
			   else
			   {
			   	if ($(".placa").val()==undefined)
			   	{
				   	alert("Debe agragar al meno un servicio");
				   	return false;
			    }
			   }
	   
	  	});


 });


  
  
$(document).ready(function(){
	  $("a.quit").click(function(e){
    e.preventDefault();
    console.log("as");
    $(this).parents("div.serv").remove();
  
  });
	
 });
function quita()
{
	var parent=document.getElementById("sv");
var child=document.getElementById("serv");
parent.removeChild(child);
}
function addService()
{
	event.preventDefault();
	var seleccion=$("#tiposervicio").val();
	if (seleccion=="aceite") {
		$( ".services" ).append( "<div id='serv'><hr><h3>Cambio de Aceite</h3><input type='hidden' name='service[]' value='Cambio de aceite' />Fecha proximapor aceite: 	<input type='date'  name='fechaaceite[]' required><br />			Proxima fecha por Kilometraje<input type='date'  name='fechakil[]' required><br />Descripcion: <br><textarea name='descripcion[]'  cols='30' rows='10' required>			</textarea><br />Placa: <input type='text' name='placa[]' required class='placa'/><br /><a href='#' onclick='quita(this)'  class='quit'>quitar</a></div>" );
	}
	else if (seleccion=="lavado")
	{
		$( ".services" ).append( "<div id='serv'><hr><h3>Lavado y Engrase</h3><input type='hidden' name='service[]'  value='Lavado y engrase'/>Descripcion: <br><textarea name='descripcion[]'  cols='30' rows='10' required></textarea><br />Placa: <input type='text' name='placa[]' required class='placa'/><br /><a href='#' onclick='quita(this)' class='quit'>quitar</a></div>" );	
	}
	else if (seleccion=="embreado")
	{
		$( ".services" ).append( "<div id='serv'><hr><h3>Embreado a Presion</h3><input type='hidden' name='service[]'  value='Embreado a Presion' />Descripcion: <br><textarea name='descripcion[]'  cols='30' rows='10' required></textarea><br />Placa: <input type='text' name='placa[]' required class='placa'/><br /><a href='#' onclick='quita(this)' class='quit'>quitar</a></div>" );
	}
	else{
		alert("a oucurrido un error al elegir el servicio");
	}
	
}
</script>
<style>
	.contenido
	{
		width: 90%;
		margin-left: auto;
		margin-right: auto;
		background-color: #5FDBE9;

	}
</style>
</head>

<body>
<div class="contenido">
	hola bienvenido <strong><?php echo $_SESSION['nomb']?></strong>
<br />

<form  action="registrapedido.php" method="post">
	<label>Cliente:</label>
	<input name="nombres" autocomplete="off" type="text" id="nombres" size="20" required/>
	<input type="submit" value="Buscar" />
</form>


<form id="registropedido" action="registrapedido.php" method="post">
<?php 
	if (isset($_POST['nombres']) ? $_POST['nombres'] : null)
	{
		$nombres = (isset($_POST['nombres']) ? $_POST['nombres'] : null);

		$sql="SELECT idCliente, DNI_RUC,nombres FROM cliente WHERE nombres='$nombres'";
		$result=mysql_query($sql);
		$count=mysql_num_rows($result);
		if ($row = mysql_fetch_array($result)){ 
			
			echo "<input type='hidden' id='idcli' name='idlcliente' required value='".$row["idCliente"]."'><br>";
			echo "Documento: ".$row["DNI_RUC"]."<br>";
			echo $row["nombres"]."<br>";
			echo "<a href='actualizacliente.php?id=".$row['idCliente']."'>Actualizar datos</a><br>";
			}
		if($count==1){		 
		}
		else {
		echo "No existen datos";
		echo "<a href='registracliente.php'>Registrar Cliente<a><br>";
		}
	}
?>
	Comprobante<select name="comprobante" id="comprobante">
		<option value="Boleta">Boleta</option>
		<option value="Factura">Factura</option>		
	</select><br />
	Numero de Comprobante:<input type="number" name="ncomprobante" required placeholder="formato xxxxx" />	<br />
	Fecha de Pedido:<input type="date" name="fechapedido" required>	<br />

	Tipo de Servicio: 
	<select name="tiposervicio" id="tiposervicio">
		<option value="aceite">CAMBIO DE ACEITE</option>
		<option value="lavado">LAVADO Y ENGRASE</option>
		<option value="embreado">EMBREADO A PRESIÓN</option>
	</select><br /> <a href="#" onclick="addService();">agregar</a>
	

	<div class="services" id="sv">

	</div>


	
	<input type="submit" value="Registrar Pedido" id="enviapedido" />
</form>
<a href="consulta.php" >Consultar Historial</a>
<form action="Procesamiento/logout.php">
	<input type="submit" value="cerrar Sesión"/>
</form>

<?php 
if (isset($_POST['idlcliente']) ? $_POST['idlcliente'] : null)
	{		
			if (isset($_POST['descripcion']) ? $_POST['descripcion'] : null)
			{
				$idlcliente=$_POST['idlcliente']; 
				echo $idlcliente."<br/>";
				$comprobante=$_POST['comprobante']; 
				echo $comprobante."<br/>";
				$ncomprobante=$_POST['ncomprobante']; 
				echo $ncomprobante."<br/>";
				$fechapedido=$_POST['fechapedido']; 
				echo $fechapedido."<br/>";
				
				$ncomprobante=$_POST['ncomprobante']; 
				echo $ncomprobante."<br/>";
				$fechaaceite =$_POST['fechaaceite']; 
				$fechakil =$_POST['fechakil']; 
				$placa =$_POST['placa']; 
				$service =$_POST['service'];
				
				$sql="insert into pedido (tipoComprobante, fecha, idCliente) values ('$comprobante','$fechapedido',$idlcliente)";
				$result=mysql_query($sql);

				$sqlid="select idPedido from pedido order by idPedido desc limit 1";
				$resultid=mysql_query($sqlid);

				if ($row2 = mysql_fetch_array($resultid)){ 
				$idp= $row2["idPedido"];
				
				}

				$i =0;
				foreach($_POST['descripcion'] as $des)
				{
					if ( ! isset($fechaaceite[$i])) {
					   $fechaaceite[i] = null;
					}
					if ( ! isset($fechakil[$i])) {
					   $fechakil[i] = null;
					}
				$sql2="insert into servicio (nombre, fechaprox_aceite,fechaprox_kil,desacripcion,placa,idPedido) values ('$service[$i]','$fechaaceite[$i]','$fechakil[$i]','$des','$placa[$i]',$idp)";
					$result3=mysql_query($sql2);				
				$i++;
				}
			}
			else
			{
				echo "Debe tener al menos un servicio";
				
			}
		
		
		
	}

	


?>
</div>


</body>
</html>