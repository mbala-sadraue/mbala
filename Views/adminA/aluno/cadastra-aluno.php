<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){ // VERIFICA APERMISSÃO DO USUARIO
		$public = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Aluno</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/estilo3.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
				require_once "../layout/layout.php";
				require_once "../../../App/Models/curso.php";
				require_once "../../../App/Models/departamento.php";
				require_once "../../../App/Models/anoescolar.php";
			  require_once "../../../App/Models/turma.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section section_aluno">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Cadastra Aluno</h1>
						</header>
					</div>
					<article class="article_main_form">
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Aluno</h3>
							</div>
							<form class="form_main " enctype="multipart/form-data" action="'.$urlF2.'insertAluno.php" method="post">
								<div class="form_main_group ">
									<div class="form_main_group_header">
										<h5 class="form_main_group_header_h5">Dados Pessoais</h5>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Nome Completo</label>
										<div>
											<input type="text" name="nome" class="control_input" placeholder="Digite Nome Completo">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Telefone</label>
										<div>
											<input type="text" name="telefone" class="control_input" placeholder="Digite Telefone">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Email</label>
										<div>
											<input type="emai" name="email" class="control_input" placeholder="Digite email">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Nascimento</label>
										<div>
											<input type="date" name="nascimento" class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Sexo</label>
										<table class="tabela">
												<tbody>
													<tr class="flex">
														<td class="form_lable">
															<label>Masculino
																<input type="radio" name="sexo" value="Masculino"checked="checked">
															</label>
														</td>
														<td class="form_lable">
															<label>Feminino
																<input type="radio" name="sexo" value="Feminino">
															</label>
														</td>
													</tr>
												</tbody>
											</table>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Província</label>
										<div>
											<input type="" name="provincia"  placeholder="Digite Provincia" value="Luanda"class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Múnicipio</label>
										<div>
											<input type="" name="municipio" placeholder="Digite Munícipio"  class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Bairro</label>
										<div>
											<input type="text" name="bairro" placeholder="Digite Bairro"class="control_input">
										</div>
									</div>
									
								</div>';
								//$anoLetivo =  date("Y");
								echo'<div class="form_main_group">
									<div class="form_main_group_header">
										<h5 class="form_main_group_header_h5">Dados Academico</h5>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Curso</label>
										<select class="form_select control_input " name="curso">';
										if($dadosD = listaDepartamentoExpecificado($index_idDeparta)){// VERIFICA SE A OU NÃO RETORNO DE DEPARTAMENTO
											$dadosD = listaDepartamentoExpecificado($index_idDeparta);
											$d = new ArrayIterator($dadosD);
											while ($d->valid()){ // CÓDIGO PARA LISTAR DEPARTAMENTO
													
												echo'<optgroup label="'.$d->current()->NomeDeparta.'" name="departamento"value="'.$d->current()->idDeparta.'">';
											
												$idD= $d->current()->idDeparta; 
												if(listaCursoDisciplina($idD)){ // VERIFICA SE A OU NÃO RETORNO DE CURSO
													$dados = listaCursoDisciplina($idD);
													
													$dado = new ArrayIterator($dados);
													
													while($dado->valid()){ // CÓDIGO PARA LISTAR CURSO
														echo'<option value="'.$dado->current()->idCurso.'" style="font-size:14px;">
															'.$dado->current()->NomeCurso.'
														</option>';
														$dado->next();
													} // CÓDIGO PARA LISTAR CURSO

												} // VERIFICA SE A OU NÃO RETORNO DE CURSO
													echo '</optgroup>';
													
												
											
												$d->next();
											}// CÓDIGO PARA LISTAR DEPARTAMENTO
										}else{
												echo"<script>alert('Cadastra primeiro departamento') window.lacation='index.php'</script>";
											}// VERIFICA SE A OU NÃO RETORNO DE DEPARTAMENTO
                       
                echo'</select>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Ano escolar</label>
										<div>';
												if(listarAnoescolar($public,$index_idDeparta,$anoLetivo)){// VERIFICA SE EXITE UM RETORNO DE DADOS NA FUÇÃO LISTAR ANO ESCOLAR 
														$dados = listarAnoescolar($public,$index_idDeparta,$anoLetivo);;
														$d = new arrayIterator($dados);
														echo'<select id="input_valida" name="ano_escolar" class="control_input">';

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
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Turma</label>
										<div>';
												if(listarTurma($anoLetivo,$index_idDeparta,$public)){// VERIFICA SE EXITE UM RETORNO DE DADOS NA FUÇÃO LISTAR ANO ESCOLAR 
														$dados = listarTurma($anoLetivo,$index_idDeparta,$public);
													//	print_r($dados);
														$d = new arrayIterator($dados);
														echo'<select id="input_valida" name="nome_turma" class="control_input">';

														while($d->valid()){// LAÇO DE REPETIÇÃO PARA LISTAR ANOS ESCOLRES
															echo'	<option value="'.$d->current()->	idTurma.'">'.$d->current()->NomeTurma.' - '.$d->current()->NomeCurso.'</option>';
														
															$d->next();
																}// FIM DE LAÇO
													echo'</select>';
													}else{
															echo "Não foi entrado <strong>turma</strong>  ";
													}// FIM DE VERIFIÇÃO
												echo'
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Nome de Encarregado </label>
										<div>
											<input type="text" name="encarregado"placeholder="Digite nome de Carregado" class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Seleciona Foto</label>
										<div>
											<input type="file" name="imagem" class="">
										</div>
									</div>
								</div>
								<input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4"/>
									<input type="hidden" name="idusuario" value="'.$idUsuario.'"/>
									<input type="hidden" name="departa" value="'.$index_idDeparta.'"/>
									<input type="hidden" name="anoLetivo" value="'.$anoLetivo.'"/>
                 <div class="center">
                  <button class="btn_cadastra col-4" id="btn_cadastra" name="cadastra" value="aluno">Registra</button>
                  <a href="" class="btn_cansela col-4">Cancelar</a>
                </div>
							</form>
						</div>
					</article>
				</section>';
				 echo'</div>
					 <script type="text/javascript" src="../assets/js/jquery.js"></script>
					  <script type="text/javascript" src="../../assets/js/valida.js"></script>
    				<script type="text/javascript" src="../assets/js/main.js"></script>'
    				;
				echo $javascript;
				echo $fim;
			}else{
				header("location:".$url."login.php");
			}// VERIFICA APERMISSÃO DO USUARIO
?>
