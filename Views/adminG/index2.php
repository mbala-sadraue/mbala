﻿  <?php
        require_once "../../config/auth.php";
        if($permissao == 1){
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paginal Principal</title>
	<link rel="stylesheet" type="text/css" href="assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
        <?php
            require_once "layout/layout.php";
            echo $header;
            echo '<div class="corpo_geral">';
            echo $aside;
            echo $section;
           
            echo'</div>';
            echo $javascript;
          }else{
             header("location:".$url."login.php");
        }
        ?>