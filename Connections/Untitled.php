<?php require_once('Connections/cn.php'); ?>


<link rel="stylesheet" href="contenido/jquery.bxslider/jquery.bxslider.css" type="text/css" />
<script src="contenido/js/jquery.min.js"></script>
<script src="contenido/jquery.bxslider/jquery.bxslider.js"></script>
<script>
$(document).ready(function(){
  $('.slidervertical').bxSlider({
     mode: 'vertical',
    slideWidth: 120,
    minSlides: 2,
    speed:400,
    maxSlides: 3,
    moveSlides: 1,
    pager:false,
    auto: true,
   
    slideMargin: 10
  
  });
  $('.bxslider').bxSlider({
    slideWidth:691,
  mode: 'fade',
  pager:false,
    auto: true,
    slideMargin: 0,
  captions: true
});
});
</script>











<?php

$result = mysql_query( $query_rs_producto, $cn ) or die("Couldn t execute query.".mysql_error());

$columna=1; // Contador que indicará si debo o no cambiar de fila 
$i=0;
While ($registro=mysql_fetch_array($result)) 
 { 
   if ($columna==1) // Si es la primer columna abro una fila 
   { ?>
   
       
     <?php $columna++;  // 2Incremento el contador .gal_descripcion
   } ?>
      <div class="slide">
       <div class="cuerp_noticias_1_interiores">
            <div class="cuerp_noticias_title"><?php echo utf8_encode($registro["dpa_titulo"]);?></div>
            <div class="cuerp_noticias_img"><img src="syspagina/fotos_galeria/<?php echo $registro['gal_descripcion']?> " width="125px" height="87px"/></div>
            <div class="cuerp_noticias_text1"><?php echo utf8_encode($registro["dpa_descripcion"]);?></div>
            <div class="bt_vermas2"><a href="noticia.php?dp=<?php echo $registro['dpa_id'];?>">ver más >></a></div>
        </div>
    <?php
    if($i<$columna)
    {?>
        
    <?php }
    
   if ($columna==$i) // Si es diferente a 1 es porque ya despleguó la 2da columna 
   { ?>
     <div class="clear"></div>
    </div>
    <?php
      // Cierro la fila porque ya se crearon las dos columnas 
      $columna=1;
         // Vuelvo al valor original el contador 
   } 
   $i++; 
 }
 ?>









<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_cn, $cn);
$query_rs_tipo_equipo = "SELECT * FROM categoria2 ORDER BY cat_descripcion ASC";
$rs_tipo_equipo = mysql_query($query_rs_tipo_equipo, $cn) or die(mysql_error());
$row_rs_tipo_equipo = mysql_fetch_assoc($rs_tipo_equipo);
$totalRows_rs_tipo_equipo = mysql_num_rows($rs_tipo_equipo);

$maxRows_rs_equipos = 5;
$pageNum_rs_equipos = 0;
if (isset($_GET['pageNum_rs_equipos'])) {
  $pageNum_rs_equipos = $_GET['pageNum_rs_equipos'];
}
$startRow_rs_equipos = $pageNum_rs_equipos * $maxRows_rs_equipos;

$colname_rs_equipos = "-1";
if (isset($_POST['tipo_equipo'])) {
  $colname_rs_equipos = $_POST['tipo_equipo'];
}
mysql_select_db($database_cn, $cn);
$query_rs_equipos = sprintf("SELECT * FROM galeria_nv2 WHERE cat_id = %s ORDER BY gal_id DESC", GetSQLValueString($colname_rs_equipos, "int"));
$query_limit_rs_equipos = sprintf("%s LIMIT %d, %d", $query_rs_equipos, $startRow_rs_equipos, $maxRows_rs_equipos);
$rs_equipos = mysql_query($query_limit_rs_equipos, $cn) or die(mysql_error());
$row_rs_equipos = mysql_fetch_assoc($rs_equipos);

if (isset($_GET['totalRows_rs_equipos'])) {
  $totalRows_rs_equipos = $_GET['totalRows_rs_equipos'];
} else {
  $all_rs_equipos = mysql_query($query_rs_equipos);
  $totalRows_rs_equipos = mysql_num_rows($all_rs_equipos);
}
$totalPages_rs_equipos = ceil($totalRows_rs_equipos/$maxRows_rs_equipos)-1;

