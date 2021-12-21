<?php

require_once "connection.php";

/*FUÇÃO PARA CADASTRAR ANO ESCOLAR*/
function cadastraAnoEscolar( $anoEscolar,$ciclo, $idDeparta,$anoLetivo,$permissao){
 $con    = conectarBancoDados();
  try {
    $ativo = 1;
    $cadastra = $con->prepare("INSERT INTO `anosescolares` VALUE(DEFAULT,?,?,?,?,?)");
    $cadastra->bindValue(1,$anoEscolar);
    $cadastra->bindValue(2,$ciclo);
    $cadastra->bindValue(3,$ativo);
    $cadastra->bindValue(4,$anoLetivo);
    $cadastra->bindValue(5,$idDeparta);
    $cadastra->execute();
    if($permissoa == 1){
    $urlAtivo = 'adminG'; 
    }else if($permissao == 2){
      $urlAtivo = 'adminA';
    }
          
    if($cadastra->rowCount()==1){
      header("location:../../views/".$urlAtivo."/anoEscolar/?alert=1");
    }else{
      header("location:../../views/".$urlAtivo."/anoEscolar/?alert=0");
    }
  } catch (Exption $e) {
      echo "Erro ".$e->getMessage();
  }
}
/*
/*FUÇÃO PARA CADASTRAR ANO ESCOLAR*/
function listarAnoescolar($public,$idDeparta,$anoLetivo){
 $con    = conectarBancoDados();
  try {
    
    $listar = $con->prepare("SELECT * FROM  `anosescolares` WHERE `escolarAtivo`=? AND`Departa_idDeparta`=? AND letivo_idAno_letivo=? ORDER BY Ciclo, NomeAnoEscolar");
    $listar->bindValue(1,$public);
    $listar->bindValue(2,$idDeparta);
    $listar->bindValue(3,$anoLetivo);
    $listar->execute();
          
    if($listar->rowCount()>0){
     $dados = $listar->fetchAll(PDO::FETCH_OBJ);
     return $dados;
    }else{
     return 0;
    }
  } catch (Exption $e) {
      echo "Erro ".$e->getMessage();
  }
  
}
function listarAnoescolarDisciplina($idDeparta){
  $public = 1;
   $con    = conectarBancoDados();
 try {
    
    $listar = $con->prepare("SELECT * FROM  `anosescolares` WHERE `escolarAtivo`=? AND`Departa_idDeparta`=?");
    $listar->bindValue(1,$public);
    $listar->bindValue(2,$idDeparta);
    $listar->execute();
          
    if($listar->rowCount()>0){
     $dados = $listar->fetchAll(PDO::FETCH_OBJ);
     return $dados;
    }else{
     return 0;
    }
    unset($public);
  } catch (Exption $e) {
      echo "Erro ".$e->getMessage();
  }
}
/*CONTA QUANTOS ANOS ESCOLARES TEM UM CURSO*/
function quantidadeAnoescolaCurso($public,$idDeparta,$anoLetivo,$idcurso){
 $con    = conectarBancoDados();
  try {
    
    $listar = $con->prepare("SELECT Escolar_idAnoEsco FROM  `turma` WHERE `TurmaAtivo`=? AND `Departa_idDeparta`=? AND ano_letivo_idAno=?  AND curso_idCurso = ?");
    $listar->bindValue(1,$public);
    $listar->bindValue(2,$idDeparta);
    $listar->bindValue(3,$anoLetivo);
    $listar->bindValue(4,$idcurso);
    $listar->execute();
          
    return $listar->rowCount();
  } catch (Exption $e) {
      echo "Erro ".$e->getMessage();
  }
  
}
?>