<?php require_once('../Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");?>
<?php // username and password sent from form 
$idlcliente=$_POST['idlcliente']; 
echo $idlcliente."<br/>";
$comprobante=$_POST['comprobante']; 
echo $comprobante."<br/>";
$ncomprobante=$_POST['ncomprobante']; 
echo $ncomprobante."<br/>";
$fechapedido=$_POST['fechapedido']; 
echo $fechapedido."<br/>";
$tiposervicio=$_POST['tiposervicio']; 
echo $tiposervicio."<br/>";
$ncomprobante=$_POST['ncomprobante']; 
echo $ncomprobante."<br/>";
$fechaaceite =$_POST['fechaaceite']; 


if ($_POST['descripcion'])
{
	$i =0;
	foreach($_POST['descripcion'] as $des)
	{
	echo "$des <br/>\n";
	print $fechaaceite[$i]."<br/>";
	print $fechakil[$i]."<br/>";
	$i++;
	}
}
else
{
	header("location:../registrapedido.php");
}


?>