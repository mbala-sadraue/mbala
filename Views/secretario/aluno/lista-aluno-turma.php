<?php
  require_once "../../../config/auth.php";
  if($permissao ==3){
    $public  = 1;
    /*
      VERIFICA SE EXISTE UM IDCURSO
    */
    if((isset($_GET['idCurso']) && $_GET["idCurso"]>0) && (isset($_GET["idAnoEscolar"])&& $_GET["idAnoEscolar"]>0)){

   $idCurso 				= $_GET['idCurso'];
   $nomeCurso 			= $_GET['NomeCurso'];
	 $idTurma 				= $_GET['idTurma'];
   $nomeTurma 			= $_GET['NomeTurma'];
	 $idAnoEscolar		= $_GET['idAnoEscolar'];
   $nomeAnoEscolar 	= $_GET['nomeAnoEscolar'];
   
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> <?php echo "$nomeCurso $nomeAnoEscolar"; ?></title>
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
                  if(listaAlunoTurma($idCurso,$idTurma,$idAnoEscolar,$public,$anoLetivo)){
								echo'
								<ul>
                    	<li><h3 class="geral-title-h3">'.$nomeCurso.' - '.$nomeAnoEscolar.' turma '.$nomeTurma.'</h3>';
                    $dados =listaAlunoTurma($idCurso,$idTurma,$idAnoEscolar,$public,$anoLetivo);
                  //  print_r($dados);
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th">CODIGO</th>
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
												<td class="tabela-body-td">';
													if($dado->current()->Aluno_Ativo ==1){echo"Ativo";}else{echo"Desativo";}
												echo'</td>
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
                           <a href="" ><img src="'.$url2.'assets/img/elimina.png"  class="img edita"/></a>
									 				</span>
									 			</td>
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
          header("location:".$url2."adminA/curso/");
        }
      }else{
        header("location:".$url."login.php");
        //VERIFICA A PERMISSÃO
      }
?>
