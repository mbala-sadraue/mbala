<?php
include_once "../../../App/Models/disciplina.php";
require_once "../../../config/auth.php";
if($permissao == 2){
	if(isset($_POST['id']) && isset($_POST["status"])){
	  $value  = $_POST['status'];
	  $id     = $_POST['id'];
	  ativaDisciplina($value,$id,$permissao);
	}
}
?>