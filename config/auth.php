<?php 
	session_start();
	$url 		="http://anuarite.com/";
	$url2  	="http://anuarite.com/views/";
	$urlF1 	="http://anuarite.com/App/Models/";
	$urlF2 	="http://anuarite.com/App/Database/";
	if(isset($_SESSION["idLogin"])){
		if(isset($_SESSION["idUsuario"]) && isset($_SESSION["tipoUsuario"])){
			$idUsuario			=	$_SESSION["idUsuario"];
			$permissao			=	$_SESSION["tipoUsuario"];
			$nomeUsuario		=	$_SESSION["Nome"];
		  	$anoLetivo			=   $_SESSION["idAnoLetivo"];
		  	if(isset($_SESSION["foto"]) && $_SESSION["foto"] != null){
		  		$nomeFoto =  $_SESSION["foto"];
		  	}else{
		  			 $nomeFoto = "usuario.jpg";
		  	}
			if($permissao != 1 && isset($_SESSION["idDeparta"])){
				$index_idDeparta = $_SESSION["idDeparta"];
			}
		}
	}else{
		header("location:".$url."login.php");
	}

?>