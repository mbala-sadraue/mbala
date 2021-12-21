<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Ano escolar</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
        require_once "../layout/layout.php";
        require_once "../../../App/Models/departamento.php";
				require_once "../../../App/Models/curso.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Cadastra o ano escolar</h1>
						</header>
					</div>
				
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Novo ano escolar</h3>
							</div>
              <form class="form_main" method="post" action="'.$urlF2.'insertanoescolar.php">
								<article class="article_main">
								<div>
								
								<div class="group-form">
									<label class="form_label">Nome de Curso</label>
									<input type="" name="nome_anoEscolar" id="input_valida" title="Ano Escolar" class="form_input_main" placeholder="Digite o ano escolar">
								</div>
								</div>
								<div>
								<div class="group-form">
									<label class="form_label">Ciclo</label>
									<select id="input_valida" name="ciclo_escolar" class="form_input_main">
											<option value="1º Ciclo de ensino básico">1º Ciclo de ensino básico</option>
											<option value="1º ciclo de ensino segundário">1º ciclo de ensino segundário</option>
											<option value="Eniso Médio">Eniso Médio</option>
									</select>
								</div>
								</div>
								<div class="">
											<input type="hidden" name="departamento" value="'.$index_idDeparta.'"/>
											<input type="hidden" name="anoLetivo" value="'.$anoLetivo.'"/>
									</div>
								<input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
								</article>
								<div>
									<button class="btn_cadastra" id="btn_cadastra" name="cadastra" value="anoEscolar">Cadastra</button>
									<a href="../" class="btn_cansela">Cansela</a>
								</div>
							
							</form>
						</div>

					
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