<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Departamento</title>
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
							<h1 class="section_header_h1">Cadastra o Curso</h1>
						</header>
					</div>
				
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Cadastrar Curso</h3>
							</div>
              <form class="form_main" method="post" action="'.$urlF2.'insertcurso.php">
								<article class="article_main">
								<div>
								<div class="">
											<input type="hidden" name="departamento" value="'.$index_idDeparta.'"/>
											<input type="hidden" name="anoLetivo" value="'.$anoLetivo.'"/>
									</div>
								<div class="group-form">
									<label class="form_label">Nome de Curso</label>
									<input type="" name="nome_curso" id="input_valida" title="Nome de Curso" class="form_input_main" placeholder="Digite o nome de Curso">
								</div>
								</div>
								<input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
								</article>
								<div>
									<button class="btn_cadastra" id="btn_cadastra">Cadastra</button>
									<a href="../" class="btn_cansela">Cansela</a>
								</div>
							
							</form>
						</div>
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Curso Existente</h3>
							</div>
							<ul class="article_ul">';	
							$ativo = 1;
							if(listaCurso($index_idDeparta,$ativo)){
							$count = 1;
						
								$dados = listaCurso($index_idDeparta,$ativo);
								$d = new ArrayIterator($dados);
								while($d->valid()){
									echo'<li>
										<a href="" class="article_ul_a">'.$count.' -> '.$d->current()->NomeCurso.'</a>
									</li>';
									$count = $count + 1;
									$d->next();
								}
							}else{
								echo "<li>Sem curso</li>";
							}
					echo'</ul>
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