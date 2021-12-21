<?php 
	require_once "connection.php";
	function cadastraDepartamento($nome,$id){
		if($nome != "" && $id!=0){
			$con = conectarBancoDados();
			$ativo = 1;
      try {
			$cadastra = $con->prepare("INSERT INTO departamento VALUE(DEFAULT,?,?,?)");
			$cadastra->bindValue(1,$nome);
				$cadastra->bindValue(2,$ativo);
			$cadastra->bindValue(3,$id);
			$cadastra->execute();
			if($cadastra->rowCount()==1){
				header("location:../../views/adminG/departamento/?alert=1");
			}else{
				header("location:../../views/adminG/departamento/?alert=0");
			}
      }catch(Exception $e) {
        echo "Erro ".$e->getMessage();
      }
		}
	}
	// FUNÇÃO PARA EDITAR DEPARTAMENTO
	function   atualizarDepartamento($nomeDepartamento,$idDeparta){
		$con = conectarBancoDados();
		try {
			$atualizar = $con->prepare("UPDATE departamento SET NomeDeparta = ? WHERE idDeparta = ?");
			$atualizar->bindValue(1,$nomeDepartamento);
			$atualizar->bindValue(2,$idDeparta);
			$atualizar->execute();
			if($atualizar->rowCount()==1){
            header("location:../../views/adminG/departamento/?alert=1");
        }else {
            header("location:../../views/adminG/departamento/?alert=0");
        }
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	//LISTAR DE PARTAMENTO/
	function listaDepartamento(){
		$ativo  = 1;
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento WHERE departa_Ativo = ?");
			$listar->bindValue(1,$ativo);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return $dados = 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	//LISTAR DE PARTAMENTO EXPECIFICADO POR ID/
	function listaDepartamentoExpecificado($idDeparta){
		$ativo  = 1;
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento WHERE idDeparta = ? &&  departa_Ativo = ?");
			$listar->bindValue(1,$idDeparta);
			$listar->bindValue(2,$ativo);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return $dados = 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO PARA LISTAR DEPARTAMENTO NA PAGINA PRINCIPAL */
	function listaDepartamentoIndex($public){
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento WHERE departa_Ativo = ?");
			$listar->bindValue(1,$public);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return $dados = 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO PARA LISTAR DEPARTAMENTO PARA CADASTRA DISCIPLINA*/
	function listaDepartamentoDisciplina($idDeparta){
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento WHERE idDeparta = ?");
			$listar->bindValue(1,$idDeparta);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return $dados = 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	//FUNÇÃO PARA ATIVAR E DESATIVAR DEPARTAMENTO
  function ativaDepartamento($id,$value){
     $con    = conectarBancoDados();
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        echo "${id} ${value} ${v}";
        $ativa =  $con->prepare("UPDATE departamento  SET departa_Ativo = ? WHERE idDeparta = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
        $ativa->execute();
        if($ativa->rowCount()==1){
            header("location:../../adminG/departamento/?alert=1");
        }else {
            header("location:../../adminG/departamento/?alert=0");
        }
    } catch (PDOExeception $e) {
      echo "Erro ".$e->getMessage();
    }
	}
	function listaCursoDepartamento($public,$id){
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT COUNT(*) FROM curso WHERE curso_idDeparta = ?&&  curso.Ativo = ?  ");
			$listar->bindValue(1,$id);
			$listar->bindValue(2,$public);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_ASSOC);
				return $dados;
			}else{
				return "Sem dados";
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	function listaDepartamentoDinamico($inicio,$por_pagina){
		$ativo  = 1;
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento WHERE departa_Ativo = ? LIMIT ?,?");
			$listar->bindValue(1,$ativo);
			$listar->bindValue(2,$inicio,PDO::PARAM_INT);
			$listar->bindValue(3,$por_pagina,PDO::PARAM_INT);
			$listar->execute();
			if($listar->rowCount()>0){
				$dados = $listar->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			}else{
				return $dados = 0;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}

	function listaQuanitadeDepartamentoDinamico(){
		$ativo  = 1;
		$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM departamento WHERE departa_Ativo = ? ");
			$listar->bindValue(1,$ativo);
			$listar->execute();
			return $listar->rowCount();
			
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
 ?>