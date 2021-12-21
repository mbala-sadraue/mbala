<?php
 require_once "../../../config/auth.php";
include_once "../../../App/Models/turma.php";
if($permissao == 2){
	if(isset($_POST['id']) && isset($_POST["status"])){
	  $value  = $_POST['status'];
	  $id     = $_POST['id'];
	  ativaTurma($id,$value,$permissao);
	}
}
?>