$maxRows_rs_equipo_ultimos = 8;
$pageNum_rs_equipo_ultimos = 0;
if (isset($_GET['pageNum_rs_equipo_ultimos'])) {
  $pageNum_rs_equipo_ultimos = $_GET['pageNum_rs_equipo_ultimos'];
}
$startRow_rs_equipo_ultimos = $pageNum_rs_equipo_ultimos * $maxRows_rs_equipo_ultimos;

mysql_select_db($database_cn, $cn);
$query_rs_equipo_ultimos = "SELECT * FROM galeria_nv2 ORDER BY gal_id DESC";
$query_limit_rs_equipo_ultimos = sprintf("%s LIMIT %d, %d", $query_rs_equipo_ultimos, $startRow_rs_equipo_ultimos, $maxRows_rs_equipo_ultimos);
$rs_equipo_ultimos = mysql_query($query_limit_rs_equipo_ultimos, $cn) or die(mysql_error());
$row_rs_equipo_ultimos = mysql_fetch_assoc($rs_equipo_ultimos);

if (isset($_GET['totalRows_rs_equipo_ultimos'])) {
  $totalRows_rs_equipo_ultimos = $_GET['totalRows_rs_equipo_ultimos'];
} else {
  $all_rs_equipo_ultimos = mysql_query($query_rs_equipo_ultimos);
  $totalRows_rs_equipo_ultimos = mysql_num_rows($all_rs_equipo_ultimos);
}
$totalPages_rs_equipo_ultimos = ceil($totalRows_rs_equipo_ultimos/$maxRows_rs_equipo_ultimos)-1;

