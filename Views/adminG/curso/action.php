<?php
include_once "../../../App/Models/curso.php";
require_once "../../../config/auth.php";
if($permissao == 1){
	if(isset($_POST['id']) && isset($_POST["status"])){
	  $value  = $_POST['status'];
	  $id     = $_POST['id'];
	  ativaCurso($value,$id,$permissao);
	}
}
?>