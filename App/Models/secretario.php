<?php

//require_once "fotos.php";
 require_once "connection.php";
 date_default_timezone_set("Etc/GMT-1");
  /*FUNÇÂO PARA CADASTRA SECRETÁRIO */
   function cadastraSecretario($nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario,$permissoa){
      $con    = conectarBancoDados();
    try{
      /*CÓDIGO PARA CADASTRAR FOTO NA TABELA IMAGEM*/
         if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/secretario/imagem/";
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
      
      /*CÓDIGO PARA CADASTRAR SECRETÁTIO NA TABELA PESSOA*/
        $cadastra  =  $con->prepare("INSERT INTO pessoa(idPessoa,NomePessoa,Sexo,Nascimento) VALUE(DEFAULT,?,?,?)") ;
        $cadastra->bindValue(1,$nome);
        $cadastra->bindValue(2,$sexo);
        $cadastra->bindValue(3,$nascimento);
        $cadastra->execute();
        if( $cadastra->rowCount()==1){
            $idPessoa =  $con->lastInsertId();
        }
        /*CÓDIGO PARA CADASTRAR SECRETÁTIO NA TABELA ENSEREÇO*/
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
        /*CÓDIGO PARA CADASTRAR SECRETÁTIO NA TABELA CONTATO*/
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
          /*CÓDIGO PARA CADASTRAR SECRETÁTIO NA TABELA LOGIN*/
        if(isset($idPessoa) && isset($endereco)){
          $cadastraL = $con->prepare("INSERT INTO `login`(idLogin,Usuario,Senha,tipoUsuario) VALUE(DEFAULT,?,?,?)");
          $cadastraL->bindValue(1,$usuario);
          $cadastraL->bindValue(2,$senha);
          $cadastraL->bindValue(3,$perm);
          $cadastraL->execute();
          if($cadastraL->roWCount()==1){
            $idLogin = $con->lastInsertId();
          }
        }
        /*CÓDIGO PARA CADASTRAR  SECRETÁTIO NA TABELA SECRETÁTIO*/
        
        if(isset($idPessoa) && isset($idLogin)){
          $ativo = 1;
          $cadastraAdmin  = $con->prepare("INSERT INTO secretario VALUE(DEFAULT,?,?,?,?,?,?)");
          $cadastraAdmin->bindValue(1,$idPessoa);
          $cadastraAdmin->bindValue(2,$ativo);
          $cadastraAdmin->bindValue(3,$idLogin);
          $cadastraAdmin->bindValue(4,$idDeparta);
          $cadastraAdmin->bindValue(5,$idUsuario);
          $cadastraAdmin->bindValue(6,$nomeFoto);
          $cadastraAdmin->execute();
          //echo "$perm $idDeparta $idUsuario $permissoa";
          if($permissoa == 1){
          $urlAtivo = 'adminG'; 
          }else if($permissoa == 2){
            $urlAtivo = 'adminA';
          }
          if($cadastraAdmin->rowCount()==1){
              header("location:../../views/".$urlAtivo."/secretario/index.php?alert=1");
          }else{
            header("location:../../views/".$urlAtivo."/secretario/index.php?alert=0");
          }
        }
    }catch(PDOException $e){
      echo "Erro ".$e->getMessage();
    }
  }


