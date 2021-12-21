<?php
  require_once "../../config/auth.php";
  require_once "../Models/professor.php";
  if(isset($_POST["cxadyaswtraz"]) || isset($_POST["axtuyalwizzar"])){
      $nome       =  strip_tags(trim($_POST["nome"]));
      $telefone   =  strip_tags(trim($_POST["telefone"]));
      $email      =  strip_tags(trim($_POST["email"]));
      $nascimento =  strip_tags(trim($_POST["nascimento"]));
      $sexo       =  strip_tags(trim($_POST["sexo"]));
      /*ENDEREÇO DE MOARADA*/
      $provincia  =  strip_tags(trim($_POST["provincia"]));
      $municipio  =  strip_tags(trim($_POST["municipio"]));
      $bairro     =  strip_tags(trim($_POST["bairro"]));
      /*Imagens DEPARTAMENTO IDUSUARIO*/
      $idDeparta  =  strip_tags(trim($_POST["departa"]));
      $imagem     =  strip_tags(trim( $_POST["imagem"]));
      $idUsuario  =  strip_tags(trim($_POST["idusuario"]));
      /*SENHA E O USUARIO*/
      $usuario   =  strip_tags(trim($_POST["usuario"]));
      $senha     =  sha1($_POST["password"]);
      $perm      = 4;
      
      /**/
       if(isset($_POST["cxadyaswtraz"])&&$_POST["cxadyaswtraz"]=="c1ad2as3tra4"&& isset($_POST["cadastra"])&& 
       isset($_POST["idusuario"])&& ($permissao ==1 || $permissao == 2)){
         
         cadastraProfessor(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      ,$permissao);

       }

        if(isset($_POST["axtuyalwizzar"])&&$_POST["axtuyalwizzar"]=="a1tu2al3izar4"&& isset($_POST["atualizar"])&&
        isset($_POST["idusuario"])&& ($permissao ==1 || $permissao ==2)){
          $idP    = $_POST["idPessoa"];

         atualizaProfessor(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      ,$idP,$permissao);
         
       }

  }
?>