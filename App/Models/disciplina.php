<?php
require_once "connection.php";
/*FUNÇÃO PARA CADASTRAR DISCIPLINA*/
function  cadastraDisciplina($dados,$dadosProfe,$idDepartamento,$permissao){ 
  $ativo = 1;
    $con = conectarBancoDados();
    try {
      if(is_array($dados)){
      $cadastra = $con->prepare("INSERT INTO disciplina VALUE(DEFAULT,?,?,?,?,?,?)");
      
      foreach ($dados as $k => $v) {
       $cadastra->bindValue($k,$v);
      }
      $cadastra->execute();
      if($permissao == 1){
          $urlAtivo = "adminG";
        }else{
          $urlAtivo = "adminA";
        }
      if($cadastra->rowCount()==1){
          $cadastraPc = $con->prepare("INSERT INTO`professor_vs_curso` VALUE(DEFAULT,?,?,?,?)");
          foreach ($dadosProfe as $k => $v) {
           $cadastraPc->bindValue($k,$v);
      }
          header("location:../../views/".$urlAtivo."/curso/?alert=1");
      }else {
         // header("location:../../views/".$urlAtivo."/curso/?alert=0");
      }
    }//VERIFICA SE DADOS É UM ARRAY
    } catch (Exception $e) {
      echo "Erro ".$e->getMessage();
    }
  
}

