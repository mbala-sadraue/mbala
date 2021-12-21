<?php 
	require_once"auth.php";
	require_once"../App/Models/connection.php";
	$idLogin   	=  	$_SESSION["idLogin"];
	$perm		=	$_SESSION["perm"];
	if(isset($perm)){
		switch($perm){
			case 1 :
			loginAdminGeral($idLogin,$url);
			break;
			case 2:
			loginAdminAdministrativo($idLogin,$url);
			break;
			case 3:
			loginSecretario($idLogin,$url);
			case 4:
				loginProfessor($idLogin,$url);
				break;
			case 5:
			loginAluno($idLogin,$url);
			break;
			default:
			session_destroy();
			header("locatio:../login.php");
		}
	}else{
		echo "Sem acesso";
	}
	/*FUNÇÃO QUE PERMITE LOGAR APENAS COMO ADMINISTRADOR GERAL*/
	function loginAdminGeral($idLogin,$url){
		try {
			$con = conectarBancoDados();
			$buscaDados = $con->prepare("SELECT * from adming join login on adming.login_idLogin= :id AND login.idLogin=:id join pessoa on adming.pessoa_idPessoa = pessoa.idPessoa ");
			$buscaDados->bindValue(":id",$idLogin);
			$buscaDados->execute();
			if($buscaDados->rowCount()>0){
				$dadosAdminG = $buscaDados->fetch(PDO::FETCH_ASSOC);
				$_SESSION["idUsuario"]	= $dadosAdminG["idAdminG"];
				$_SESSION["tipoUsuario"]= $dadosAdminG["tipoUsuario"];
				$_SESSION["Nome"] 		= $dadosAdminG["NomePessoa"];
				$_SESSION["Sexo"] 		= $dadosAdminG["Sexo"];
				$_SESSION["Nascimento"] = $dadosAdminG["Nascimento"];
			
				$_SESSION["foto"] = $dadosAdminG["NomeImagem"];
				 AnoLetivo();
				header("location:".$url);
			}else{
				header("location:../");
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO QUE PERMITE LOGAR APENAS COMO ADMINISTRADOR ADMINISTRATIVO*/
	function loginAdminAdministrativo($idLogin,$url){
		try {
			$con = conectarBancoDados();
			$buscaDados = $con->prepare("SELECT * FROM `admina`JOIN `login` on admina.Login_idLogin= :id And login.idLogin = :id JOIN pessoa on pessoa.idPessoa = admina.pessoa_idPessoa JOIN `departamento` ON departamento.idDeparta=admina.idDeparta");
			$buscaDados->bindValue(":id",$idLogin);
			$buscaDados->execute();
			if($buscaDados->rowCount()>0){
				$dadosAdminG = $buscaDados->fetch(PDO::FETCH_ASSOC);
				$_SESSION["idUsuario"]	= $dadosAdminG["idAdminA"];
				$_SESSION["tipoUsuario"]= $dadosAdminG["tipoUsuario"];
				$_SESSION["Nome"] 		= $dadosAdminG["NomePessoa"];
				$_SESSION["Sexo"] 		= $dadosAdminG["Sexo"];
				$_SESSION["Nascimento"] = $dadosAdminG["Nascimento"];
				$_SESSION["idDeparta"] 	= $dadosAdminG["idDeparta"];
				$_SESSION["NomeDeparta"] = $dadosAdminG["NomeDeparta"];
				$_SESSION["foto"] = $dadosAdminG["NomeImagem"];
				 AnoLetivo();
				header("location:".$url);
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO QUE PERMITE LOGAR APENAS COMO SECRETÁRIO*/
	function loginSecretario($idLogin,$url){
		try {
			$con = conectarBancoDados();
			$buscaDados = $con->prepare("SELECT * FROM `secretario`JOIN `login` on secretario.Login_idLogin= :id AND login.idLogin = :id JOIN pessoa on pessoa.idPessoa = secretario.pessoa_idPessoa join departamento on departamento.idDeparta = secretario.idDeparta");
			$buscaDados->bindValue(":id",$idLogin);
			$buscaDados->execute();
			if($buscaDados->rowCount()>0){
				$dadosAdminG = $buscaDados->fetch(PDO::FETCH_ASSOC);
				print_r($dadosAdminG);
				
				$_SESSION["idUsuario"]	= $dadosAdminG["idSecretario"];
				$_SESSION["tipoUsuario"]= $dadosAdminG["tipoUsuario"];
				$_SESSION["Nome"] 		= $dadosAdminG["NomePessoa"];
				$_SESSION["Sexo"] 		= $dadosAdminG["Sexo"];
				$_SESSION["Nascimento"] = $dadosAdminG["Nascimento"];
				$_SESSION["idDeparta"] 	= $dadosAdminG["idDeparta"];
				$_SESSION["NomeDeparta"]= $dadosAdminG["NomeDeparta"];
				$_SESSION["foto"] = $dadosAdminG["NomeImagem"];
				 AnoLetivo();
				header("location:".$url);
			}else{
				header("location:../erro/?");
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO QUE PERMITE LOGAR APENAS COMO PROFESSOR*/
	function loginProfessor($idLogin,$url){
		try {
			$con = conectarBancoDados();
			$buscaDados = $con->prepare("SELECT * FROM professor join login on professor.login_idLogin= :id And login.idLogin=:id join pessoa ON professor.pessoa_idPessoa=pessoa.idPessoa JOIN departamento ON professor.idDeparta = departamento.idDeparta");
			$buscaDados->bindValue(":id",$idLogin);
			$buscaDados->execute();
			if($buscaDados->rowCount()>0){
				$dadosAdminG = $buscaDados->fetch(PDO::FETCH_ASSOC);
				print_r($dadosAdminG);
				$_SESSION["idUsuario"]	= $dadosAdminG["idProfessor"];
				$_SESSION["tipoUsuario"]= $dadosAdminG["tipoUsuario"];
				$_SESSION["Nome"] 		= $dadosAdminG["NomePessoa"];
				$_SESSION["Sexo"] 		= $dadosAdminG["Sexo"];
				$_SESSION["Nascimento"] = $dadosAdminG["Nascimento"];
				$_SESSION["idDeparta"] 	= $dadosAdminG["idDeparta"];
				$_SESSION["NomeDeparta"]= $dadosAdminG["NomeDeparta"];
				 AnoLetivo();
				header("location:".$url);
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}
	/*FUNÇÃO QUE PERMITE LOGAR APENAS COMO ALUNO*/
	function loginAluno($idLogin,$url){
		try {
			$con = conectarBancoDados();
			$buscaDados = $con->prepare("SELECT * FROM aluno JOIN login ON aluno.login_idLogin = :id AND login.idLogin = :id JOIN pessoa ON aluno.pessoa_idPessoa=pessoa.idPessoa JOIN departamento ON aluno.idDeparta = departamento.idDeparta");
			$buscaDados->bindValue(":id",$idLogin);
			$buscaDados->execute();
			if($buscaDados->rowCount()>0){
				$dadosAdminG = $buscaDados->fetch(PDO::FETCH_ASSOC);
				$_SESSION["idUsuario"]	= $dadosAdminG["idAluno"];
				$_SESSION["tipoUsuario"]= $dadosAdminG["tipoUsuario"];
				$_SESSION["Nome"] 		= $dadosAdminG["NomePessoa"];
				$_SESSION["Sexo"] 		= $dadosAdminG["Sexo"];
				$_SESSION["Nascimento"] = $dadosAdminG["Nascimento"];
				$_SESSION["idDeparta"] 	= $dadosAdminG["idDeparta"];
				$_SESSION["NomeDeparta"]= $dadosAdminG["NomeDeparta"];
				 AnoLetivo();
				header("location:".$url);
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	
	}	
	/*FUNÇÃO QUE BUSCA ANO LETIVO ATUAL*/
	function AnoLetivo(){
			$ativo = 1;
		try {
			$con = conectarBancoDados();
			$buscaDados = $con->prepare("SELECT * FROM ano_letivo WHERE AnoAtivo = ?");
			$buscaDados->bindValue(1,$ativo);
			$buscaDados->execute();

			if($buscaDados->rowCount()>0){
				$anoLetivo = $buscaDados->fetch(PDO::FETCH_ASSOC);
			$_SESSION["idAnoLetivo"]	= $anoLetivo["idAno_letivo"];
			return $anoLetivo;
			}
		} catch (Exception $e) {
			echo "Erro ".$e->getMessage();
		}
	}								

 ?>