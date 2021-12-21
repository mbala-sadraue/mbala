<?php
  require_once "connection.php";


  /*FUNÇÃO PARA CADASTRA TURMA NA TABELA TURMA*/
  function cadastraTurma($nome,$sala,$deretor,$curso,$anoEscolar,$idDeparta,$anoLetivo,$vaga,$permissao){
    $con    = conectarBancoDados();
    try {
      $ativo = 1;
      $cadastra = $con->prepare("INSERT INTO `turma` VALUE(DEFAULT,?,?,?,?,?,?,?,?,?)");
      $cadastra->bindValue(1,$nome);
      $cadastra->bindValue(2,$sala);
      $cadastra->bindValue(3,$deretor);
      $cadastra->bindValue(4,$curso);
      $cadastra->bindValue(5,$anoEscolar);
      $cadastra->bindValue(6,$idDeparta);
      $cadastra->bindValue(7,$anoLetivo);
      $cadastra->bindValue(8,$ativo);
      $cadastra->bindValue(9,$vaga);
      $cadastra->execute();
      if($permissao == 1){
      $urlAtivo = 'adminG'; 
      }else if($permissao == 2){
        $urlAtivo = 'adminA';
      }
            
      if($cadastra->rowCount()==1){
        header("location:../../views/".$urlAtivo."/turma?alert=1");
      }else{
        header("location:../../views/".$urlAtivo."/turma/?alert=0");
      }
    } catch (PDOException $e) {
        echo "Erro ".$e->getMessage();
    }
  }
 /*FUNÇÃO PARA LISTAR TURMA NA PAGINA TURMA*/
   function listarTurma($anoLetivo,$idDeparta,$public){
    
    try {
      $con    = conectarBancoDados();
      $listar = $con->prepare("SELECT * FROM `turma` INNER JOIN curso ON turma.curso_idCurso = curso.idCurso JOIN anosescolares 
      ON turma.Escolar_idAnoEsco = anosescolares.idAnosEscolares JOIN ano_letivo ON turma.ano_letivo_idAno = ano_letivo.idAno_letivo INNER JOIN departamento ON turma.Departa_idDeparta = departamento.idDeparta 
      WHERE turma.Departa_idDeparta= ? AND turma.ano_letivo_idAno = ? AND turma.TurmaAtivo = ? ORDER BY NomeCurso,NomeTurma ");
      $listar->bindValue(1,$idDeparta);
      $listar->bindValue(2,$anoLetivo);
      $listar->bindValue(3,$public);
      $listar->execute();
           
      if($listar->rowCount()>0){
        $dados = array();
        $dados = $listar->fetchAll(PDO::FETCH_OBJ);
        return $dados;
      }else{
        return 0;
      }
    } catch (PDOException $e) {
        echo "Erro ".$e->getMessage();
    }
  }
  /*FUNÇÃO PARA  BUSCAR E LISTAR TURMA NA PAGINA LISTA-TURMA*/
   function listarTurma2($anoLetivo,$idDeparta,$public,$idCurso){
    $con    = conectarBancoDados();
    try {
      
      $listar = $con->prepare("SELECT * FROM `turma` INNER JOIN curso ON turma.curso_idCurso = curso.idCurso JOIN anosescolares 
      ON turma.Escolar_idAnoEsco = anosescolares.idAnosEscolares JOIN ano_letivo ON turma.ano_letivo_idAno = ano_letivo.idAno_letivo INNER JOIN departamento ON turma.Departa_idDeparta = departamento.idDeparta 
      WHERE turma.Departa_idDeparta= ? AND turma.ano_letivo_idAno = ? AND turma.TurmaAtivo = ?AND turma.curso_idCurso = ? ORDER BY NomeCurso,NomeTurma ");
      $listar->bindValue(1,$idDeparta);
      $listar->bindValue(2,$anoLetivo);
      $listar->bindValue(3,$public);
      $listar->bindValue(4,$idCurso);
      $listar->execute();
           
      if($listar->rowCount()>0){
        $dados = array();
        $dados = $listar->fetchAll(PDO::FETCH_OBJ);
        return $dados;
      }else{
        return 0;
      }
    } catch (PDOException $e) {
        echo "Erro ".$e->getMessage();
    }
  }
    /*FUNÇÃO PARA   LISTAR QUANTIDADE DE TURMA NUM DETERMINADO CURSO*/
   function listaQuantTurma($anoLetivo,$idDeparta,$public,$idCurso){
    $con    = conectarBancoDados();
    try {
      
      $listar = $con->prepare("SELECT * FROM `turma` WHERE turma.Departa_idDeparta= ? AND turma.ano_letivo_idAno = ? AND turma.TurmaAtivo = ?AND turma.curso_idCurso = ?  ");
      $listar->bindValue(1,$idDeparta);
      $listar->bindValue(2,$anoLetivo);
      $listar->bindValue(3,$public);
      $listar->bindValue(4,$idCurso);
      $listar->execute();
           
       return $listar->rowCount();
    } catch (PDOException $e) {
        echo "Erro ".$e->getMessage();
    }
  }
  
   /*FUNÇÃO PARA BUSACR  TURMA  PARA SER EDITADO*/
   function buscaDadosTurma($anoLetivo,$idDeparta,$public,$id){
    $con    = conectarBancoDados();
    try {
      
      $listar = $con->prepare("SELECT * FROM `turma` INNER JOIN curso ON turma.curso_idCurso = curso.idCurso JOIN anosescolares 
      ON turma.Escolar_idAnoEsco = anosescolares.idAnosEscolares JOIN ano_letivo ON turma.ano_letivo_idAno = ano_letivo.idAno_letivo INNER JOIN departamento ON turma.Departa_idDeparta = departamento.idDeparta 
      WHERE turma.Departa_idDeparta= ? AND turma.ano_letivo_idAno = ? AND turma.TurmaAtivo = ? AND turma.idTurma = ? LIMIT  1");
      $listar->bindValue(1,$idDeparta);
      $listar->bindValue(2,$anoLetivo);
      $listar->bindValue(3,$public);
      $listar->bindValue(4,$id);
      $listar->execute();
           
      if($listar->rowCount()>0){
        $dados = array();
        $dados = $listar->fetchAll(PDO::FETCH_OBJ);
        return $dados;
      }else{
        return 0;
      }
    } catch (PDOException $e) {
        echo "Erro ".$e->getMessage();
    }
  }
  

  /*FUNÇÃO PARA ATIVER E DESATIVER TURMA*/
  function ativaTurma($id,$value,$permissao){
    $con    = conectarBancoDados();
    try { 
      
      if($value == 1){
        $v = 0;
      }else{
        $v = 1;
      }
       if($permissao==1){
          $urlAtivo = "adminG";
        }elseif($permissao==2){
            $urlAtivo= "adminA";
        }
      
       $ativa= $con->prepare("UPDATE turma SET TurmaAtivo = ? WHERE idTurma = ?");
       $ativa->bindValue(1,$v);
       $ativa->bindValue(2,$id);
       $ativa->execute();
       if($ativa->rowCount()==1){
            header("location:../../".$urlAtivo."/turma/?alert=1");
        }else {
            header("location:../../".$urlAtivo."/turma/?alert=0");
        }

    } catch (PDOException $e) {
      echo"Erro ".$e->getMessage();
    }
  }
  function atualizarTurma($dados,$permissao){
    $con    = conectarBancoDados();
    if(is_array($dados)){
      
        try {
          $ativo = 1;
          $atualizar = $con->prepare("UPDATE turma SET NomeTurma  = ?, Sala = ?, Diretor = ?, 	curso_idCurso = ?, Escolar_idAnoEsco = ?,
           Departa_idDeparta = ?, ano_letivo_idAno = ?, Vaga = ? WHERE  idTurma = ?");
           foreach($dados as $k => $v){
             $atualizar->bindValue($k,$v);
           }
          $atualizar->execute();
          
          if($permissao == 1){
            $urlAtivo = 'adminG'; 
          }else if($permissao == 2){
            $urlAtivo = 'adminA';
          }
                
          if($atualizar->rowCount()==1){
            header("location:../../views/".$urlAtivo."/turma?alert=1");
          }else{
            header("location:../../views/".$urlAtivo."/turma/?alert=0");
          }
        } catch (PDOException $e) {
            echo "Erro ".$e->getMessage();
        }
    }
   }
?>