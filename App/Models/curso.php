<?php 
	require_once "connection.php";
	/*FUNÇÃO PARA CADASTRA CURSO*/
	function cadastraCurso($nome,$idDeparta,$id,$permissao,$anoLetivo){
		if($nome != "" && $id!=0){
      $con = conectarBancoDados();
      try {
        $ativo = 1;
			$cadastra = $con->prepare("INSERT INTO curso VALUE(DEFAULT,?,?,?,?,?)");
      $cadastra->bindValue(1,$nome);
      $cadastra->bindValue(2,$ativo);
      $cadastra->bindValue(3,$idDeparta);
			$cadastra->bindValue(4,$id);
			$cadastra->bindValue(5,$anoLetivo);
			$cadastra->execute();
			if($permissao == 1){
					$url = "adminG";
				}else{
					$url = "adminA";
				}
			if($cadastra->rowCount()==1){
				header("location:../../views/".$url."/curso/?alert=1");
			}else{
				header("location:../../views/".$url."/curso/?alert=0");
			}
      }catch(Exception $e) {
        echo "Erro ".$e->getMessage();
      }
		}
	}
	/*FUNÇÃO PARA LISTAR CURSO EM TODOS MEMBROS*/
	function listaCurso($idCurso,$public){
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM curso  WHERE curso_idDeparta = ? && Ativo = ?");
			$listar->bindValue(1,$idCurso);
			$listar->bindValue(2,$public);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÂO PARA LISTAR CURSO NA PAGINA DE CADASTRO DE DISCIPLINA*/
	function listaCursoDisciplina($id){
		$ativo = 1;
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM curso WHERE curso_idDeparta = ? && Ativo = ?" );
			$listar->bindValue(1,$id);
			$listar->bindValue(2,$ativo);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return false;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
  }
  function buscaCurso($id){
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM curso INNER JOIN departamento ON curso.curso_idDeparta = departamento.idDeparta WHERE curso.idCurso = ? ");
	     	$listar->bindValue(1,$id);
	     	$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	// FUNÇÃO PARA ATUALIZAR CURSO
	function atualizarCurso($nomeCurso,$idDepartamento,$idCurso,$permissao){
		try{
				$con = conectarBancoDados();
				$Atualizar = $con->prepare("UPDATE curso SET NomeCurso = ?, curso_idDeparta  = ? WHERE idCurso = ?");
				$Atualizar->bindValue(1,$nomeCurso);
				$Atualizar->bindValue(2,$idDepartamento);
				$Atualizar->bindValue(3,$idCurso);
				$Atualizar->execute();
					if($permissao == 1){
					$url = "adminG";
				}else{
					$url = "adminA";
				}
				if ($Atualizar->roWCount()==1) {
					header("location:../../views/".$url."/curso/?alert=1");
				} else {
					header("location:../../views/".$url."/curso/?alert=0");
				}
				
		}catch(PDOException $e){
			echo "Erro ".$e->getMessage();
		}
	}
	function listaCursos(){
			$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM curso INNER JOIN departamento ON curso_idDeparta = departamento.idDeparta  ");

      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	function listaCursoA($public){
			$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM curso INNER JOIN departamento ON curso_idDeparta = departamento.idDeparta  ");

      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	//FUNÇÃO PARA ATIVAR E DESATIVAR CURSO
  function ativaCurso($value,$id,$permissao){
     $con    = conectarBancoDados();
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        $ativa =  $con->prepare("UPDATE curso SET Ativo = ? WHERE idCurso = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
				$ativa->execute();
				if($permissao == 1){
					$urlAtivo = "adminG";
				}else{
					$urlAtivo = "adminA";
				}
        if($ativa->rowCount()==1){
            header("location:../../".$urlAtivo."/curso/?alert=1");
        }else {
            header("location:../../".$urlAtivo."/curso/?alert=0");
        }
    } catch (PDOExeception $e) {
      echo "Erro ".$e->getMessage();
    }
	}
	// UNÇÃO PARA lISTAR BUSCAR DEDARTAMENTO CORRESPONDENTE AO CURSO
	function departamentoCurso(){
			$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento INNER JOIN curso ON curso.curso_idDeparta = departamento.idDeparta  ");

      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO QUE BUSCA QUANTIDADE DE DISCIPLINA*/
	function listaDisciplinaCurso($idCurso,$anoLetivo,$public){
			$con = conectarBancoDados();
			$ativo = 1;
		try {
			$listar = $con->prepare("SELECT COUNT(*) FROM disciplina WHERE curso_idCurso = ? && AnoLetivo_idAno = ? && Ativo = ? ");
			$listar->bindValue(1,$idCurso);
			$listar->bindValue(2,$anoLetivo);
			$listar->bindValue(3,$public);
      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetch(PDO::FETCH_ASSOC);
			return $dados["COUNT(*)"];
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
		/*FUNÇÃO QUE BUSCA QUANTIDADE DE PROFESSOR QUE DA AULA EM UM DETERMINADO CURSO*/
	function listaQuantProfessor($idCurso,$public){
			$con = conectarBancoDados();
			$ativo = 1;
		try {
			$listar = $con->prepare("SELECT COUNT(*) FROM `professor_vs_curso` WHERE curso_idCurso = ? && Ativo = ?");
			$listar->bindValue(1,$idCurso);
			$listar->bindValue(2,$public);
      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetch(PDO::FETCH_ASSOC);
			return $dados["COUNT(*)"];
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
/*FUNÇÃO BUSCA QUANTOS ALUNOS QUE FAZEM UM DETERMINADO CURSO, PASSANDO O ID DO CURSO  E RETORNA O NÚMEROS DE
DE ALUNOS QUE FAZEM PARTE DA AQUELE CURSO*/
function buscaAlunoCurso($idCurso,$public,$anoLetivo){
  	$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT COUNT(*) FROM aluno  WHERE curso_idCurso = ? && Aluno_Ativo = ? && anoletivo_idAno =? ");
      $listar->bindValue(1,$idCurso);
      $listar->bindValue(2,$public);
			$listar->bindValue(3,$anoLetivo);
      $listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetch(PDO::FETCH_ASSOC);
				return $dados["COUNT(*)"];
			}else{
				return 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
}
 ?>