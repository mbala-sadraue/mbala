<?php
	require_once "../../../config/auth.php";
	if($permissao ==1){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Disciplina</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
        require_once "../layout/layout.php";
        require_once "../../../App/Models/disciplina.php";
				require_once "../../../App/Models/curso.php";
				require_once "../../../App/Models/departamento.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Cadastra Disciplina</h1>
						</header>
					</div>
					<article class="article_main">
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Cadastrar Curso</h3>
							</div>
              <form class="form_main" method="post" action="'.$urlF2.'insertdisciplina.php">
              <div class="group-form">
									 <label class="form_label">Seleciona o Curso</label>
										<select class="form_select " name="curso">';
										if($dadosD = listaDepartamento()){
											$dadosD = listaDepartamento();
												$d = new ArrayIterator($dadosD);
												while ($d->valid()){
														
													 echo'<optgroup label="'.$d->current()->NomeDeparta.'" name="departamento"value="'.$d->current()->idDeparta.'">';
													
													 $idD= $d->current()->idDeparta; 
													 if(listaCursoDisciplina($idD)){
													 $dados = listaCursoDisciplina($idD);
													 
													 $dado = new ArrayIterator($dados);
													
													while($dado->valid()){
														echo'<option value="'.$dado->current()->idCurso.'">
															'.$dado->current()->NomeCurso.'
														</option>';
														$dado->next();
													}
												}
												
													 echo '</optgroup>';
													 
													
												
												$d->next();
											}
										}else{
												echo"<script>alert('Cadastra primeiro departamento') window.lacation='index.php'</script>";
											}
                       
                echo'</select>
								</div>
								<div class="group-form">
									<label class="form_label">Nome de Disciplina</label>
									<input type="text" name="nome_disciplina" id="input_valida" title="Nome de Disciplina" class="form_input_main" placeholder="Digite o nome de Disciplina">
								</div>
								<input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
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
							$count = 1;
								$dados = listaCursos();
								$d = new ArrayIterator($dados);
								while($d->valid()){
									echo'<li>
										<a href="" class="article_ul_a">'.$count.' -> '.$d->current()->NomeCurso.'</a>
									</li>';
									$count = $count + 1;
									$d->next();
								}
					echo'</ul>
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