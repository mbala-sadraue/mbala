<?php
require_once "connection.php";
/**
*FUNÇÃO PARA CADASTRA ANO LETIVO
*/
  function cadastraAnoLetivo($nomeAnoLetivo,$permissao){
     $registro = date("Y-m-d H-i-s");
     $ativo = 1;
     $value = 0;
    try {
        $con    = conectarBancoDados();
        /*FUNÇÃO QUE DESATIVA DOS ANOS LETIVO*/
        $atualizar= $con->prepare("UPDATE ano_letivo SET AnoAtivo = ? WHERE  AnoAtivo= ? ");
        $atualizar->bindValue(1,$value);
        $atualizar->bindValue(2,$ativo);
        $atualizar->execute();

        $cadastra = $con->prepare("INSERT INTO ano_letivo VALUE(DEFAULT,?,?,?)");
        $cadastra->bindValue(1,$nomeAnoLetivo);
        $cadastra->bindValue(2,$ativo);
        $cadastra->bindValue(3,$registro);
        $cadastra->execute();
       if($permissao == 1){
					$url = "adminG";
				}else{
					$url = "adminA";
				}
			if($cadastra->rowCount()==1){
				header("location:../../views/".$url."/anoletivo/?alert=1");
			}else{
				header("location:../../views/".$url."/anoletivo/?alert=0");
			}

        
    } catch (PDOException $e) {
      
      echo"Erro ".$e->getMessage();
      
    }
    /**
*FUNÇÃO PARA LISTAR ANO LETIVO
*/

  }



function listaAnoLetivo(){
   try {
        $con    = conectarBancoDados();
      
    $listar = $con->prepare("SELECT * FROM `ano_letivo`");
    $listar->execute();
    if($listar->rowCount()>0){
      $dados = $listar->fetchAll(PDO::FETCH_OBJ);
      return $dados;

    }else{
      return 0;
    }

        
    } catch (PDOException $e) {
      
      echo"Erro ".$e->getMessage();
      
    }
}


?>