/*FUNÇÂO PARA LISTRA SECRÉTARIO*/
  function listaSecretario($public){
      $con    = conectarBancoDados();
    try {
      $lista = $con->prepare("SELECT * from secretario join pessoa on secretario.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa join contato on pessoa.idPessoa = contato.pessoa_idPessoa 
      join departamento on secretario.idDeparta = departamento.idDeparta WHERE secretario.secretario_Ativo = ?");
      $lista->bindValue(1,$public);
      $lista->execute();
      if($lista->rowCount()>0){
        $dados = $lista->fetchAll(PDO::FETCH_OBJ);
        return $dados;
      }else{
        return 0;
      }
    } catch (Exception $e){
      echo "Erro ".$e->getMessage();
    }
  }
   /*FUNÇÃO PARA RETORNAR OS DADOS DE SECRETÁRIO PARA SER EDITA*/
  function buscaDadosSecretario($id){
      $con    = conectarBancoDados();
    try {
      $busca  = $con->prepare("SELECT * from secretario JOIN pessoa ON secretario.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa JOIN contato ON pessoa.idPessoa = contato.pessoa_idPessoa 
      join departamento on secretario.idDeparta = departamento.idDeparta JOIN  login ON secretario.Login_idLogin = login.idLogin WHERE secretario.idSecretario = ?");
      $busca->bindValue(1,$id);
      $busca->execute();
      if($busca->rowCount()>0){
        $dados = $busca->fetchAll(PDO::FETCH_OBJ);
        return $dados;
      }else{
        return 0;
      }
    } catch (Exception $e) {
      echo "Erro ".$e->getMessage();
    }
  }
  /*FUNÇÃO PARA ATUALIZAR OS DADOS DE SECRETÁRIO*/
  function atualizaSecretario( $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      ,$idP,$permissoa,$imagem){
     $con    = conectarBancoDados();
    try {
      /*CÓDIGO PARA ATUALIZAR NOEME SEXO E NASCIMENTO DE SECRETARIO*/
      $atualizarP = $con->prepare("UPDATE pessoa SET NomePessoa = ?,Sexo = ?,Nascimento = ?  WHERE idPessoa = ?");
      $atualizarP->bindValue(1,$nome);
      $atualizarP->bindValue(2,$sexo);
      $atualizarP->bindValue(3,$nascimento);
      $atualizarP->bindValue(4,$idP);
      $atualizarP->execute();
      
      /*CÓDIGO PARA ATUALIZAR NÚMERO  E EMAIL DE SECRETARIO*/
      $atualizarC = $con->prepare("UPDATE contato SET Telefone = ?,Email = ?  WHERE pessoa_idPessoa = ?");
      $atualizarC->bindValue(1,$telefone);
      $atualizarC->bindValue(2,$email);
      $atualizarC->bindValue(3,$idP);
      $atualizarC->execute();

      /*CÓDIGO PARA ATUALIZAR ENDEREÇO (CIDADE  MUNÍCIO e BAIRRO EMAIL DE SECRETARIO)*/
      $atualizarE = $con->prepare("UPDATE endereco SET Cidade = ?,Municipio = ?,Bairro = ?   WHERE pessoa_idPessoa= ?");
      $atualizarE->bindValue(1,$provincia);
      $atualizarE->bindValue(2,$municipio);
      $atualizarE->bindValue(3,$bairro);
      $atualizarE->bindValue(4,$idP);
      $atualizarE->execute();

      /*CÓDIGO PARA ATUALIZAR DEPARTAMNETO (ID_DEPARTA) DE SECRETARIO*/
      $atualizarD = $con->prepare("UPDATE secretario SET idDeparta = ? WHERE pessoa_idPessoa= ?");
      $atualizarD->bindValue(1,$idDeparta);
      $atualizarD->bindValue(2,$idP);
      $atualizarD->execute();
      /*CÓDIGO PARA ATUALIZAR O LOGIN DE SECRETÁRIO*/
      $buscaIdLogin = $con->prepare("SELECT * FROM  secretario WHERE pessoa_idPessoa = ?");
      $buscaIdLogin->bindValue(1,$idP);
      $buscaIdLogin->execute();
      if($buscaIdLogin->rowCount()==1){
        $dados = $buscaIdLogin->fetch(PDO::FETCH_ASSOC);
        $idLogin = $dados["Login_idLogin"];
      }else{
        echo "Erro";
        exit;
      }
      /*CÓDIGO PARA TRATAR FOTO PARA SER ATUALIZADO */
        if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/secretario/imagem/";
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
        /*A TUALIZAR O SECRETÁRIO NA TABELA LOGIN*/
      $atualizaL  = $con->prepare("UPDATE `login` SET Usuario = ? , Senha = ? WHERE idLogin = ?");
      $atualizaL->bindValue(1,$usuario);
      $atualizaL->bindValue(2,$senha);
      $atualizaL->bindValue(3,$idLogin);
      $atualizaL->execute();

      $atualizaS  = $con->prepare("UPDATE `secretario` SET  NomeImagem = ?  WHERE pessoa_idPessoa = ?");
      $atualizaS->bindValue(1,$nomeFoto);
      $atualizaS->bindValue(2,$idP);
      $atualizaS->execute();
      /*VERIFICA A PERMISSÃO DE ADMINISTRADOR*/
      if($permissoa == 1){
         $urlAtivo = 'adminG'; 
        }else if($permissoa == 2){
           $urlAtivo = 'adminA';
        }elseif($permissoa==3){
          $urlAtivo = 'secretario';
        }
        
      header("location:../../views/".$urlAtivo."/secretario/?alert=1");
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }
//FUNÇÃO PARA ATIVAR E DESATIVAR SECRETARIO
  function ativaSecretario($id,$value,$permissoa){
     $con    = conectarBancoDados();
     echo $permissoa;
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        if($permissoa == 1){
         $urlAtivo = 'adminG'; 
        }else if($permissoa == 2){
           $urlAtivo = 'adminA';
        }
        $ativa =  $con->prepare("UPDATE secretario  SET secretario_Ativo = ? WHERE idSecretario = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
        $ativa->execute();
        echo $urlAtivo;
        if($ativa->rowCount()==1){
            header("location:../../".$urlAtivo."/secretario/?alert=1");
        }else {
        header("location:../../".$urlAtivo."/secretario/?alert=0");
        }
    } catch (PDOExeception $e) {
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