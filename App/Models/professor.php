<?php
  require_once "connection.php";
  //require_once "fotos.php";
  /*FUNÇÂO PARA CADASTRA O PROFESSOR*/
   function cadastraProfessor($nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario,$permissao){
      $con    = conectarBancoDados();
      
    try{
       /*CÓDIGO PARA CADASTRAR FOTO NA TABELA IMAGEM*/
         if( isset($_FILES["imagem"]) && $_FILES["imagem"]["name"]!=null){
          $tmp_name= $_FILES["imagem"]["tmp_name"]; 
          $extensao = pathinfo($_FILES["imagem"]["name"],PATHINFO_EXTENSION);
          
          
          if(verificaExtensao($extensao, $tmp_name)){ 
            $dadosFoto = verificaExtensao($extensao, $tmp_name);
            $nomeFoto = uniqid().".$extensao";
            $destino = "../../views/profe/imagem/";
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
      /*CÓDIGO PARA CADASTRAR O PROFESSOR NA TABELA PESSOA*/
        $cadastra  =  $con->prepare("INSERT INTO pessoa(idPessoa,NomePessoa,Sexo,Nascimento) VALUE(DEFAULT,?,?,?)") ;
        $cadastra->bindValue(1,$nome);
        $cadastra->bindValue(2,$sexo);
        $cadastra->bindValue(3,$nascimento);
        $cadastra->execute();
        if( $cadastra->rowCount()==1){
            $idPessoa =  $con->lastInsertId();
        }
        /*CÓDIGO PARA CADASTRAR O PROFESSOR NA TABELA ENSEREÇO*/
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
        /*CÓDIGO PARA CADASTRAR O PROFESSOR NA TABELA CONTATO*/
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
          /*CÓDIGO PARA CADASTRAR O PROFESSOR NA TABELA LOGIN*/
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
        /*CÓDIGO PARA CADASTRAR PROFESSOR NA TABELA PROFESSOR*/
        if(isset($idPessoa) && isset($idLogin)){
          $ativo = 1;
          $cadastraProfe  = $con->prepare("INSERT INTO professor VALUE(DEFAULT,?,?,?,?,?,?)");
          $cadastraProfe->bindValue(1,$idPessoa);
          $cadastraProfe->bindValue(2,$idLogin);
          $cadastraProfe->bindValue(3,$ativo);
          $cadastraProfe->bindValue(4,$idUsuario);
          $cadastraProfe->bindValue(5,$idDeparta);
          $cadastraProfe->bindValue(6,$nomeFoto);
          $cadastraProfe->execute();
           if($permissao==1){
              $urlAtivo = "adminG";
            }elseif($permissao==2){
                $urlAtivo= "adminA";
            }
          if($cadastraProfe->rowCount()==1){
              header("location:../../views/".$urlAtivo."/professor/index.php?alert=1");
          }else{
             header("location:../../views/".$urlAtivo."/professor/index.php?alert=0");
          }
        }
    }catch(PDOException $e){
      echo "Erro ".$e->getMessage();
    }
  }

  /*FUNÇÂO PARA LISTRA O PROFESSOR*/
  function listaProfessor($public){
      $con    = conectarBancoDados();
    try {
      $lista = $con->prepare("SELECT * from professor join pessoa on professor.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa join contato on pessoa.idPessoa = contato.pessoa_idPessoa 
      join departamento on professor.idDeparta = departamento.idDeparta WHERE professor.professor_Ativo = ?");
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
   /*FUNÇÃO PARA LISTRA O PROFESSOR ESPECIFICANDO O DEPARTAMENTO QUE ELE EXERCI */
  function listaProfessorExpecificando($public,$idDeparta){
      $con    = conectarBancoDados();
    try {
      $lista = $con->prepare("SELECT * from professor join pessoa on professor.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa join contato on pessoa.idPessoa = contato.pessoa_idPessoa 
    join departamento on professor.idDeparta = departamento.idDeparta WHERE professor.professor_Ativo = ? && professor.idDeparta = ?");
      $lista->bindValue(1,$public);
       $lista->bindValue(2,$idDeparta);
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
  /*FUNÇÃO PARA RETORNAR OS DADOS DO PROFESSOR PARA SER EDITA*/
  function buscaDadosProfessor($id){
      $con    = conectarBancoDados();
    try {
      $busca  = $con->prepare("SELECT * from professor JOIN pessoa ON professor.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa JOIN contato ON pessoa.idPessoa = contato.pessoa_idPessoa 
      join departamento on professor.idDeparta = departamento.idDeparta JOIN  login ON professor.Login_idLogin = login.idLogin WHERE professor.idProfessor = ?");
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
  /*FUNÇÃO PARA ATUALIZAR PROFESSOR*/
  function atualizaProfessor( $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      ,$idP,$permissao){
     $con    = conectarBancoDados();
    try {
      /*CÓDIGO PARA ATUALIZAR $NOEME SEXO E NASCIMENTO DO PROFESSOR*/
      $atualizarP = $con->prepare("UPDATE pessoa SET NomePessoa = ?,Sexo = ?,Nascimento = ?  WHERE idPessoa = ?");
      $atualizarP->bindValue(1,$nome);
      $atualizarP->bindValue(2,$sexo);
      $atualizarP->bindValue(3,$nascimento);
      $atualizarP->bindValue(4,$idP);
      $atualizarP->execute();
      
      /*CÓDIGO PARA ATUALIZAR NÚMERO  E EMAIL DO PROFESSOR*/
      $atualizarC = $con->prepare("UPDATE contato SET Telefone = ?,Email = ?  WHERE pessoa_idPessoa = ?");
      $atualizarC->bindValue(1,$telefone);
      $atualizarC->bindValue(2,$email);
      $atualizarC->bindValue(3,$idP);
      $atualizarC->execute();

      /*CÓDIGO PARA ATUALIZAR ENDEREÇO (CIDADE  MUNÍCIO e BAIRRO EMAIL DO PROFESSOR)*/
      $atualizarE = $con->prepare("UPDATE endereco SET Cidade = ?,Municipio = ?,Bairro = ?   WHERE pessoa_idPessoa= ?");
      $atualizarE->bindValue(1,$provincia);
      $atualizarE->bindValue(2,$municipio);
      $atualizarE->bindValue(3,$bairro);
      $atualizarE->bindValue(4,$idP);
      $atualizarE->execute();
        /*CÓDIGO PARA ATUALIZAR O LOGIN DE PROFESSOR*/
      $buscaIdLogin = $con->prepare("SELECT * FROM  professor WHERE pessoa_idPessoa = ?");
      $buscaIdLogin->bindValue(1,$idP);
      $buscaIdLogin->execute();
      if($buscaIdLogin->rowCount()==1){
        $dados = $buscaIdLogin->fetch(PDO::FETCH_ASSOC);
        $idLogin = $dados["Login_idLogin"];
      }

      $atualizaL  = $con->prepare("UPDATE `login` SET Usuario = ? , Senha = ? WHERE idLogin = ?");
      $atualizaL->bindValue(1,$usuario);
      $atualizaL->bindValue(2,$senha);
      $atualizaL->bindValue(3,$idLogin);
      $atualizaL->execute();
      /*CÓDIGO PARA ATUALIZAR DEPARTAMNETO (ID_DEPARTA)*/
      $atualizarD = $con->prepare("UPDATE professor SET idDeparta = ? WHERE pessoa_idPessoa= ?");
      $atualizarD->bindValue(1,$idDeparta);
      $atualizarD->bindValue(2,$idP);
      $atualizarD->execute();
       if($permissao==1){
          $urlAtivo = "adminG";
        }elseif($permissao==2){
            $urlAtivo= "adminA";
        }
      header("location:../../views/".$urlAtivo."/professor/?alert=1");
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }
  //FUNÇÃO PARA ATIVAR E DESATIVAR PROFESSOR
  function ativaProfessor($id,$value,$permissao){
     $con    = conectarBancoDados();
    try {
        if($value==1){
          $v = 0;
        }else{
          $v = 1;
        }
        if($permissao==1){
          $urlAtivo = "adminG";
        }elseif($permissao==2){
            $urlAtivo= "adminA";
        }
        $ativa =  $con->prepare("UPDATE professor  SET professor_Ativo = ? WHERE idProfessor = ?");
        $ativa->bindValue(1,$v);
        $ativa->bindValue(2,$id);
        $ativa->execute();
        if($ativa->rowCount()==1){
            header("location:../../".$urlAtivo."/professor/?alert=1");
        }else {
            header("location:../../".$urlAtivo."/professor/?alert=0");
        }
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }
   /*FUNÇÃO PARA LISTRA O PROFESSOR ESPECIFICANDO O CURSO QUE ELE EXERCI */
  function listaProfessorExpecificandoCurso($public,$idcurso){
      $con    = conectarBancoDados();
    try {
      $lista = $con->prepare("SELECT * from  professor join pessoa on professor.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa join contato on pessoa.idPessoa = contato.pessoa_idPessoa 
    join `professor_vs_curso` on  professor_vs_curso.profe_idProfessor=professor.idProfessor JOIN curso ON curso.idCurso=professor_vs_curso.curso_idCurso   WHERE professor_vs_curso.curso_idCurso=? && professor_vs_curso.Ativo = ? ");
      $lista->bindValue(1,$idcurso);
       $lista->bindValue(2,$public);
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
  function listaProfessorTurma($idCurso,$idTurma,$idAnoEscolar,$public,$anoLetivo){
      $con    = conectarBancoDados();
    try {
      $lista = $con->prepare("SELECT * from  professor JOIN pessoa on professor.pessoa_idPessoa = pessoa.idPessoa JOIN endereco 
      ON pessoa.idPessoa = endereco.pessoa_idPessoa JOIN contato on pessoa.idPessoa = contato.pessoa_idPessoa 
      JOIN `disciplina` ON disciplina.profe_idProfessor=professor.idProfessor JOIN curso ON curso.idCurso=disciplina.curso_idCurso 
      JOIN anosescolares ON anosescolares.idAnosEscolares = disciplina.anoEscolar_idEscolar JOIN turma
      WHERE disciplina.curso_idCurso=? && disciplina.anoEscolar_idEscolar = ? && professor_Ativo = ? && turma.idTurma = ? ORDER BY pessoa.NomePessoa");
      $lista->bindValue(1,$idCurso);
      $lista->bindValue(2,$idAnoEscolar);
      $lista->bindValue(3,$public);
      $lista->bindValue(4,$idTurma);
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
  
  ?>