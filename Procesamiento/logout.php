<?php
  session_start();
  unset($_SESSION["nomb"]); 
  unset($_SESSION["idcli"]);
  session_destroy();
  header("Location: ../index.php");
?>