$queryString_rs_equipos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_equipos") == false && 
        stristr($param, "totalRows_rs_equipos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_equipos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_equipos = sprintf("&totalRows_rs_equipos=%d%s", $totalRows_rs_equipos, $queryString_rs_equipos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TITLE>RENTADORES DEL NORTE SAC, Cisternas de reparto de combustibles, Cisternas para agua, Alquiler de camiones lubricadores, Alquiler de cisternas para agua,   Alquiler de cisternas para combustible,  Alquiler de torres iluminaria, Alquiler de minibuses, Alquiler de maquinaria pesada, Fabricación de carrocerías metálicas, Venta de camiones usados, Rentadores del norte sac, Transporte  y servicio logístico en general, TRUJILLO, PERU</TITLE>
<META NAME="author" CONTENT="RENTADORES DEL NORTE SAC">
<META NAME="subject" CONTENT="Alquiler de camiones lubricadores, Alquiler de cisternas para agua,   Alquiler de cisternas para combustible,  Alquiler de torres iluminaria, Alquiler de minibuses, Alquiler de maquinaria pesada, Fabricación de carrocerías metálicas, Venta de camiones usados, Rentadores del norte sac, Transporte  y servicio logístico en general">
<META NAME="Description" CONTENT="Alquiler de camiones lubricadores, Alquiler de cisternas para agua,   Alquiler de cisternas para combustible,  Alquiler de torres iluminaria, Alquiler de minibuses, Alquiler de maquinaria pesada, Fabricación de carrocerías metálicas, Venta de camiones usados, Rentadores del norte sac, Transporte  y servicio logístico en general">
<META NAME="Classification" CONTENT=", Alquiler de camiones lubricadores, Alquiler de cisternas para agua,   Alquiler de cisternas para combustible,  Alquiler de torres iluminaria, Alquiler de minibuses, Alquiler de maquinaria pesada, Fabricación de carrocerías metálicas, Venta de camiones usados, Rentadores del norte sac, Transporte  y servicio logístico en general">
<META NAME="Keywords" CONTENT="Alquiler de camiones lubricadores, Alquiler de cisternas para agua,   Alquiler de cisternas para combustible,  Alquiler de torres iluminaria, Alquiler de minibuses, Alquiler de maquinaria pesada, Fabricación de carrocerías metálicas, Venta de camiones usados, Rentadores del norte sac, Transporte  y servicio logístico en general">
<META NAME="Geography" CONTENT="Perú">
<META NAME="Language" CONTENT="Spanish">
<META HTTP-EQUIV="Expires" CONTENT="never">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="PUBLIC">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<META NAME="Copyright" CONTENT="Rentadores del Norte SAC">
<META NAME="Designer" CONTENT="CReativa Pixel">
<META NAME="Publisher" CONTENT="Creativa Pixel">
<META NAME="Revisit-After" CONTENT="21 days">
<META NAME="distribution" CONTENT="Global">
<META NAME="Robots" CONTENT="INDEX,FOLLOW">
<META NAME="city" CONTENT="Trujillo">
<META NAME="country" CONTENT="Perú">

<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>

<link rel="stylesheet" href="lightbox/css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="lightbox/js/prototype.js"></script>
<script type="text/javascript" src="lightbox/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="lightbox/js/lightbox.js"></script>

</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="cuerpo">
  <tr>
    <td colspan="2"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="800" height="90">
      <param name="movie" value="swf/logo_banner_menu.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.65.0" />
      <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="swf/logo_banner_menu.swf" width="800" height="90">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="6.0.65.0" />
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
        <!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
        <div>
          <h4>El contenido de esta página requiere una versión más reciente de Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" width="112" height="33" /></a></p>
        </div>
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object></td>
  </tr>
  <tr>
    <td colspan="2"><object id="FlashID2" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="800" height="236">
      <param name="movie" value="swf/banner.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="6.0.65.0" />
      <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="swf/banner.swf" width="800" height="236">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="6.0.65.0" />
        <param name="expressinstall" value="Scripts/expressInstall.swf" />
        <!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
        <div>
          <h4>El contenido de esta página requiere una versión más reciente de Adobe Flash Player.</h4>
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" width="112" height="33" /></a></p>
        </div>
        <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object></td>
  </tr>
  <tr>
    <td width="165">&nbsp;</td>
    <td width="635">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="2" valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><object id="FlashID3" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="165" height="250">
          <param name="movie" value="swf/menu.swf" />
          <param name="quality" value="high" />
          <param name="wmode" value="transparent" />
          <param name="swfversion" value="6.0.65.0" />
          <!-- Esta etiqueta param indica a los usuarios de Flash Player 6.0 r65 o posterior que descarguen la versión más reciente de Flash Player. Elimínela si no desea que los usuarios vean el mensaje. -->
          <param name="expressinstall" value="Scripts/expressInstall.swf" />
          <!-- La siguiente etiqueta object es para navegadores distintos de IE. Ocúltela a IE mediante IECC. -->
          <!--[if !IE]>-->
          <object type="application/x-shockwave-flash" data="swf/menu.swf" width="165" height="250">
            <!--<![endif]-->
            <param name="quality" value="high" />
            <param name="wmode" value="transparent" />
            <param name="swfversion" value="6.0.65.0" />
            <param name="expressinstall" value="Scripts/expressInstall.swf" />
            <!-- El navegador muestra el siguiente contenido alternativo para usuarios con Flash Player 6.0 o versiones anteriores. -->
            <div>
              <h4>El contenido de esta página requiere una versión más reciente de Adobe Flash Player.</h4>
              <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtener Adobe Flash Player" width="112" height="33" /></a></p>
            </div>
            <!--[if !IE]>-->
          </object>
          <!--<![endif]-->
        </object></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php include('links.php');?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><table width="596" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="archivos/barra_index_sup.png" width="602" height="33" /></td>
      </tr>
      
      <tr>
        <td bgcolor="#1A1A1A"><form id="form1" name="form1" method="post" action="nuestros_equipos.php">
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td class="titulo">Nuestros equipos </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><p>Rentadores del  Norte S.A.C. cuenta con camionetas de supervisión y contenedores - taller para  el soporte técnico de sus equipos en el campo de trabajo, así como también un  amplio stock de repuestos para sus unidades.</p></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Tipo de Equipo:</td>
            </tr>
            <tr>
              <td><label>
                <select name="tipo_equipo" id="tipo_equipo" onchange="javascript:document.forms.form1.submit();">
                <option value="0">Seleccione un tipo de equipo</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_rs_tipo_equipo['cat_id']?>"<?php if (!(strcmp($row_rs_tipo_equipo['cat_id'], $_REQUEST['tipo_equipo']))) {echo "selected=\"selected\"";} ?>><?php echo $row_rs_tipo_equipo['cat_descripcion']?></option>
                  <?php
} while ($row_rs_tipo_equipo = mysql_fetch_assoc($rs_tipo_equipo));
  $rows = mysql_num_rows($rs_tipo_equipo);
  if($rows > 0) {
      mysql_data_seek($rs_tipo_equipo, 0);
	  $row_rs_tipo_equipo = mysql_fetch_assoc($rs_tipo_equipo);
  }
