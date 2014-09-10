<?php require_once('../Connections/cn.php');
mysql_select_db($database_cn, $cn);
mysql_query("SET NAMES 'utf8'");?>

<?php
$q=$_GET['q'];
$my_data=mysql_real_escape_string($q);
$sql="SELECT nombres,DNI_RUC FROM cliente WHERE nombres LIKE '%$my_data%' ORDER BY nombres";
  $result = mysql_query($sql);
  
  if($result)
  {
    while($row=mysql_fetch_array($result))
    {
      echo $row['nombres']."\n";
      //echo $row['DNI_RUC']."\n";
    }
  }


?>