<?php
    require_once "../../config/auth.php";
    require_once "../Models/curso.php";
    if((isset($_POST["cxadyaswtraz"]) ||isset($_POST["Editar"]))&& ($permissao==1 || $permissao==2) && isset($_POST["anoLetivo"]) &&isset($_POST["nome_curso"])){
       if($_POST["nome_curso"] == null){
         echo "<script>alert('O campo nome do curso é obrigatório')</script>";
         echo "<script>window.location='../../'</script>";

       }else{
        $nomeCurso        = $_POST["nome_curso"];
        $idDepartamento   = $_POST["departamento"];
        $id               = $_POST["idusuario"];
        $anoLetivo        = $_POST["anoLetivo"];
        if(isset($_POST["cxadyaswtraz"]) &&  $_POST["cxadyaswtraz"]=="c1ad2as3tra4" && $id === $idUsuario){
           cadastraCurso($nomeCurso,$idDepartamento,$id,$permissao,$anoLetivo); 
        }
        else if(isset($_POST["Editar"]) && $_POST["Editar"]==="Curso"){
            $idCurso              = $_POST["idCurso"];
        atualizarCurso($nomeCurso,$idDepartamento,$idCurso,$permissao,$anoLetivo); 
       }else{
           header("location:../../");
       }
       }
    }else{
        header("location:../../");
    }
?>
