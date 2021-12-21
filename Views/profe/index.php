<?php
    require_once "../../config/auth.php";
    if($permissao ==4){
        echo "<br>Nome: ".$nomeUsuario."<br/> id: ".$idUsuario;
    }else{
        header("location:".$url."login.php");
    }
?>