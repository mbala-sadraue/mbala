<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra novo Ano letivo</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
        require_once "../layout/layout.php";
        require_once "../../../App/Models/departamento.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Novo ano letivo</h1>
						</header>
					</div>
					<article class="article_main">
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Cadastrar ano letivo</h3>
							</div>
              <form class="form_main" method="post" action="'.$urlF2.'insertanoletivo.php">
              <div class="">
                     <input type="hidden" name="departamento" value="'.$index_idDeparta.'"/>
								</div>
								<div class="group-form">
									<label class="form_label">Ano letivo</label>
									<input type="" name="nome_anoletivo" id="input_valida" title="Digite ano letivo" class="form_input_main" placeholder="Digite ano letivo">
								</div>
								<input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
								<div>
									<button class="btn_cadastra" id="btn_cadastra" name="cadastra" value="ano_letivo">Cadastra</button>
									<a href="../" class="btn_cansela">Cansela</a>
								</div>
								<div>
							</form>
						</div>
					
					</article>
				</section>';
				 echo'</div>
					 <script type="text/javascript" src="../assets/js/jquery.js"></script>
    				<script type="text/javascript" src="../assets/js/main.js"></script>'
    				;
				echo $javascript;
				echo $fim;
			}else{
				header("location:".$url."login.php");
			}
?>