/*FUNÇÃO PARA LISTAR DISCILPINA NA PAGINA DISCIPLINA*/
function listarDisciplinaIndex($idCurso,$public){
  try {
    $con = conectarBancoDados();
    $lista = $con->prepare("SELECT * FROM disciplina JOIN professor ON disciplina.profe_idProfessor = professor.idProfessor 
    JOIN pessoa ON professor.pessoa_idPessoa = pessoa.idPessoa 
    WHERE disciplina.Curso_idCurso = ? && disciplina.Ativo = ?");
    $lista->bindValue(1,$idCurso);
    $lista->bindValue(2,$public);
    $lista->execute();
    if($lista->roWCount()>0){
      $dados = $lista->fetchAll(PDO::FETCH_OBJ);
      return  $dados;
    }else {
       return  0;
    }
  } catch (Exception $e) {
    echo "Erro ".$e->getMessage();
  }
}
 
/*FUNÇÃO QUE ATUALIZA DISCIPLINA*/
  function  atualizarDisciplina($dados,$dadosProfe,$idDepartamento,$permissao){
    $ativo = 1;
   	try{
       if(is_array($dados) && is_array($dadosProfe)){
				$con = conectarBancoDados();
				$Atualizar = $con->prepare("UPDATE disciplina SET NomeDisciplina = ?, Curso_idCurso  = ?,profe_idProfessor=?, anoEscolar_idEscolar = ? WHERE idDisciplina = ?");
        foreach ($dados as $k => $v) {
          	$Atualizar->bindValue($k,$v);
       }
				$Atualizar->execute();
					if($permissao == 1){
					$url = "adminG";
				}else{
					$url = "adminA";
				}
				if ($Atualizar->roWCount()==1) {
          /*CÓDIGO QUE ATUALIZA NA TABELA PROFESSOR_VS_CURSO*/
           $AtualizarPc = $con->prepare("UPDATE `professor_vs_curso` SET `pc_idProfessor`= ?, idCurso = ?,`idUsuario`=? WHERE `id_profe_curso`=? LIMIT 1)");
          foreach ($dados as $k => $v) {
           $AtualizarPc->bindValue($k,$v);
          }
           $AtualizarPc->execute();
					header("location:../../views/".$url."/curso/?alert=1");
				} else {
					header("location:../../views/".$url."/curso/?alert=0");
				}
      }else{
        echo"Dados passado está incompleto";
      }
				
		}catch(PDOException $e){
			echo "Erro ".$e->getMessage();
		}
  }


//FUNÇÃO PARA ATIVAR E DESATIVAR CURSO
  function ativaDisciplina($value,$id,$permissao){
     $con    = conectarBancoDados();
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        $ativa =  $con->prepare("UPDATE disciplina SET Ativo = ? WHERE idDisciplina = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
				$ativa->execute();
				if($permissao == 1){
					$urlAtivo = "adminG";
				}else{
					$urlAtivo = "adminA";
				}
        if($ativa->rowCount()==1){
            header("location:../../".$urlAtivo."/disciplina/?alert=1");
        }else {
            header("location:../../".$urlAtivo."/disciplina/?alert=0");
        }
    } catch (PDOExeception $e) {
      echo "Erro ".$e->getMessage();
    }
	}
function buscaDadosDisciplina($id){
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM disciplina INNER JOIN curso ON curso.idCurso = disciplina.Curso_idCurso INNER JOIN 
      professor ON disciplina.profe_idProfessor = professor.idProfessor INNER JOIN pessoa ON professor.pessoa_idPessoa = pessoa.idPessoa 
      JOIN professor_vs_curso ON professor_vs_curso.pc_idProfessor = disciplina.profe_idProfessor  WHERE disciplina.idDisciplina = ? ");
      $listar->bindValue(1,$id);
      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetch(PDO::FETCH_ASSOC);
				return $dados;
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
  }
/*FUNÇÃO BUSCA QUANTOS ALUNOS QUE FAZEM UM DETERMINANTE, PASSANDO O ID DO CURSO */
/*function buscaAlunoCurso($idCurso,$public){
  	$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT COUNT(*) FROM aluno  WHERE Curso_idCurso = ? && Aluno_Ativo = ?");
      $listar->bindValue(1,$idCurso);
       $listar->bindValue(2,$public);
      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetch(PDO::FETCH_ASSOC);
				return $dados["Curso_idCurso"];
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		
  }
}*/

function  disciplinaTurma($idCurso,$idAnoEscolar,$idAnoletivo){
  	$con = conectarBancoDados();
    $ativo = 1;
  try {
    	$listar = $con->prepare("SELECT * FROM disciplina  WHERE Curso_idCurso = ? && 	anoEscolar_idEscolar = ? && AnoLetivo_idAno = ? && Ativo = ? ");
      $listar->bindValue(1,$idCurso);
      $listar->bindValue(2,$idAnoEscolar);
      $listar->bindValue(3,$idAnoletivo);
      $listar->bindValue(4,$ativo);
      $listar->execute();
			if($listar->rowCount()>0){
				return $listar->rowCount();
			}else{
				return 0;
			}
  } catch (Exception $e) {
   echo "Erro ".$e->getMessage();
  }
}
function  professorTurma($idCurso,$idAnoEscolar,$idAnoletivo){
  	$con = conectarBancoDados();
    $ativo = 1;
  try {
    	$listar = $con->prepare("SELECT `profe_idProfessor` FROM disciplina  WHERE Curso_idCurso = ? && 	anoEscolar_idEscolar = ? && AnoLetivo_idAno = ? && Ativo = ? ");
      $listar->bindValue(1,$idCurso);
      $listar->bindValue(2,$idAnoEscolar);
      $listar->bindValue(3,$idAnoletivo);
      $listar->bindValue(4,$ativo);
      $listar->execute();
			if($listar->rowCount()>0){
				return $listar->rowCount();
			}else{
				return 0;
			}
  } catch (Exception $e) {
   echo "Erro ".$e->getMessage();
  }
}

//listarDisciplinaIndex($idCurso,$public)
/*FUNÇÃO PARA LISTAR DISCILPINA DE UMA DETERMINADA TURMA E ANO ESCOLAR*/
function listarDisciplinaTurma($idCurso,$idAnoEscolar,$anoLetivo,$public){
  try {
    $con = conectarBancoDados();
    $lista = $con->prepare("SELECT * FROM disciplina JOIN professor ON disciplina.profe_idProfessor = professor.idProfessor JOIN pessoa ON professor.pessoa_idPessoa = pessoa.idPessoa 
   INNER JOIN anosescolares ON disciplina.anoEscolar_idEscolar = anosescolares.idAnosEscolares  WHERE 
   disciplina.Curso_idCurso = ? && disciplina.anoEscolar_idEscolar = ?  && disciplina.AnoLetivo_idAno = ? && disciplina.Ativo = ? ");
    $lista->bindValue(1,$idCurso);
    $lista->bindValue(2,$idAnoEscolar);
    $lista->bindValue(3,$anoLetivo);
    $lista->bindValue(4,$public);
    $lista->execute();
    if($lista->roWCount()>0){
      $dados = $lista->fetchAll(PDO::FETCH_OBJ);
      return  $dados;
    }else {
       return  0;
    }
  } catch (Exception $e) {
    echo "Erro ".$e->getMessage();
  }
}

?>