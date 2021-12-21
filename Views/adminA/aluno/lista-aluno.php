﻿<?php
  require_once "../../../config/auth.php";
  if($permissao ==2){
    $public  = 1;
    /*
      VERIFICA SE EXISTE UM IDCURSO
    */
    if((isset($_GET['idCurso']) && $_GET["idCurso"]>0)&& (isset($_GET["acao"])&& $_GET["acao"]=="buscaAlunoCurso")){

   $idCurso = $_GET['idCurso'];
   $nomeCurso =   $_GET['nomeCurso'];;
   
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Aluno</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
        require_once "../layout/layout.php";
				//require_once "../../../App/Models/curso.php";
        require_once "../../../App/Models/aluno.php";
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
										<h2 class="geral-title-terceiar">Aluno-<small>'.$messagem.'</small></h2>
                  </div>';
                  //VERIFICA SE A FUNÇÃO LISTA-ALUN-OCUROS TRAZ VALOR MAIOR QUE O ZERO
                  if(listaAlunoCurso($idCurso,$public,$anoLetivo)){
								echo'
								<ul>
                    	<li><h3 class="geral-title-h3">'.$nomeCurso.'</h3>';
                    $dados =listaAlunoCurso($idCurso,$public,$anoLetivo);
                  //  print_r($dados);
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th">ID</th>
                         <th class="tabela-head-th">NOME</th>
                         <th class="tabela-head-th">Telefone</th>
                         <th class="tabela-head-th">Bairro</th>
												 <th class="tabela-head-th">Sexo</th>
												 <th class="tabela-head-th">Logado</th>
												<th class="tabela-head-th">Ações</th>
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
											$dado = new arrayIterator($dados);
											$count = 1;
											while ($dado->valid()){
										
										
								
											
										 echo '
											<tr class="tabela-body-tr">
												<td class="tabela-body-td">
													<form method="post" action="action.php">
														<input type="hidden" name="id" id="status" value="'.$dado->current()->idAluno.'">
														<input type="hidden" name="status" id="status" value="'.$dado->current()->Aluno_Ativo.'">
														<input type="checkbox" name="status" id="status"'; if($dado->current()->Aluno_Ativo==1){ echo "checked";} echo' value="'.$dado->current()->Aluno_Ativo.'"
															 onclick="this.form.submit();">
														
													</form>
												</td>
												<td class="tabela-body-td">'.$count.'</td>
                         <td class="tabela-body-td"><a href="aluno.php?idAluno='.$dado->current()->idAluno.'&&acao=buscaDadosAluno">'.$dado->current()->NomePessoa.'</a></td>
                         <td class="tabela-body-td">'.$dado->current()->Telefone.'</td>
                         <td class="tabela-body-td">'.$dado->current()->Bairro.'</td>
												<td class="tabela-body-td">'.$dado->current()->Sexo.'</td>
                        <td class="tabela-body-td">'; 
                        	if($dado->current()->login_idLogin !=null){echo"SIM";}else{echo"Não";}
												echo'
												</td>
												<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="'.$url2.'AdminA/aluno/edita.php?idAluno='.$dado->current()->idAluno.'&&aluno=editaAluno" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
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
												<p class="">Nenhum Aluno '.$messagem.'!<br/></p>
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
          //VERIFICA SE EXISTE UM ID CURSO
          header("location:".$url2."secretario/curso/");
        }
      }else{
        header("location:".$url."login.php");
        //VERIFICA A PERMISSÃO
      }
?>
