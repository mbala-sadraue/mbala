<?php
  require_once "connection.php";
  require_once "fotos.php";
  /*FUNÇÂO PARA CADASTRA O ADIMINISTRADOR ADIMINISTRATIVA*/
   function cadastraAdministrativa($nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario){
      $con    = conectarBancoDados();
        $ativo = 1;
    try{
      /*CÓDIGO PARA CADASTRAR O ADMINISTRADOR ADMINISTRATIVA NA TABELA PESSOA*/
        $cadastra  =  $con->prepare("INSERT INTO pessoa(idPessoa,NomePessoa,Sexo,Nascimento) VALUE(DEFAULT,?,?,?)") ;
        $cadastra->bindValue(1,$nome);
        $cadastra->bindValue(2,$sexo);
        $cadastra->bindValue(3,$nascimento);
        $cadastra->execute();
        if( $cadastra->rowCount()==1){
            $idPessoa =  $con->lastInsertId();
        }
        /*CÓDIGO PARA CADASTRAR O ADMINISTRADOR ADMINISTRATIVA NA TABELA ENSEREÇO*/
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
        /*CÓDIGO PARA CADASTRAR O ADMINISTRADOR ADMINISTRATIVA NA TABELA CONTATO*/
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
          /*CÓDIGO PARA CADASTRAR O ADMINISTRADOR ADMINISTRATIVA NA TABELA LOGIN*/
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
        
     /* $atualizaL  = $con->prepare("UPDATE `login` SET Usuario = ? , Senha = ? WHERE idLogin = ?");
      $atualizaL->bindValue(1,$usuario);
      $atualizaL->bindValue(2,$senha);
      $atualizaL->bindValue(3,$idLogin);
      $atualizaL->execute();*/

      /*CÓDIGO PARA TRATAR FOTO PARA SER ATUALIZADO */
        if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/adminA/imagem/";
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
        /*CÓDIGO PARA CADASTRAR O ADMINISTRADOR ADMINISTRATIVA NA TABELA ADMINISTRADOR ADMINIDTRATIVA*/
      
        if(isset($idPessoa) && isset($idLogin)){
          $cadastraAdmin  = $con->prepare("INSERT INTO admina VALUE(DEFAULT,?,?,?,?,?,?)");
          $cadastraAdmin->bindValue(1,$idLogin);
          $cadastraAdmin->bindValue(2,$idPessoa);
          $cadastraAdmin->bindValue(3,$ativo);
          $cadastraAdmin->bindValue(4,$idDeparta);
          $cadastraAdmin->bindValue(5,$idUsuario);
          $cadastraAdmin->bindValue(6,$nomeFoto);
          $cadastraAdmin->execute();
            echo " $idLogin $idPessoa $ativo $idDeparta $idUsuario";
          if($cadastraAdmin->rowCount()==1){
              header("location:../../views/adminG/admina/index.php?alert=1");
          }else{
             header("location:../../views/adminG/admina/index.php?alert=0");
          }
        }else{
          header("location:../../views/adminG/admina/index.php?alert=00");
        }
    }catch(PDOException $e){
      echo "Erro ".$e->getMessage();
    }
  }

  /*FUNÇÂO PARA LISTRA ADMINISTRADOR ADMINISTRATIVA*/
  function listaAdministrativa($public){
      $con    = conectarBancoDados();
    try {
      $lista = $con->prepare("SELECT * from admina join pessoa on admina.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa join contato on pessoa.idPessoa = contato.pessoa_idPessoa 
      join departamento on admina.idDeparta = departamento.idDeparta WHERE admina.admina_Ativo = ?");
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

  /*FUNÇÃO PARA RETORNAR OS DADOS DE ADMINISTRADOR ADMINISTRATIVA PARA SER EDITA*/
  function buscaDadosAdministrativa($id){
      $con    = conectarBancoDados();
    try {
      $busca  = $con->prepare("SELECT * from admina JOIN pessoa ON admina.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa JOIN contato ON pessoa.idPessoa = contato.pessoa_idPessoa 
      join departamento on admina.idDeparta = departamento.idDeparta JOIN  login ON admina.Login_idLogin = login.idLogin WHERE admina.idAdminA = ?");
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
  function atualizaAdministrativa( $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$perm,$idDeparta,$idUsuario
      ,$idP){
     $con    = conectarBancoDados();
    try {
      /*CÓDIGO PARA ATUALIZAR $NOEME SEXO E NASCIMENTO DE ADMINISTRATIVA*/
      $atualizarP = $con->prepare("UPDATE pessoa SET NomePessoa = ?,Sexo = ?,Nascimento = ?  WHERE idPessoa = ?");
      $atualizarP->bindValue(1,$nome);
      $atualizarP->bindValue(2,$sexo);
      $atualizarP->bindValue(3,$nascimento);
      $atualizarP->bindValue(4,$idP);
      $atualizarP->execute();
      
      /*CÓDIGO PARA ATUALIZAR NÚMERO  E EMAIL DE ADMINISTRATIVA*/
      $atualizarC = $con->prepare("UPDATE contato SET Telefone = ?,Email = ?  WHERE pessoa_idPessoa = ?");
      $atualizarC->bindValue(1,$telefone);
      $atualizarC->bindValue(2,$email);
      $atualizarC->bindValue(3,$idP);
      $atualizarC->execute();

      /*CÓDIGO PARA ATUALIZAR ENDEREÇO (CIDADE  MUNÍCIO e BAIRRO EMAIL DE ADMINISTRATIVA)*/
      $atualizarE = $con->prepare("UPDATE endereco SET Cidade = ?,Municipio = ?,Bairro = ?   WHERE pessoa_idPessoa= ?");
      $atualizarE->bindValue(1,$provincia);
      $atualizarE->bindValue(2,$municipio);
      $atualizarE->bindValue(3,$bairro);
      $atualizarE->bindValue(4,$idP);
      $atualizarE->execute();

      /*CÓDIGO PARA TRATAR FOTO PARA SER ATUALIZADO */
        if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/adminA/imagem/";
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

      /*CÓDIGO PARA ATUALIZAR DEPARTAMNETO (ID_DEPARTA) E IMAGEM*/
      $atualizarD = $con->prepare("UPDATE admina SET idDeparta = ?,NomeImagem = ? WHERE pessoa_idPessoa= ?");
      $atualizarD->bindValue(1,$idDeparta);
      $atualizarD->bindValue(2,$nomeFoto);
      $atualizarD->bindValue(3,$idP);
      $atualizarD->execute();
      /*CÓDIGO PARA ATUALIZAR O LOGIN DO ADIMINSTRATIVA*/
      $buscaIdLogin = $con->prepare("SELECT * FROM  admina WHERE pessoa_idPessoa = ?");
      $buscaIdLogin->bindValue(1,$idP);
      $buscaIdLogin->execute();
      if($buscaIdLogin->rowCount()==1){
        $dados = $buscaIdLogin->fetch(PDO::FETCH_ASSOC);
        $idLogin = $dados["Login_idLogin"];
      }else{
        echo "Erro";
        exit;
      }
      
      
      header("location:../../views/adminG/admina/?alert=1");
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }
  //FUNÇÃO PARA ATIVAR E DESATIVAR ADMINISTRATIVA
  function ativaAdminidtrativa($id,$value){
     $con    = conectarBancoDados();
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        $ativa =  $con->prepare("UPDATE admina  SET admina_Ativo = ? WHERE idAdminA = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
        $ativa->execute();
        if($ativa->rowCount()==1){
            header("location:../../adminG/admina/?alert=1");
        }else {
            header("location:../../adminG/admina/?alert=0");
          
        }
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }

  
?>