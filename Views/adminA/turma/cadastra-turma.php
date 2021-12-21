<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Turma</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
        require_once "../layout/layout.php";
				require_once "../../../App/Models/curso.php";
				require_once "../../../App/Models/anoescolar.php";
				$public =1;
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Cadastra Turma</h1>
						</header>
					</div>
				
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Nova Turma</h3>
							</div>
              	<form class="form_main" method="post" action="'.$urlF2.'insertturma.php">
									<article class="article_main">
										<div>
											<div class="group-form">
												<label class="form_label">Ano escolar</label>';
													if(listarAnoescolar($public,$index_idDeparta,$anoLetivo)){// VERIFICA SE EXITE UM RETORNO DE DADOS NA FUÇÃO LISTAR ANO ESCOLAR 
														$dados = listarAnoescolar($public,$index_idDeparta,$anoLetivo);;
														$d = new arrayIterator($dados);
														echo'<select id="input_valida" name="ano_escolar" class="form_input_main">';

														while($d->valid()){// LAÇO DE REPETIÇÃO PARA LISTAR ANOS ESCOLRES
															echo'	<option value="'.$d->current()->idAnosEscolares.'">'.$d->current()->NomeAnoEscolar.'</option>';
														
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
												<input type="" name="nome_turma" id="input_valida" title="Turma" class="form_input_main" placeholder="Digite a Turma">
											</div>
											<div class="group-form">
												<label class="form_label">Sala</label>
												<input type="" name="nome_sala" id="input_valida" title="Sala" class="form_input_main" placeholder="Digite a Sala">
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
															echo'	<option value="'.$d->current()->idCurso.'">'.$d->current()->NomeCurso.'</option>';
														
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
												<input type="" name="nome_diretor" id="input_valida" title="Diretor" class="form_input_main" placeholder="Digite o Diretor da turma">
											</div>
											<div class="group-form">
												<label class="form_label">Vaga</label>
												<input type="number" name="vaga" id="input_valida" title="quantidade de alunos" class="form_input_main" placeholder="Digite a quantidade máxima de alunos na turma">
											</div>

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
									<button class="btn_cadastra" id="btn_cadastra" name="cadastra" value="turma">Registra</button>
									<a href="../" class="btn_cansela">Cancelar</a>
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