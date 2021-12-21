<?php
	require_once "../../../config/auth.php";
	if($permissao ==2){
		/*
		*VERIFICA SE EXISTE GET IDALUNO E SE VARIAS GET ALUNO IGUAL A EDITAR ALUNO 
		*/
		if((isset($_GET['idAluno']) && $_GET["idAluno"]>0)&& (isset($_GET["aluno"])&& $_GET["aluno"]=="editaAluno")){

  	 $idAluno = $_GET['idAluno'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Aluno</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
  	<link rel="stylesheet" type="text/css" href="../assets/css/estilo3.css">
		<style type="text/css">
		p{
				font-size:12px;
				color:red;
			}
		</style>
	
</head>

<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
				require_once "../layout/layout2.php";
				require_once "../../../App/Models/curso.php";
					require_once "../../../App/Models/aluno.php";
				require_once "../../../App/Models/departamento.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section section_aluno">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Editar Aluno</h1>
						</header>
					</div>
					<article class="article_main_form">
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Aluno</h3>
							</div>';
							//VERIFiCA SE A FUNÇÃO [listaDadosAluno] RETORNA ALGUM VALOR 
						 if(listaDadosAluno($idAluno)){
							$dadosAluno =listaDadosAluno($idAluno);
						
							$dAluno  = new ArrayIterator($dadosAluno);
							while($dAluno->valid()){
						echo'	<form class="form_main " enctype="multipart/form-data" action="'.$urlF2.'insertAluno.php" method="post">
								<div class="form_main_group ">
									<div class="form_main_group_header">
										<h5 class="form_main_group_header_h5">Dados Pessoais</h5>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Nome Completo</label>
										<div>
											<input type="text" name="nome" value="'.$dAluno->current()->NomePessoa.'" class="control_input" placeholder="Digite Nome Completo">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Telefone</label>
										<div>
											<input type="text" name="telefone" value="'.$dAluno->current()->Telefone.'" class="control_input" placeholder="Digite Telefone">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Email</label>
										<div>
											<input type="emai" name="email" value="'.$dAluno->current()->Email.'"class="control_input" placeholder="Digite email">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Nascimento</label>
										<div>
											<input type="date" name="nascimento" value="'.$dAluno->current()->Nascimento.'" class="control_input">
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
											<input type="" name="provincia" value="'.$dAluno->current()->Cidade.'" placeholder="Digite Provincia" value="Luanda"class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Múnicipio</label>
										<div>
											<input type="" name="municipio" value="'.$dAluno->current()->Municipio.'"placeholder="Digite Munícipio"  class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Bairro</label>
										<div>
											<input type="text" name="bairro"value="'.$dAluno->current()->Bairro.'" placeholder="Digite Bairro"class="control_input">
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
										// VERIFICA SE A UM RETORNO DE DEPARTAMENTO
										if($dadosD = listaDepartamentoExpecificado($index_idDeparta)){
											$dadosD = listaDepartamentoExpecificado($index_idDeparta);
												$d = new ArrayIterator($dadosD);
												while ($d->valid()){// LOP PARA LISTAR DEPARTAMENTO
														
													 echo'<optgroup label="'.$d->current()->NomeDeparta.'" name="departamento"value="'.$d->current()->idDeparta.'">';
													
													 $idD= $d->current()->idDeparta; 
													 if(listaCursoDisciplina($idD)){
													 $dados = listaCursoDisciplina($idD);
													 
													 $dado = new ArrayIterator($dados);
													
													while($dado->valid()){// LOP PARA LISTAR Cursos
														echo'<option value="'.$dado->current()->idCurso.'" style="font-size:14px;">
															'.$dado->current()->NomeCurso.'
														</option>';
														$dado->next();
													}
												}
												else{
												$n="<script>alert('Cadastra primeiro curso')</script>
													<script>window.location='index.php'</script>";
												}
													 echo '</optgroup>';
													 
													
												
												$d->next();
											}
										}else{
												echo"<script>alert('Cadastra primeiro departamento') window.lacation='index.php'</script>";
											}// VERIFICA SE A UM RETORNO DE DEPARTAMENTO
                       
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
											<input type="text" name="encarregado" value="'.$dAluno->current()->NomeEncarregado.'" placeholder="Digite nome de Carregado" class="control_input">
										</div>
									</div>
									<div class="form_main_group_control">
										<label class="control_label">Seleciona Foto</label>
										<div>';
											if($dAluno->current()->NomeImagem != null){
												$vImagem = $dAluno->current()->NomeImagem;
												echo  '
													<div>
															<img src="../../aluno/imagem/'.$vImagem.'" alt="foto de '.$dAluno->current()->NomeImagem.'" value="'.$dAluno->current()->NomeImagem.'"style="max-width:50px; "/>
													</div>
												';
											}else{
												$vImagem ="";
												echo '
													<div>
															<p id"p">'.$dAluno->current()->NomePessoa.' Não tem foto</p> 
													</div>
												';
											}
											
											echo '<input type="file" name="imagem" value="'.$vImagem.'" class="">
										</div>
									</div>
								</div>
								<input type="hidden" name="idPessoa" value="'.$dAluno->current()->idPessoa.'"/>
								<input type="hidden" name="idEncarregado"value="'.$dAluno->current()->idEncarregado.'"/>
								<input type="hidden" name="Nomencarregado"value="'.$dAluno->current()->NomeEncarregado.'"/>
								<input type="hidden" name="axtuyalwizzar" value="a1tu2al3izar4"/>
									<input type="hidden" name="idusuario" value="'.$idUsuario.'"/>
									<input type="hidden" name="departa" value="'.$index_idDeparta.'"/>
                 <div class="center">
                  <button class="btn_cadastra col-4" id="btn_cadastra" name="atualziar" value="aluno">Editar</button>
                  <a href="" class="btn_cansela col-4">Cansela</a>
                </div>
							</form>';
									$dAluno->next();
								}// EXTRUTURA WHILE QUE LISTA DODOS OS DADOS DO ALUNO
							}else{
							 echo"Erro";
						 }//VERIFiCA SE A FUNÇÃO [listaDadosAluno] RETORNA ALGUM VALOR 
						echo'</div>
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
						/*
							*VERIFICA SE EXISTE GET IDALUNO E SE VARIAS GET ALUNO IGUAL A EDITAR ALUNO 
						*/
				}
			}else{
				header("location:".$url."login.php");
			}
?>
