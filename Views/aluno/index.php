<?php
    require_once "../../config/auth.php";
    if($permissao == 5){
        echo "<br>Nome: ".$nomeUsuario."<br/> id: ".$idUsuario."<br/> Departamento:".$idDeparta;
    }else{
        header("location:".$url."login.php");
    }
?>