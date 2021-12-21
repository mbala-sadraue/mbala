<!DOCTYPE html>
<html>
<head>
	<title>Erros gerados</title>
</head>
<body>

<?php

if(isset($_SESSION["tipoUsuario"])){
  unset($_SESSION["tipoUsuario"]);
}
if(isset($permissao)) {
  unset($permissao);
}
if(isset($_GET["erro"]) && $_GET["erro"]>0){
  $erro = $_GET["erro"];

switch($erro){
  case 1:
    require 'erro.php';
    break;
    default :
    echo "Este problema é grave.<br/>Contacta o responsavél (programador) que desenvolver este software.";
}

}else{
  
  header("location:../");
}
?>
</body>
</html>

