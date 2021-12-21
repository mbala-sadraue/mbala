<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Pagina Inicial</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="assets/css/estilo.css">

</head>
<body>
	<div class="pg_corpo">
		<div class="pg_sbcorpo">
<?php
    require_once "../../config/auth.php";
    require_once "layout/index.php";
    if($permissao == 1){
    	echo $header;
    	echo $mode;
    }else{
        header("location:".$url."login.php");
    }
    echo $fim;
?>