<?php
require_once "../../config/auth.php";
require_once "../Models/secretario.php";
 if(isset($_POST["cxadyaswtraz"]) || isset($_POST["axtuyalwizzar"])){
      $nome       =  $_POST["nome"];
      $telefone   =  $_POST["telefone"];
      $email      =  $_POST["email"];
      $nascimento =  $_POST["nascimento"];
      $sexo       =  $_POST["sexo"];
      /*ENDERE�O DE MOARADA*/
      $provincia  =  $_POST["provincia"];
      $municipio  =  $_POST["municipio"];
      $bairro     =  $_POST["bairro"];
      /*Imagens DEPARTAMENTO IDUSUARIO*/
      $idDeparta   =  $_POST["departa"];
      $imagem    =  $_POST["imagem"];
      $idUsuario =  $_POST["idusuario"];
      /*SENHA E O USUARIO*/
      $usuario   =  $_POST["usuario"];
      $senha     =  sha1($_POST["password"]);
      $perm      = 3;
       if(isset($_POST["cxadyaswtraz"])&&$_POST["cxadyaswtraz"]=="c1ad2as3tra4"&& isset($_POST["cadastra"])&& 
       isset($_POST["idusuario"])&& ($permissao ==1 || $permissao == 2)){
         cadastraSecretario(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      ,$permissao);
       }
        if(isset($_POST["axtuyalwizzar"])&&$_POST["axtuyalwizzar"]=="a1tu2al3izar4"&& isset($_POST["atualizar"])&&
        isset($_POST["idusuario"])&& ($permissao == 1 || $permissao == 2 || $permissao==3)){
          $idP    = $_POST["idPessoa"];
         atualizaSecretario(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      ,$idP,$permissao,$imagem);
       }
       
  }




?>