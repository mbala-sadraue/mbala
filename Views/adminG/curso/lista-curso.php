<?php
  require_once "../../../config/auth.php";
  if($permissao ==1){//VERIFICA A PERMISSÃO
    if((isset($_GET["idDeparta"])&& $_GET["idDeparta"]>0)&& (isset($_GET["nomeDeparta"])&& $_GET["nomeDeparta"] != null )){
      $idDeparta = $_GET["idDeparta"];
     $nomeDeparta = $_GET["nomeDeparta"];
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
									if(listaCursoA($public)!=Null && listaDepartamento()){
								echo'
								<ul>';
							   
													echo'<li><h3 class="geral-title-h3">'.$nomeDeparta.'</h3>';
													
													
													if( listaCurso($idDeparta,$public)){
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th">CODIGO</th>
									 			<th class="tabela-head-th">NOME</th>
												 <th class="tabela-head-th">Q.Disciplina</th>
												 <th class="tabela-head-th">Q.Aluno</th>
									 			<th class="tabela-head-th">Ações</th>
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
											$dados = listaCurso($idDeparta,$public);
											$dado = new arrayIterator($dados);
											
											$count = 1;
											while ($dado->valid()){
											$idcurso = $dado->current()->idCurso;
											$quantDisciplina = listaDisciplinaCurso($idcurso,$anoLetivo,$public);
											$idcurso = $dado->current()->idCurso;
											$aluno = buscaAlunoCurso($idcurso,$anoLetivo,$public);
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
												<td class="tabela-body-td"><a href="../disciplina/?idDeparta='.$idDeparta.'">'.$quantDisciplina.'</a></td>
									 			<td class="tabela-body-td"><a href="../aluno/lista-aluno.php?idCurso='. $dado->current()->idCurso.'&&acao=buscaAlunoCurso&&nomeCurso='.$dado->current()->NomeCurso.'">'.$aluno.'</a></td>
									 			<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="'.$url2.'adminG/curso/edita.php?id='.$dado->current()->idCurso.'&& idD='.$idDeparta.'" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
									 				</span>
									 				<span class="span-img-delete">
									 					<a href=""><img src="'.$url2.'assets/img/elimina.png" class="img delete" /></a>
									 				</span>
									 			</td>

											</tr>';
											$count = $count + 1;
										 $dado->next();}
											
											echo '
										</tbody>
									</table>';
											}else{
												echo "0 Sem curso";
											}
								echo'	</li>';
												
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
                echo "Você não possui permissão";
              }
      }else{//VERIFICA A PERMISSÃO
        header("location:".$url."login.php");
      }
?>
