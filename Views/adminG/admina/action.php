<?php
 require_once "../../../config/auth.php";
include_once "../../../App/Models/administrativa.php";
if($permissao=1){
	if(isset($_POST['id']) && isset($_POST["status"])){
	  $value  = $_POST['status'];
	  $id     = $_POST['id'];
	  ativaAdminidtrativa($id,$value);
	}
}else{
	echo "voce Não !";
}
?>