<?php 
session_start();
$url = "http://anuarite.com/";

	if(isset($_POST["login"]) && $_POST["login"]=="logar"){
			if(isset($_POST["usuario"]) && isset($_POST["senha"])){
					$usuarioLogin = $_POST["usuario"];
					$senhaLogin		= sha1($_POST["senha"]);
					$mostraSenha		= $_POST["senha"];
					logar($usuarioLogin,$senhaLogin,$mostraSenha);
		}
	}else{
		echo "Erro ao logar";
	}
	function logar($usuario,$senha,$mostraSenha){
		require_once"Models/connection.php";
		try{
			if(conectarBancoDados()){
				$con = conectarBancoDados();
				$logar	= $con->prepare("SELECT * FROM login WHERE  Usuario = ? AND  Senha = ?");
				$logar->bindValue(1,$usuario);
				$logar->bindValue(2,$senha);
				$logar->execute();
				if($logar->rowCount()==1){
					$dadosLogin = $logar->fetch(PDO::FETCH_ASSOC);
					$_SESSION["idLogin"]	= $dadosLogin["idLogin"];
					$_SESSION["perm"]			=	$dadosLogin["tipoUsuario"];
					header("location:../".$url."config/configLogin.php");	
				}
					else{
				echo "O usuario: <strong>$usuario </strong>Ou senha: <strong>$mostraSenha</strong> não coresponde a uma conta no sistema ";
				}
			}
		
		
		}catch(Exception $e){
			echo "Erro ".$e->getMessage();
		}
	}
 ?>