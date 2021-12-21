<?php
require_once "../../config/auth.php";
 require_once "../Models/turma.php";

if(isset($_POST["cadastra"]) ||($_POST["atualizar"]&& $_POST["atualizar"])=="turma" ){
 // print_r($_POST);
  $nome       =   $_POST["nome_turma"];
  $sala       =   $_POST["nome_sala"];
  $deretor    =   $_POST["nome_diretor"];
  $anoEscolar =   $_POST["ano_escolar"];
  $idDeparta  =   $_POST["departamento"];
  $curso      =   $_POST["curso"];
  $anoLetivo  =   $_POST["anoLetivo"];
  $vaga       =    $_POST["vaga"];  



  if((isset($_POST["cadastra"]) && $_POST["cadastra"]=="turma") && ($permissao == 1 || $permissao==2 )){
    cadastraTurma($nome,$sala,$deretor,$curso,$anoEscolar,$idDeparta,$anoLetivo,$vaga,$permissao);
  }
  if((isset($_POST["atualizar"]) && $_POST["atualizar"]=="turma" && isset($_POST["idTurma"])) && ($permissao == 1 || $permissao==2 )){
    $idTurma = $_POST["idTurma"];
     atualizarTurma($dados = array(1=>$nome,$sala,$deretor,$curso,$anoEscolar,$idDeparta,$anoLetivo,$vaga,$idTurma),$permissao);
  }
}else{
echo"Seu gatuno";
}

?>