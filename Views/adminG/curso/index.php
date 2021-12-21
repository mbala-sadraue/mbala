<?php
  require_once "../../../config/auth.php";
  if($permissao ==1 ){
		require_once "../../../App/Models/departamento.php";   
		 $public  = 1;
		$por_pagina = 1;
		$quantDepartamento = 	listaQuanitadeDepartamentoDinamico();
		$quantPor_pagina = ceil($quantDepartamento / $por_pagina );
	
	if(isset($_GET["pg"])){
		$pg = $_GET["pg"];
		if($pg<1){
			$pg = 1;
		}elseif($pg > $quantPor_pagina){
				$pg = 6;
		}else{
			$pg =  $pg;
		}
	}else{
		$pg = 1;
	}
		$inicio  = ($pg * $por_pagina) - $por_pagina;
		$antes = 1; $depois = 2;

		$antes	= $pg-1;
		$depois	= $pg+1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Curso</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<style>
	.btn_controles{
		display:flex;
		justify-content:space-between;
		padding: 2.5%;
		
	}
	.btn_i{
		padding:0.2% 2%;
		background:red;
		color:#fff;
	}
</style>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
        require_once "../layout/layout.php";
				require_once "../../../App/Models/curso.php";
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
										<h3 class="geral-title-terceiar">CURSOS</h3>
									</div>';
									if(listaCursoA($public)!=Null && listaDepartamentoDinamico($inicio,$por_pagina)){
								echo'
								<ul>';
								$dadosD =listaDepartamentoDinamico($inicio,$por_pagina);
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
											$dados = listaCurso($idDeparta,$public);
											$dado = new arrayIterator($dados);
											
											$count = 1;
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
											$aluno = buscaAlunoCurso($idcurso,$public,$anoLetivo);
											$quantTurma				= listaQuantTurma($anoLetivo,$idDeparta,$public,$idcurso);
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
												<td class="tabela-body-td"><a href="../turma/lista-turma.php?idCurso='. $dado->current()->idCurso.'&acao=buscaAlunoCurso&nomeCurso='.$dado->current()->NomeCurso.'&idDeparta='.$idDeparta.'">'.$quantTurma.'</a></td>
												<td class="tabela-body-td"><a href="../professor/lista-professor.php?idCurso='.$dado->current()->idCurso.'&&nomeCurso='.$dado->current()->NomeCurso.'">'.$quantProfessor.'</a></td>
												<td class="tabela-body-td"><a href="../disciplina/?idCurso='.$dado->current()->idCurso.'&&nomeCurso='.$dado->current()->NomeCurso.'">'.$quantDisciplina.'</a></td>
									 			<td class="tabela-body-td"><a href="../aluno/lista-aluno.php?idCurso='. $dado->current()->idCurso.'&&acao=buscaAlunoCurso&&nomeCurso='.$dado->current()->NomeCurso.'">'.$aluno.'</a></td>
									 			<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="edita.php?id='.$dado->current()->idCurso.'&& idD='.$d->current()->idDeparta.'" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
									 				</span>
									 				<span class="span-img-delete">
									 					<a href=""><img src="'.$url2.'assets/img/elimina.png" class="img delete" /></a>
									 				</span>
									 			</td>

											</tr>';
												$tProfessor = 	$tProfessor + $quantProfessor;
												$tAluno = $tAluno + $aluno;
												$tDisciplina = $tDisciplina + $quantDisciplina;
												$tTurma += $quantTurma;
											$count = $count + 1;
										 $dado->next();}
											
											echo '
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
								<div class ="btn_controles">
								';
										if($pg>1){
											echo '<a href="?pg='.$antes.'">Antes</a>';
										}
									for($i = 1; $i <= $quantPor_pagina; $i++){
											if($i == $pg){
												echo '<span class="btn_i">'.$i.'</span>';
											}else{
													echo '<a href="?pg='.$i.'">'.$i.'</a>';
											}
									}
									if($pg>=1 && $pg<$quantPor_pagina){
										echo '<a href="?pg='.$depois.'">Depois</a>';	
									}
								echo '
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
