<?php
  require_once "../../../config/auth.php";
  if($permissao ==2){
    $public  = 1;
		 if(isset($_GET["idCurso"]) && $_GET["idCurso"]>0){
		 
			$idCurso = $_GET["idCurso"];
			$nomeCurso = $_GET["nomeCurso"];
			$ativo = 1;
    /*
      VERIFICA SE EXISTE UM IDCURSO
    */
   
   
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Turma da <?php echo $nomeCurso ?></title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
        require_once "../layout/layout.php";
			
       	require_once "../../../App/Models/turma.php";
			  require_once "../../../App/Models/disciplina.php";
				require_once "../../../App/Models/aluno.php";
								require_once "../../../App/Models/professor.php";

        if(isset($_POST['public'])){
          $value = $_POST['public'];
          if($value == 1){
            $public = 0;
						$btn_public = 'Publicado';
						$messagem = "Inativos";
          }else{
            $public = 1;
						$btn_public = 'Inativo';
						$messagem = "Ativo";
          }
        }else{
          $public = 1;
					$btn_public = 'Inativo';
						$messagem = "Ativo";
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
										<h2 class="geral-title-terceiar">Turmas da <small>'.$nomeCurso.'</small></h2>
                  </div>';
									require_once"../../../layout/alert.php";
                  //VERIFICA SE A FUNÇÃO LISTA-TURMA TRAZ VALOR MAIOR QUE O ZERO
                  if(listarTurma2($anoLetivo,$index_idDeparta,$public,$idCurso)){
								echo'
								<ul>
                    	<li><h3 class="geral-title-h3">Lista de Turma da '.$nomeCurso.'</h3>';
                    $dados =	listarTurma2($anoLetivo,$index_idDeparta,$public,$idCurso);
                 // print_r($dados);
									 
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
                        <th class="tabela-head-th">POSIÇÃO</th>
												<th class="tabela-head-th">ANO ESCOLAR</th>
                        <th class="tabela-head-th">TURMA</th>
												<th class="tabela-head-th" title="Quantidade de Alunos">Q.A</th>
												<th class="tabela-head-th" title="Quantidade de Professores">Q.P</th>
												<th class="tabela-head-th" title="Quantidade de Disciplinas">Q.D</th>
												<th class="tabela-head-th">SALA</th>
                        <th class="tabela-head-th">Diretor</th>
                        <th class="tabela-head-th">VAGA</th>
                        <th class="tabela-head-th">AÇÕES</th>
                         
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
											$dado = new arrayIterator($dados);
											$count = 1;	
											while ($dado->valid()){
												$idCurso				= $dado->current()->idCurso;
												$idAnoEscolar 	= $dado->current()->idAnosEscolares;
												$idAnoletivo 		= $dado->current()->letivo_idAno_letivo;
												$quantDsciplina = disciplinaTurma($idCurso,$idAnoEscolar,$idAnoletivo);
												$idTurma 				= $dado->current()->idTurma;
												$anoEscolar 		= $dado->current()->idAnosEscolares;
												$quantAluno 		= turmaAluno($dados = array(1=>$idTurma,$idCurso,$anoEscolar,$anoLetivo,$index_idDeparta,$ativo));
												$quantProfessor	= professorTurma($idCurso,$idAnoEscolar,$idAnoletivo);
												$NomeTurma			= $dado->current()->NomeTurma;
												$NomeCurso			= $dado->current()->NomeCurso;
												$sala						= $dado->current()->Sala;
												$nomeAnoEscolar = $dado->current()->NomeAnoEscolar;
										
										 echo '
											<tr class="tabela-body-tr">
												<td class="tabela-body-td">
												<form method="post" action="action.php">
												<input type="hidden"  name="id" value="'.$dado->current()->idTurma.'"/>
												<input type="hidden"  name="status" value="'.$dado->current()->TurmaAtivo.'"/>
													<input type="checkbox" onclick="this.form.submit()" name="status" ';
														if($dado->current()->TurmaAtivo==1){
															echo 'checked value="'.$dado->current()->TurmaAtivo.'"';
														}else{
															echo 'value="'.$dado->current()->TurmaAtivo.'"';
														}
													echo'/>
												</form>';
												
												echo'</td>
												<td class="tabela-body-td">'.$count.'</td>
												<td class="tabela-body-td">'.$dado->current()->NomeAnoEscolar.'</td>
                        <td class="tabela-body-td"><a href="">'.$dado->current()->NomeTurma.'</a></td>
												<td class="tabela-body-td"><a href="../aluno/lista-aluno-turma.php?idTurma='.$idTurma.'&NomeTurma='.$NomeTurma.'&idCurso='.$idCurso.'&NomeCurso='.$NomeCurso.'&idAnoEscolar='.$idAnoEscolar.'&nomeAnoEscolar='.$nomeAnoEscolar.'&sala='.$sala.' ">'.$quantAluno.'</a></td>
												<td class="tabela-body-td"><a href="../professor/lista-professor-turma.php?idTurma='.$idTurma.'&NomeTurma='.$NomeTurma.'&idCurso='.$idCurso.'&NomeCurso='.$NomeCurso.'&idAnoEscolar='.$idAnoEscolar.'&nomeAnoEscolar='.$nomeAnoEscolar.'&sala='.$sala.' ">'.$quantProfessor.'</a></td>
												<td class="tabela-body-td"><a href="../disciplina/disciplina-turma.php?idTurma='.$idTurma.'&NomeTurma='.$NomeTurma.'&idCurso='.$idCurso.'&NomeCurso='.$NomeCurso.'&idAnoEscolar='.$idAnoEscolar.'&nomeAnoEscolar='.$nomeAnoEscolar.'&sala='.$sala.' ">'.$quantDsciplina.'</a></td>
												
												<td class="tabela-body-td"><a href="">'.$dado->current()->Sala.'</a></td>
                        <td class="tabela-body-td">'.$dado->current()->Diretor.'</td>
												
                       <td class="tabela-body-td">'.$dado->current()->Vaga.'</td>
												<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="'.$url2.'adminA/turma/edita.php?id='.$dado->current()->idTurma.'" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
									 				</span>
									 			</td>
											</tr>
											</tr>';
											$count = $count + 1;
										 $dado->next();}
											
											echo '
										</tbody>
									</table>';
										
								echo'	</li>';
												 
									echo'</ul>';
								}else{
									echo '
										<div class="corpo-message0">
											<div class="message0">
												<p class="">Nenhum turma '.$messagem.'!<br/></p>
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

							}    
      }else{
        header("location:".$url."login.php");
        //VERIFICA A PERMISSÃO
      }
?>
