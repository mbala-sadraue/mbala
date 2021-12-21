<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){
		if(isset($_GET["id"]) && $_GET["id"]>0){
			$id = $_GET["id"];
			$public = 1;
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Turma</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
        require_once "../layout/layout2.php";
				require_once "../../../App/Models/curso.php";
				require_once "../../../App/Models/anoescolar.php";
				require_once "../../../App/Models/turma.php";
				$public =1;
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Editar Turma</h1>
						</header>
					</div>
				
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Editar Turma</h3>
							</div>';
							if(buscaDadosTurma($anoLetivo,$index_idDeparta,$public,$id)){// VERIFICA SE A RETORNO DE DADOS DA TURMA
              	echo'<form class="form_main" method="post" action="'.$urlF2.'insertturma.php">
									<article class="article_main">';
									$dados = buscaDadosTurma($anoLetivo,$index_idDeparta,$public,$id);
								//	print_r($dados);
									$dT = new arrayIterator($dados);
									while($dT->valid()){
										echo'<div>
											<div class="group-form">
												<label class="form_label">Ano escolar</label>';
													if(listarAnoescolar($public,$index_idDeparta,$anoLetivo)){// VERIFICA SE EXITE UM RETORNO DE DADOS NA FUÇÃO LISTAR ANO ESCOLAR 
														$dados = listarAnoescolar($public,$index_idDeparta,$anoLetivo);;
														$d = new arrayIterator($dados);
														echo'<select id="input_valida" name="ano_escolar" class="form_input_main">';

														while($d->valid()){// LAÇO DE REPETIÇÃO PARA LISTAR ANOS ESCOLRES
															$selected1 = ($dT->current()->idAnosEscolares == $d->current()->idAnosEscolares)?"selected":"";
															echo'	<option '.$selected1.' value="'.$d->current()->idAnosEscolares.'">'.$d->current()->NomeAnoEscolar.'</option>';
														
															$d->next();
																}// FIM DE LAÇO
													echo'</select>';
													}else{
															echo "Sem Dados";
													}// FIM DE VERIFIÇÃO
												echo'
											</div>

											<div class="group-form">
												<label class="form_label">Turma</label>
												<input type="" name="nome_turma"  value="'.$dT->current()->NomeTurma.'"id="input_valida" title="Turma" class="form_input_main" placeholder="Digite a Turma">
											</div>
											<div class="group-form">
												<label class="form_label">Sala</label>
												<input type="" name="nome_sala" value="'.$dT->current()->Sala.'"id="input_valida" title="Sala" class="form_input_main" placeholder="Digite a Sala">
											</div>
										</div>
										<div>
											<div class="group-form">
												<label class="form_label">Curos</label>';
													if(listaCurso($index_idDeparta,$public)){
														$dados = listaCurso($index_idDeparta,$public);
														$d = new arrayIterator($dados);
														echo'<select id="input_valida" name="curso" class="form_input_main">';
														while($d->valid()){
															$selected	 = ($dT->current()->curso_idCurso == $d->current()->idCurso)?"selected":"";
														
															echo'	<option '.$selected.' value="'.$d->current()->idCurso.'">'.$d->current()->NomeCurso.'</option>';
														
															$d->next();
																}
													echo'</select>';
													}else{
															echo "Sem Dados";
													}
												echo'
											</div>
											<div class="group-form">
												<label class="form_label">Diretor</label>
												<input type="" name="nome_diretor" value="'.$dT->current()->Diretor. '"id="input_valida" title="Diretor" class="form_input_main" placeholder="Digite o Diretor da turma">
											</div>
											<div class="group-form">
												<label class="form_label">Vaga</label>
												<input type="number" name="vaga" id="input_valida"value="'.$dT->current()->Vaga.'" title="quantidade de alunos" class="form_input_main" placeholder="Digite a quantidade máxima de alunos na turma">
											</div>
											</div>
										</div>
										<div class="">
													<input type="hidden" name="departamento" value="'.$index_idDeparta.'"/>
													<input type="hidden" name="anoLetivo" value="'.$anoLetivo.'"/>
											</div>
										<input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4">
										<input type="hidden" name="idTurma" value="'.$dT->current()->idTurma.'">
										<input type="hidden" name="idusuario" value="'.$idUsuario.'">';
										$dT->next();
												}
								echo'</article>
								<div>
									<button class="btn_cadastra" id="btn_cadastra" name="atualizar" value="turma">Editar</button>
									<a href="../" class="btn_cansela">Cansela</a>
								</div>
							
							</form>';
												}else {// VERIFICA SE RETORNI DE DADOS
													echo "Sem registro encontrado";
												}
						echo'
						</div>

					
				</section>';
				 echo'</div>
					 <script type="text/javascript" src="../assets/js/jquery.js"></script>
    				<script type="text/javascript" src="../assets/js/main.js"></script>'
    				;
				echo $javascript;
				echo $fim;
					}else{
						header("location:index.php");
					}
			}else{
				header("location:".$url."login.php");
			}
?>