<?php
	 require_once "../../../config/auth.php";
	 include_once "../../../App/Models/secretario.php";
	 	if($permissao==2){
		  if(isset($_POST['id']) && isset($_POST["status"])){
		    $value  = $_POST['status'];
		    $id     = $_POST['id'];
		    ativaSecretario($id,$value,$permissao);
		  }
		}
?>