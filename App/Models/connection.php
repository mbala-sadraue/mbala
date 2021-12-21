<?php
/*INICIO AO PHP 03 de NOVEMBRO de 2020*/
	/*CONECTAR AO BANCO DE DADOS*/
  define("HOST","localhost");
	define("USER","root");
	define("PASS","");
	define("BD","controlescola");
	function conectarBancoDados(){
		
		try{
			$dns 			= "mysql:host=".HOST.";dbname=".BD;
			$conectar = new PDO($dns,USER,PASS);
		//
			$conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if($conectar){
				return $conectar;
			}else{
				return fasle;
			}
		}catch(PDOException $e){
			$error = $e->getCode();
			switch($error){
				/*CASO O CÓDICO FOI 2002 QUER DIZER O SERVIDOR NÃO ESTA ESTARTADO (LIGADO)*/
					 case 2002:
						echo'<script>window.location="http://anuarite.com/Erro/?erro=1"</script>';
						break;
						case 1049:
						echo "Esta informação não existe no banco de dados ";
						exit();
						break;

						default:
						echo"Contacta o programador 935-378-674/ 994-409-773";
						exit();
			}
		}
	}
?>