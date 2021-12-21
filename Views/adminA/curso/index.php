<?php
  require_once "../../../config/auth.php";
  if($permissao ==2){
    $public  = 1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Curso</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
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

        if(isset($_POST['public'])){
          $value = $_POST['public'];
          if($value == 1){
            $public = 0;
            $btn_public = 'Publicado';
          }else{
            $public = 1;
            $btn_public = 'Inativo';
          }
        }else{
          $public = 1;
          $btn_public = 'Inativo';
        }
      echo $header;
      
      echo '<div class="corpo_geral">';
      echo $aside;
        echo '<section class="section_main">
        
          <section>
							<div class="section cadastra-pro">
								<!--<div class="botao-voltar">
									<a href="./" class="btn-voltar">Voltar</a>
								</div>-->
								
								<div class="lista-corpo">
									<div class="sub-title">
										<h2 class="geral-title-terceiar">Cursos</h2>
									</div>';
									require_once"../../../layout/alert.php";
									if(listaCursoA($public)!=Null && listaDepartamentoExpecificado($index_idDeparta)){
								echo'
								<ul>';
								
								$dadosD = listaDepartamentoExpecificado($index_idDeparta);
												$d = new ArrayIterator($dadosD);
												while ($d->valid()){     
													echo'<li><h3 class="geral-title-h3">'. $d->current()->NomeDeparta.'</h3>';
													$idDeparta = $d->current()->idDeparta;
													if( listaCurso($idDeparta,$public)){
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th" title="Codigo de Curso">ID</th>
									 			<th class="tabela-head-th">NOME</th>
												 <th class="tabela-head-th">TURMA</th>
												 <th class="tabela-head-th">QUANT.PROFE</th>
												<th class="tabela-head-th">QUANT.DISCPLINA</th>
												<th class="tabela-head-th">QUANT.ALUNO</th>
									 			<th class="tabela-head-th">Ações</th>
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
											$dados = listaCurso($index_idDeparta,$public);
											$dado = new arrayIterator($dados);
											$count = 0;
											//DECLARAÇÃO QUANTIDADE
											$tProfessor = 0;
											$tDisciplina = 0;
											$tAluno = 0;
											$tTurma = 0;
											//FUNÇÃO QUE LISTA TODOS OS DADOS DOS CURSO
											while ($dado->valid()){
											$idcurso = $dado->current()->idCurso;
											$quantDisciplina = listaDisciplinaCurso($idcurso,$anoLetivo,$public);
											$quantProfessor = listaQuantProfessor($idcurso,$public);
											$quantTurma				= listaQuantTurma($anoLetivo,$index_idDeparta,$public,$idcurso);
											$aluno = buscaAlunoCurso($idcurso,$public,$anoLetivo);
											$quanAnoEscolar = quantidadeAnoescolaCurso($public,$idDeparta,$anoLetivo,$idcurso);
											
											
										 echo '
											<tr class="tabela-body-tr">
												<td class="tabela-body-td">
													<form method="post" action="action.php">
														<input type="hidden" name="id" id="status" value="'.$dado->current()->idCurso.'">
														<input type="hidden" name="status" id="status" value="'.$dado->current()->Ativo.'">
														<input type="checkbox" name="status" id="status"'; if($dado->current()->Ativo==1){ echo "checked";} echo' value="'.$dado->current()->Ativo.'"
															 onclick="this.form.submit();">
														
													</form>
												</td>
												<td class="tabela-body-td">'.$dado->current()->idCurso.'</td>
												<td class="tabela-body-td">'.$dado->current()->NomeCurso.'</td>
												<td class="tabela-body-td"><a href="../turma/lista-turma.php?idCurso='. $dado->current()->idCurso.'&&acao=buscaAlunoCurso&&nomeCurso='.$dado->current()->NomeCurso.'">'.$quantTurma.'</a></td>
												<td class="tabela-body-td"><a href="../professor/lista-professor.php?idCurso='.$dado->current()->idCurso.'&&nomeCurso='.$dado->current()->NomeCurso.'">'.$quantProfessor.'</a></td>
												<td class="tabela-body-td"> <a href="../disciplina/?idCurso='.$dado->current()->idCurso.'&&acao=buscaAlunoCurso&&nomeCurso='.$dado->current()->NomeCurso.'">'.$quantDisciplina.'</a></td>
												<td class="tabela-body-td"><a href="../aluno/lista-aluno.php?idCurso='. $dado->current()->idCurso.'&&acao=buscaAlunoCurso&&nomeCurso='.$dado->current()->NomeCurso.'">'.$aluno.'</a></td>
									 			<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="'.$url2.'adminA/curso/edita.php?id='.$dado->current()->idCurso.'&& idD='.$d->current()->idDeparta.'" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
									 				</span>
									 				<span class="span-img-delete">
									 					<a href=""><img src="'.$url2.'assets/img/elimina.png" class="img delete" /></a>
									 				</span>
									 			</td>

											</tr>
											';
												$tProfessor = 	$tProfessor + $quantProfessor;
												$tAluno = $tAluno + $aluno;
												$tDisciplina = $tDisciplina + $quantDisciplina;
												$tTurma += $quantTurma;
											$count = $count + 1;
										 $dado->next();}
											
											echo '
											<tr class="tabela-body-tr" style="background:#66ffd8 !important;">
												<td class="tabela-body-td" colspan="2">TOTAL</td>
												<td class="tabela-body-td">'.$count.'</td>
												<td class="tabela-body-td">'.$tTurma.'</td>
												<td class="tabela-body-td">'.$tProfessor.'</td>
												<td class="tabela-body-td">'.$tDisciplina.'</td>
												<td class="tabela-body-td">'.$tAluno.'</td>
													<td class="tabela-body-td" colspan=""></td>
											</tr>
										</tbody>
									</table>';
											}else{
												echo "0 Sem curso";
											}
								echo'	</li>';
												  $d->next();
                              }
									echo'</ul>';
								}else{
									echo '
										<div class="corpo-message0">
											<div class="message0">
												<p class="">Nenhum dados ou Curso registrado!<br/>
												<a href="cadastra-curso.php">Por favor adicione  Curso para poder  visualizar</a></p>
											</div>
										</div>
										';
								}
								echo'
								</div>
								<table class="tabela-b">
									<tr>
										<td class="tabela-b-td">
										<div class="corpo-btn-add btn-div">
												<a href="../" class=" tabela-btn-voltar estilo-btn">Voltar</a>
											</div>
											<div class="corpo-btn-inativo btn-div">
													<form method="post" action="">
														
														<button type="submit" class="btn-inativo estilo-btn" name="public" value="'.$public.'">'.$btn_public.'</button>
														
													</form>
												</div>
												<div class="corpo-btn-add btn-div">
													<a href="cadastra-curso.php" class=" btn-add estilo-btn">Adiciona</a>
												</div>
												<div class="corpo-btn-mostra btn-div">
													<a href="" class="btn-mostra estilo-btn"> Ocultar dados</a>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
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
      }
?>
