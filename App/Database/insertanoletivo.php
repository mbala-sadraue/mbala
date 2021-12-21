<?php
 require_once "../../config/auth.php";
    require_once "../Models/anoletivo.php";
  if((isset($_POST["cadastra"]) && $_POST["cadastra"]=="ano_letivo")&& (isset($_POST["nome_anoletivo"]) && $_POST["nome_anoletivo"]!="")){
try {

 $nomeAnoletivo = $_POST["nome_anoletivo"];
    cadastraAnoLetivo($nomeAnoletivo,$permissao);

  //code...
} catch (Exception $e) {
  throw new Exception("Error Processing Request", $e);
  
}
   
  }










?>