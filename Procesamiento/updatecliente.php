<?php require_once('../Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");
session_start();
 if ( empty($_SESSION["nomb"])) 
 {
 	header("location:../index.php");
 }

$idcliente=$_POST['idcliente']; 
$nombres=$_POST['nombres']; 
$doc=$_POST['documento']; 
//echo $idcliente.$nombres.$doc;
$sql="UPDATE cliente SET  Nombres='$nombres', DNI_RUC='$doc' WHERE idcliente=$idcliente";
$result=mysql_query($sql);
header("location:../registrapedido.php");
?>