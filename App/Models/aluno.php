<?php
require_once "connection.php";
date_default_timezone_set("Etc/GMT-1");

  /*FUNÇÃO PARA CADASTRA O ALUNO*/
  function  cadastraAluno(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$idDeparta,$idCurso,$idUsuario
      ,$encarregado,$anoLetivo,$anoEscolar,$nomeTurma,$permissao){
         $con    = conectarBancoDados();
       
    try {
      /*CÓDIGO PARA CADASTRAR O ALUNO NA TABELA PESSOA*/
        $cadastra  =  $con->prepare("INSERT INTO pessoa(idPessoa,NomePessoa,Sexo,Nascimento) VALUE(DEFAULT,?,?,?)") ;
        $cadastra->bindValue(1,$nome);
        $cadastra->bindValue(2,$sexo);
        $cadastra->bindValue(3,$nascimento);
        $cadastra->execute();
        if( $cadastra->rowCount()==1){
            $idPessoa =  $con->lastInsertId();
        }
        /*CÓDIGO PARA CADASTRAR O ALUNO NA TABELA ENSEREÇO*/
        if(isset($idPessoa) && $idPessoa!=0){
          $cadastraE    = $con->prepare("INSERT INTO endereco VALUE(DEFAULT,?,?,?,?)");
          $cadastraE->bindValue(1,$provincia);
          $cadastraE->bindValue(2,$municipio);
          $cadastraE->bindValue(3,$bairro);
          $cadastraE->bindValue(4,$idPessoa);
          $cadastraE->execute();
          if($cadastraE->rowCount()==1){
            $endereco = true;
          }
        }
        /*CÓDIGO PARA CADASTRAR O ALUNO NA TABELA CONTATO*/
        if(isset($idPessoa) && isset($endereco)){
            $cadastraC = $con->prepare("INSERT INTO contato VALUE(DEFAULT,?,?,?)");
            $cadastraC->bindValue(1,$telefone);
            $cadastraC->bindValue(2,$email);
            $cadastraC->bindValue(3,$idPessoa);
            $cadastraC->execute();
            if($cadastraC->rowCount()==1){
              $contato = true;
            }
        }
       /*CÓDIGO PARA CADASTRAR O ENCARREGADO DO ALUNO NA TABELA ENCARREGADO*/
        $cadastraEn  =  $con->prepare("INSERT INTO `encarregado` VALUE(DEFAULT,?)") ;
        $cadastraEn->bindValue(1,$encarregado);
        $cadastraEn->execute();
        if( $cadastraEn->rowCount()==1){
            $idEncarregado =  $con->lastInsertId();
        }
         /*CÓDIGO PARA CADASTRAR O ANO LETIVO E DATA DE REGISTRO DO ALUNO NA TABELA ANOLETIVO*/
        $registro = date("Y-m-d H-i-s");
        $cadastraEn  =  $con->prepare("INSERT INTO `anoletivo` VALUE(DEFAULT,?,?)") ;
        $cadastraEn->bindValue(1,$anoLetivo);
        $cadastraEn->bindValue(2,$registro);
        $cadastraEn->execute();
        if( $cadastraEn->rowCount()==1){
            $idRegistro =  $con->lastInsertId();
        }
         /*CÓDIGO PARA CADASTRAR FOTO NA TABELA IMAGEM*/
         if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/aluno/imagem/";
            $largura = 200;
            if(!verificaTamnho($tmp_name,$largura)){
                redimecionaFoto($tmp_name,$largura,$extensao,$destino,$nomeFoto);
              
            }else{
              if(verificaExtensaoParaCopiaFoto($extensao,$dadosFoto,$destino,$nomeFoto)){
                $nomeFoto; 
              }else{
                $nomeFoto=null;
              }     
            }
          }else{
              $nomeFoto=null;
          }
        }else{
             $nomeFoto=null;
        }
        /*CÓDIGO PARA CADASTRAR ALUNO NA TABELA ALUNO*/
        if(isset($idPessoa) && isset($idRegistro) && isset($idEncarregado)){
          $ativo = 1;
          $cadastraProfe  = $con->prepare("INSERT INTO `aluno` (`idAluno`, `pessoa_idPessoa`, `curso_idCurso`, `usuario_udUsuario`, `idDeparta`, `dataRegistro`, `encarregado_id`, `Aluno_Ativo`, `NomeImagem`, `aluno_idAnoEscolar`, `aluno_idTurma`, `anoletivo_idAno`) 
          VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
          $cadastraProfe->bindValue(1,$idPessoa);
          $cadastraProfe->bindValue(2,$idCurso);
          $cadastraProfe->bindValue(3,$idUsuario);
          $cadastraProfe->bindValue(4,$idDeparta);
          $cadastraProfe->bindValue(5,$idRegistro);
          $cadastraProfe->bindValue(6,$idEncarregado);
          $cadastraProfe->bindValue(7,$ativo);
          $cadastraProfe->bindValue(8,$nomeFoto);
          $cadastraProfe->bindValue(9,$anoEscolar);
          $cadastraProfe->bindValue(10,$nomeTurma);
          $cadastraProfe->bindValue(11,$anoLetivo);
          $cadastraProfe->execute();
          
               $urlAtivo = "AdminA";
          if($cadastraProfe->rowCount()==1){
              header("location:../../views/".$urlAtivo."/curso/index.php?alert=1");
          }else{
             header("location:../../views/".$urlAtivo."/curso/index.php?alert=0");
          }
        }
        
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }
  /*FUNÇÃO PARA CADASTRA O ALUNO*/
  function  atualizaAluno( 
     $idP,$nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$idDeparta,$idCurso,$idUsuario
      ,$encarregado,$anoLetivo,$permissao,$idEnca,$nomeEnca,$anoEscolar,$idTurma,
  $imagem){
         $con    = conectarBancoDados();
       
    try {
       /*CÓDIGO PARA ATUALIZAR NOEME SEXO E NASCIMENTO DO Aluno*/
      $atualizarP = $con->prepare("UPDATE pessoa SET NomePessoa = ?,Sexo = ?,Nascimento = ?  WHERE idPessoa = ?");
      $atualizarP->bindValue(1,$nome);
      $atualizarP->bindValue(2,$sexo);
      $atualizarP->bindValue(3,$nascimento);
      $atualizarP->bindValue(4,$idP);
      $atualizarP->execute();
      
      /*CÓDIGO PARA ATUALIZAR NÚMERO  E EMAIL DO ALUNO*/
      $atualizarC = $con->prepare("UPDATE contato SET Telefone = ?,Email = ?  WHERE pessoa_idPessoa = ?");
      $atualizarC->bindValue(1,$telefone);
      $atualizarC->bindValue(2,$email);
      $atualizarC->bindValue(3,$idP);
      $atualizarC->execute();

      /*CÓDIGO PARA ATUALIZAR ENDEREÇO (CIDADE  MUNÍCIO e BAIRRO EMAIL DO ALUNO)*/
      $atualizarE = $con->prepare("UPDATE endereco SET Cidade = ?,Municipio = ?,Bairro = ?   WHERE pessoa_idPessoa= ?");
      $atualizarE->bindValue(1,$provincia);
      $atualizarE->bindValue(2,$municipio);
      $atualizarE->bindValue(3,$bairro);
      $atualizarE->bindValue(4,$idP);
      $atualizarE->execute();

      /*CÓDIGO PARA ATUALIZAR NOME  DE ENCARREGADO DO ALUNO*/
      $atualizarEnca = $con->prepare("UPDATE encarregado SET NomeEncarregado = ?   WHERE idEncarregado = ?");
      $atualizarEnca->bindValue(1,$nomeEnca);
      $atualizarEnca->bindValue(2,$idEnca);
      $atualizarEnca->execute();

         /*CÓDIGO PARA TRATAR FOTO PARA SER ATUALIZADO */
        if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/aluno/imagem/";
            $largura = 200;
            if(!verificaTamnho($tmp_name,$largura)){
                redimecionaFoto($tmp_name,$largura,$extensao,$destino,$nomeFoto);
              
            }else{
              if(verificaExtensaoParaCopiaFoto($extensao,$dadosFoto,$destino,$nomeFoto)){
                $nomeFoto; 
              }else{
                $nomeFoto=null;
              }     
            }
          }else{
              $nomeFoto=null;
          }
        }elseif($imagem != null){
             $nomeFoto= $imagem;
        }else{
          $nomeFoto = null;
        }
        
        /*CÓDIGO PARA ATUAZIAR ALUNO NA TABELA ALUNO*/
        
          $atualizarAluno  = $con->prepare("UPDATE  aluno SET NomeImagem = ?,aluno_idAnoEscolar =?, aluno_idTurma = ? WHERE pessoa_idPessoa = ?  ");
          $atualizarAluno->bindValue(1,$nomeFoto);
          $atualizarAluno->bindValue(2,$anoEscolar);
          $atualizarAluno->bindValue(3,$idTurma);
          $atualizarAluno->bindValue(4,$idP);
          $atualizarAluno->execute();
           if($permissao==3){
              $urlAtivo = "secretario";
            }elseif($permissao==2){
               $urlAtivo = "AdminA";
            }
          
              header("location:../../views/".$urlAtivo."/curso/index.php?alert=1");
        
        
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }

  /*FUNÇÃO QUE RETORNA TODOS ALUNOS QUE FAZEM PARTE DO MESMO CURSO, ASSIM PASSANDO ID DO CURSO*/
  function listaAlunoCurso($idCurso,$public,$anoLetivo){
  	$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM aluno JOIN pessoa  ON aluno.pessoa_idPessoa = pessoa.idPessoa 
      JOIN contato ON contato.pessoa_idPessoa=pessoa.idPessoa JOIN endereco ON endereco.pessoa_idPessoa = pessoa.idPessoa
      JOIN encarregado ON aluno.encarregado_id =encarregado.idEncarregado JOIN curso ON aluno.curso_idCurso = curso.idCurso 
      JOIN anoletivo ON aluno.dataRegistro =anoletivo.idAnoLetivo INNER JOIN ano_letivo ON ano_letivo.idAno_letivo = aluno.anoletivo_idAno  WHERE aluno.curso_idCurso = ? && aluno.Aluno_Ativo = ? && aluno.anoletivo_idAno = ? ");
      $listar->bindValue(1,$idCurso);
      $listar->bindValue(2,$public);
      $listar->bindValue(3,$anoLetivo);
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
/*FUNÇÃO QUE RETORNA TODOS ALUNOS QUE FAZEM PARTE DO MESMO CURSO E MESMA TURMA, ASSIM PASSANDO ID DO CURSO*/
  function listaAlunoTurma($idCurso,$idTurma,$idAnoEscolar,$public,$anoLetivo){
  	$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM aluno JOIN pessoa  ON aluno.pessoa_idPessoa = pessoa.idPessoa 
      JOIN contato ON contato.pessoa_idPessoa=pessoa.idPessoa JOIN endereco ON endereco.pessoa_idPessoa = pessoa.idPessoa
      JOIN encarregado ON aluno.encarregado_id =encarregado.idEncarregado JOIN curso ON aluno.curso_idCurso = curso.idCurso 
      JOIN anoletivo ON aluno.dataRegistro =anoletivo.idAnoLetivo INNER JOIN ano_letivo ON ano_letivo.idAno_letivo = aluno.anoletivo_idAno 
      INNER JOIN turma ON turma.idTurma = aluno.aluno_idTurma  WHERE aluno.curso_idCurso = ? && aluno.aluno_idTurma= ? && aluno_idAnoEscolar = ? && aluno.Aluno_Ativo = ? && aluno.anoletivo_idAno = ?
      ORDER BY pessoa.NomePessoa ");
      $listar->bindValue(1,$idCurso);
      $listar->bindValue(2,$idTurma);
      $listar->bindValue(3,$idAnoEscolar);
      $listar->bindValue(4,$public);
      $listar->bindValue(5,$anoLetivo);
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


/*LISTAR DADOS DE UM  ALUNO PASSANDO ID DO ALUNO*/
function listaDadosAluno($idAluno){
  	$con = conectarBancoDados();
		try {
			$listar = $con->prepare("SELECT * FROM aluno JOIN pessoa  ON aluno.pessoa_idPessoa = pessoa.idPessoa 
      JOIN contato ON contato.pessoa_idPessoa=pessoa.idPessoa JOIN endereco ON endereco.pessoa_idPessoa = pessoa.idPessoa
      JOIN encarregado ON aluno.encarregado_id =encarregado.idEncarregado JOIN curso ON aluno.curso_idCurso = curso.idCurso 
      JOIN anoletivo ON aluno.dataRegistro =anoletivo.idAnoLetivo INNER JOIN ano_letivo ON ano_letivo.idAno_letivo = aluno.anoletivo_idAno 
      INNER JOIN turma ON turma.idTurma = aluno.aluno_idTurma JOIN anosescolares ON anosescolares.idAnosEscolares = aluno.aluno_idAnoEscolar WHERE aluno.idAluno = ? LIMIT 1");
      $listar->bindValue(1,$idAluno);
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

/*FUNÇÃO QUE RETORNA A QUANTIDADE DE ALUNO QUE PERTECEM A UMA DETERMINADA TURMA*/
function turmaAluno(array $dados){
  	$con = conectarBancoDados();
  try{
    $contar = $con->prepare("SELECT * FROM aluno WHERE 	aluno_idTurma  = ? && `curso_idCurso`= ? && `aluno_idAnoEscolar` = ? && anoletivo_idAno = ? && `idDeparta`= ? && `Aluno_Ativo`= ?");
      foreach ($dados as $k => $v) {
         $contar->bindValue($k,$v);
      }
    $contar->execute();
    if($contar->rowCount()>0){
      return $contar->rowCount();
    }else{
      return 0;
    }
  }catch(Exception $e){
    echo "Erro ".$e->getMessage();
  }
}
//FUNÇÃO PARA ATIVAR E DESATIVAR ALUNO
  function ativAluno($id,$value,$permissoa){
     $con    = conectarBancoDados();
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        echo $v;
        if($permissoa == 1){
         $urlAtivo = 'adminG'; 
        }else if($permissoa == 2){
           $urlAtivo = 'adminA';
        }
        $ativa =  $con->prepare("UPDATE aluno  SET Aluno_Ativo = ? WHERE idAluno = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
        $ativa->execute();
        if($ativa->rowCount()==1){
         header("location:../../".$urlAtivo."/turma/?alert=1");
        }else {
         header("location:../../".$urlAtivo."/turma/?alert=0");
        }
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }

  
/*VERIFICA O TIPO DE EXTENSÃO PARA FAZER O COPIAR A IMAGEM NA PASTA DE IMNAGEM */
  function verificaExtensaoParaCopiaFoto($extensao,$novaFoto,$destino,$nomeFoto){
    try {
       $permitido = array("jpg","jpeg","png","gif");
      if(in_array($extensao,$permitido)){
        switch($extensao){
            case "jpeg":
            case "jpg":
                imagejpeg($novaFoto,$destino.$nomeFoto);
                return true;
              break;
            case "png":
              imagepng($novaFoto,$destino.$nomeFoto);
              return true;
            break;
            case "gif":
                imagegif($novaFoto,$destino.$nomeFoto);
                return true;
                break;
            default:
                return null;
        }
      }
    } catch (PDOException $e) {
     echo "Erro ".$e->getMessage();
    }
  }
   function redimecionaFoto($tempoario,$largura,$extensao,$destino,$nomeFoto){
    try {
      $dadosFoto = verificaExtensao($extensao,$tempoario);

      $x = imagesx($dadosFoto);
      $y = imagesy($dadosFoto);
      
      /*CALCULAR ALTUARA ADEQUADA PARA O LARGURA PASSADA*/
      $height = ($largura / $x) * $y;
      $novaFoto = imagecreatetruecolor($largura,$height);
      imagecopyresampled($novaFoto,$dadosFoto,0,0,0,0,$largura,$height,$x,$y);
      verificaExtensaoParaCopiaFoto($extensao,$novaFoto,$destino,$nomeFoto);
      
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }




  /*VERIFICA O TIPO DE EXTENSÃO DE IMAGEM*/
  function verificaExtensao($extensao,$temporario){
    try {
     switch($extensao){
        case "jpeg":
        case "jpg":
          return imagecreatefromjpeg($temporario);
          break;
        case "png":
          return imagecreatefrompng($temporario);
         break;
        case "gif":
            return imagecreatefromgif($temporario); 
            break;
        default:
            return null;
     }
    } catch (PDOException $e) {
     echo "Erro ".$e->getMessage();
    }
  }
/*VERIFICA O TAMNHO DA  IMNAGEM */
  function verificaTamnho($temporario,$largura){
    try {
      $dadosFoto  = getimagesize($temporario);
      list($w) = $dadosFoto;
     if($w<=$largura){
        return true;
     }else{
       return false;
     }
    } catch (PDOException $e) {
     echo "Erro ".$e->getMessage();
    }
  }
?>