<?php
 require_once "../../../config/auth.php";
  include_once "../../../App/Models/departamento.php";
  if($permissao){
    if(isset($_POST['id']) && isset($_POST["status"])){
      $value  = $_POST['status'];
      $id     = $_POST['id'];
      ativaDepartamento($id,$value);
    }
}
?>