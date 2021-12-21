<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){ // VERIFICA APERMISSÃO DO USUARIO
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
				require_once "../layout/layout2.php";
				require_once "../../../App/Models/curso.php";
				require_once "../../../App/Models/departamento.php";
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
								$anoLetivo =  date("Y");
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
										<label class="control_label">Ano Letivo</label>
										<div>
											<input type="number" name="anoLetivo" value="'.$anoLetivo.'" class="control_input" placeholder="Digite o Ano lectivo">
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
                 <div class="center">
                  <button class="btn_cadastra col-4" id="btn_cadastra" name="cadastra" value="aluno">Cadastra</button>
                  <a href="" class="btn_cansela col-4">Cansela</a>
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
