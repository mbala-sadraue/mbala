<?php	
	require_once "../../../config/auth.php";
	if($permissao ==2){
			if(isset($_GET["id"])&& $_GET["id"]>0 && isset($_GET["idD"])&& $_GET["idD"]>0 ){
		$id = $_GET["id"];
	 $idDeparta = 	$_GET["idD"]
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Disciplina</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
				require_once "../layout/layout2.php";
				require_once "../../../App/Models/departamento.php";
        require_once "../../../App/Models/disciplina.php";
				require_once "../../../App/Models/curso.php";
				require_once "../../../App/Models/anoescolar.php";
				require_once "../../../App/Models/professor.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Editar Disciplina</h1>
						</header>
					</div>
					
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Disciplina</h3>
							</div>';
					if(is_array(buscaDadosDisciplina($id))){
					echo'<form class="form_main" method="post" action="'.$urlF2.'insertdisciplina.php">	<input type="hidden" name="idDeparta" value="'.$index_idDeparta.'">
					<article class="article_main">';
				$dadosLista = buscaDadosDisciplina($id);
			echo'		<div>
								<div class="group-form">
									 <label class="form_label">Seleciona o Curso</label>
										<select class="form_input_main " name="curso">';
										if($dadosD = listaDepartamentoDisciplina($index_idDeparta)){
											$dadosD = listaDepartamentoDisciplina($index_idDeparta);
												$d = new ArrayIterator($dadosD);
												while ($d->valid()){
														
													 echo'<optgroup label="'.$d->current()->NomeDeparta.'" name="departamento"value="'.$d->current()->idDeparta.'">';
													
													 $idD= $d->current()->idDeparta; 
													 if(listaCursoDisciplina($index_idDeparta)){
													 $dados = listaCursoDisciplina($index_idDeparta);
													 
													 $dado = new ArrayIterator($dados);
													
													while($dado->valid()){
														echo'<option value="'.$dado->current()->idCurso.'"';if($dado->current()->idCurso==$dadosLista["idCurso"]){echo"selected";}echo'>
															'.$dado->current()->NomeCurso.'
														</option>';
														$dado->next();
													}
												}
												else{
													echo"<script>alert('Cadastra primeiro Curso')</script>
													<script>window.location='index.php'</script>";
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
									 <label class="form_label">Seleciona Professor</label>
										<select class="form_input_main " name="idProfessor">';
										$ativo = 1;
										if($dadosD = listaDepartamentoDisciplina($index_idDeparta)){
											$dadosD = listaDepartamentoDisciplina($index_idDeparta);
												$d = new ArrayIterator($dadosD);
												while ($d->valid()){
														
													 echo'<optgroup label="'.$d->current()->NomeDeparta.'" name="departamento"value="'.$d->current()->idDeparta.'">';
													
													 $idD= $d->current()->idDeparta; 
													 if(listaProfessorExpecificando($ativo,$idD)){
													 $dados = listaProfessorExpecificando($ativo,$idD);
													 
													 $dado = new ArrayIterator($dados);
													
													while($dado->valid()){
														echo'<option value="'.$dado->current()->idProfessor.'"'; if($dado->current()->idProfessor== $dadosLista['idProfessor']){echo "selected";}echo'>
															'.$dado->current()->NomePessoa.'
														</option>';
														$dado->next();
													}
												}
												else{
													echo"<script>alert('Cadastra primeiro Professor')</script>
													<script>window.location='index.php'</script>";
												}
													 echo '</optgroup>';
													 
													
												
												$d->next();
											}
										}else{
												echo"<script>alert('Cadastra primeiro departamento') window.lacation='index.php'</script>";
											}
                       
                echo'</select>
								</div>
								</div>
								<div>
								<div class="group-form">
											<label class="form_label">Seleciona Ano Escolar</label>
												<select class="form_input_main " name="anoEscolar">';
												$ativo = 1;
												if($dadosD = listaDepartamentoDisciplina($index_idDeparta)){
													$dadosD = listaDepartamentoDisciplina($index_idDeparta);
														$d = new ArrayIterator($dadosD);
														while ($d->valid()){
																
															echo'<optgroup label="'.$d->current()->NomeDeparta.'" name="departamento"value="'.$d->current()->idDeparta.'">';
															
															$idD= $d->current()->idDeparta; 
															if(listarAnoescolarDisciplina($ativo,$idD)){
															$dados = listarAnoescolarDisciplina($ativo,$idD);
															
															$dado = new ArrayIterator($dados);
															
															while($dado->valid()){
																$selected0 = ($dado->current()->idAnosEscolares == $dadosLista["anoEscolar_idEscolar"])?"selected":"";
																echo'<option value="'.$dado->current()->idAnosEscolares.'"'.$selected0 .'>
																	'.$dado->current()->NomeAnoEscolar.'
																</option>';
																$dado->next();
															}
														}
														else{
															echo"<script>alert('Cadastra primeiro Professor')</script>
															<script>window.location='index.php'</script>";
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
									<input type="text" name="nome_disciplina" value="'.$dadosLista['NomeDisciplina'].'" id="input_valida" title="Nome de Disciplina" class="form_input_main" placeholder="Digite o nome de Disciplina">
								</div>
								</div>
								</article>
								<input type="hidden" name="idDisciplina" value="'.$dadosLista['idDisciplina'].'">
								<input type="hidden" name="idProfeCurso" value="'.$dadosLista['id_profe_curso'].'">
								<input type="hidden" name="Editar" value="Disciplina">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
									<input type="hidden"name="anoLetivo" value="'.$anoLetivo.'">
								<div>
									<button class="btn_cadastra" id="btn_cadastra">Editar</button>
									<a href="../" class="btn_cansela">Cansela</a>
								</div>
							</form>';
							//VALIDA DADOS 
			echo'	</div>
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Curso Existente</h3>
							</div>
							<ul class="article_ul">';
							$count = 1;
							$ativo = 1;
								$dados2 =  listaCurso($index_idDeparta,$ativo);
								$d1 = new ArrayIterator($dados2);
								while($d1->valid()){
									echo'<li>
										<a href="" class="article_ul_a">'.$count.' -> '.$d1->current()->NomeCurso.'</a>
									</li>';
									$count = $count + 1;
									$d1->next();
								}
					echo'</ul>
						</div>';
						}else{
                 echo "Nenha dados foi encotrado";
               }
				echo'	
				</section>';
				
				 echo'</div>
					 <script type="text/javascript" src="../assets/js/jquery.js"></script>
    				<script type="text/javascript" src="../assets/js/main.js"></script>'
    				;
				echo $javascript;
				echo $fim;
				
				}else{
						header("location:".$url."login.php");
				}//VALIDA ID VINDO DO GET
			}else{
				header("location:".$url."login.php");
			}// VALIDA A PERMISSÃO
?>