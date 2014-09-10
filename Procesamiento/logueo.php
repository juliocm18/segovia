<?php require_once('../Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");?>
<?php // username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT idCliente, Nombres FROM cliente WHERE usuario='$myusername' and clave='$mypassword'";
$result=mysql_query($sql);

session_start();
if ($row = mysql_fetch_array($result)){ 
	
	 $_SESSION['idcli']=$row["idCliente"];
	
	 $_SESSION['nomb']=$row["Nombres"];
	}

	
// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['views']=1;
header("location:../registrapedido.php");
}
else {
header("location:../index.php");
}
?>