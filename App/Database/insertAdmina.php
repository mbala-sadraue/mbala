<?php
  require_once "../Models/administrativa.php";
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
      /*Imagens DEPARTAMENTO IDUSUARIO*/
      $idDeparta  =  $_POST["departa"];
      $idUsuario  =  $_POST["idusuario"];
     
      $perm       = 2;
       if(isset($_POST["cxadyaswtraz"])&&$_POST["cxadyaswtraz"]=="c1ad2as3tra4"&& isset($_POST["cadastra"])&& 
       isset($_POST["idusuario"])&&$_POST["idusuario"]==1){
        /*SENHA E O USUARIO*/
        $usuario    =  $_POST["usuario"];
        $senha      =  sha1($_POST["password"]);
         cadastraAdministrativa(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$usuario,$senha,$perm,$idDeparta,$idUsuario
      );
       }
        if(isset($_POST["axtuyalwizzar"])&&$_POST["axtuyalwizzar"]=="a1tu2al3izar4"&& isset($_POST["atualizar"])&&
        isset($_POST["idusuario"])&&$_POST["idusuario"]==1){
          $idP    = $_POST["idPessoa"];
         /* $idA    = $_POST["idAdmin"];
          $idC    = $_POST["idContato"];
          $idE    = $_POST["idEndereco"];
          $idL    = $_POST["idLogin"];
          $idD    = $_POST["idDE"];*/
         atualizaAdministrativa(
        $nome,$sexo,$nascimento,$provincia,$municipio,$bairro,$telefone,$email,$perm,$idDeparta,$idUsuario
      ,$idP);
       }

  }
?>