?>
                </select>
              </label></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            
            <?php if($_REQUEST['tipo_equipo']<=0){?>
            
            <tr>
              <td >



<?php do { ?>
<div class="cuadro">
<a href="<?php echo $row_rs_equipo_ultimos['gal_foto1']; ?>" rel="lightbox"><img src="<?php echo $row_rs_equipo_ultimos['gal_foto1']; ?>" width="128" height="105" border="0" /></a>
</div>
	<?php 
				  } while ($row_rs_equipo_ultimos = mysql_fetch_assoc($rs_equipo_ultimos)); ?>


              
              </td>
            </tr>
            <?php } ?>
            <tr>
              <td><?php do { ?>
              <?php if($row_rs_equipos['gal_foto1']!=''){ ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="35%" valign="top" class="color_marron"><a href="<?php echo $row_rs_equipos['gal_foto1']; ?>" rel="lightbox"><img src="<?php echo $row_rs_equipos['gal_foto1']; ?>" alt="" width="185" height="151" border="0" /></a></td>
                      <td width="61%" valign="top"><span class="color_marron_titulo"><?php echo $row_rs_equipos['gal_titulo']; ?>
                        <br />
                        </span><p><?php echo nl2br($row_rs_equipos['gal_descripcion']); ?></p>
                          <?php if($row_rs_equipos['gal_archivo']!='fotos/archivos_galeria_nv2/'){?>
                          <a href="<?php echo $row_rs_equipos['gal_archivo']; ?>" target="_blank" class="button"><span>Descargar</span></a>
                          <?php } ?>                       
                          <a href="cotizacion_alquiler.php" class="button"><span>Cotizar</span></a></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                <?php } ?>
                  <?php } while ($row_rs_equipos = mysql_fetch_assoc($rs_equipos)); ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;
                <table border="0">
                  <tr>
                    <td><?php if ($pageNum_rs_equipos > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rs_equipos=%d%s", $currentPage, 0, $queryString_rs_equipos); ?>">Primero</a>
                        <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_rs_equipos > 0) { // Show if not first page ?>
                        <a href="<?php printf("%s?pageNum_rs_equipos=%d%s", $currentPage, max(0, $pageNum_rs_equipos - 1), $queryString_rs_equipos); ?>">Anterior</a>
                        <?php } // Show if not first page ?></td>
                    <td><?php if ($pageNum_rs_equipos < $totalPages_rs_equipos) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rs_equipos=%d%s", $currentPage, min($totalPages_rs_equipos, $pageNum_rs_equipos + 1), $queryString_rs_equipos); ?>">Siguiente</a>
                        <?php } // Show if not last page ?></td>
                    <td><?php if ($pageNum_rs_equipos < $totalPages_rs_equipos) { // Show if not last page ?>
                        <a href="<?php printf("%s?pageNum_rs_equipos=%d%s", $currentPage, $totalPages_rs_equipos, $queryString_rs_equipos); ?>">&Uacute;ltimo</a>
                        <?php } // Show if not last page ?></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td><img src="archivos/barra_index_inf.png" width="602" height="33" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php include 'logos.php';?></td>
  </tr>
</table>
<p>&nbsp;</p>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID2");
swfobject.registerObject("FlashID3");
//-->
</script>
</body>
</html>
<?php
mysql_free_result($rs_tipo_equipo);

mysql_free_result($rs_equipos);

mysql_free_result($rs_equipo_ultimos);
?>
