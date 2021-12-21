<?php
  require_once "../../config/auth.php";
  require_once "../Models/anoescolar.php";
  if(isset($_POST["cadastra"]) && isset($_POST["nome_anoEscolar"]) && ($permissao==2 || $permissao ==1) ){
    
    $anoEscolar= $_POST["nome_anoEscolar"];
    $ciclo= $_POST["ciclo_escolar"];
    $idDeparta= $_POST["departamento"];
    $anoLetivo= $_POST["anoLetivo"];

    if((isset($_POST["cadastra"])&& $_POST["cadastra"]==="anoEscolar")){

    }
      cadastraAnoEscolar( $anoEscolar,$ciclo, $idDeparta,$anoLetivo,$permissao);
  }else{

  }
?>