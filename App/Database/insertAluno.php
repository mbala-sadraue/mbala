<?php
  require_once "../../config/auth.php";
  require_once "../Models/aluno.php";
  if(isset($_POST["cxadyaswtraz"]) || isset($_POST["axtuyalwizzar"])){
      $nome       =  $_POST["nome"];
      $telefone   =  $_POST["telefone"];
      $email      =  $_POST["email"];
      $nascimento =  $_POST["nascimento"];
      $sexo       =  $_POST["sexo"];
      /*ENDEREÇO DE MOARADA*/
      $provincia  =  $_POST["provincia"];
      $municipio  =  $_POST["municipio"];
      $bairro     =  $_POST["bairro"];	
      /*Imagens DEPARTAMENTO IDUSUARIO E O CURSO*/
      $idDeparta   =  $_POST["departa"];
      $idCurso =  $_POST["curso"];
      $idUsuario =  $_POST["idusuario"];
      /*ENCARREGADO*/
      $encarregado  = $_POST["encarregado"];
      $anoLetivo    = $_POST["anoLetivo"];
      $anoEscolar   = $_POST["ano_escolar"];
      $idTurma    = $_POST["nome_turma"];
      /*SENHA E O USUARIO
      $usuario   =  $_POST["usuario"];
      $senha     =  $_POST["password"];
     
      $perm      = 5; 
      */

       if(isset($_POST["cxadyaswtraz"])&&$_POST["cxadyaswtraz"]=="c1ad2as3tra4"&& isset($_POST["cadastra"])&&  isset($_POST["idusuario"])&& ($permissao ==2 || $permissao == 3)){
            cadastraAluno(
          $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$idDeparta,$idCurso,$idUsuario
          ,$encarregado,$anoLetivo,$anoEscolar,$idTurma,$permissao);

       }else if(isset($_POST["axtuyalwizzar"])&&$_POST["axtuyalwizzar"]=="a1tu2al3izar4"&& isset($_POST["atualziar"])&&

        isset($_POST["idusuario"])&& ($permissao ==2 || $permissao ==3)){
    
        $idP    = $_POST["idPessoa"];
        $idEnca = $_POST["idEncarregado"];
        $nomeEnca = $_POST["encarregado"];
        $idTurma;
        $imagem  = $_POST["imagem"];
         atualizaAluno(
        $idP,$nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$idDeparta,$idCurso,$idUsuario
      ,$encarregado,$anoLetivo,$permissao,$idEnca,$nomeEnca,$anoEscolar,$idTurma,
      $imagem);
       }else{
         echo "erro";
       }

  }else{
    echo "Envadiu!!!!!!";
  }
?>