<?php
    require_once "../../config/auth.php";
    require_once "../Models/disciplina.php";
    if((isset($_POST["cxadyaswtraz"]) ||isset($_POST["Editar"])) && ($permissao == 1 || $permissao == 2)){
       
        $nomeDisciplina         = $_POST["nome_disciplina"];
        $idCurso                = $_POST["curso"];
        $idProfessor            = $_POST["idProfessor"];
        $idDepartamento         = $_POST["idDeparta"];
        $id                     = $_POST["idusuario"];
        $anoEscolar             = $_POST["anoEscolar"];
        $anoLetivo              = $_POST["anoLetivo"];
        $ativo = 1;

        if(isset($_POST["cxadyaswtraz"]) &&  $_POST["cxadyaswtraz"]=="c1ad2as3tra4" && $id === $idUsuario){
            $dados = array(1=>$nomeDisciplina,$ativo,$idCurso,$idProfessor,$anoLetivo,$anoEscolar);
            $dadosProfe = array(1=>$idProfessor,$idCurso,$id,$ativo);
            
           cadastraDisciplina($dados,$dadosProfe,$idDepartamento,$permissao); 
        }
        else if(isset($_POST["Editar"]) && $_POST["Editar"]==="Disciplina"){
            $idDisciplina              = $_POST["idDisciplina"];
            $idProfeCurso              = $_POST["idProfeCurso"];
            $dados = array(1=>$nomeDisciplina,$idCurso,$idProfessor,$anoEscolar,$idDisciplina);
               $dadosProfe = array(1=>$idProfessor,$idCurso,$id,$idProfeCurso);
            
          atualizarDisciplina($dados,$dadosProfe,$idDepartamento,$permissao);
       }else{
           header("location:../../");
       }
       
    }else{
        header("location:../../");
    }
?>
