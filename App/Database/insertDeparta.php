<?php
    require_once "../../config/auth.php";
    require_once "../Models/departamento.php";
    if((isset($_POST["cxadyaswtraz"]) || isset($_POST["atualizar"])) && isset($_POST["nome_departamento"])){
        $nomeDepartamento = $_POST["nome_departamento"];
        $id               = $_POST["idusuario"];
       if($id === $idUsuario && isset($_POST["cxadyaswtraz"]) && $_POST["cxadyaswtraz"]=="c1ad2as3tra4" ){
            cadastraDepartamento($nomeDepartamento,$id);
       }
       elseif($_POST["atualizar"] == "departamento"){
          $idDeparta = $_POST["idDeparta"] ; 
          atualizarDepartamento($nomeDepartamento,$idDeparta);
       }else{
            header("location:../../login.php");
       }
       
    }else{
        header("location:../../");
    }
?>
