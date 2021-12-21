<?php
  require_once "../../../config/auth.php";
  if($permissao ==2){// VERIFICA A PERMISSÃO
    if((isset($_GET["idCurso"])&& $_GET["idCurso"]>0)&&(isset($_GET["nomeCurso"])&& $_GET["nomeCurso"]!= null) ){
      $idCurso = $_GET["idCurso"];
      $nomeCurso = $_GET["nomeCurso"];
    $public  = 1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Professor</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
        require_once "../layout/layout.php";
        require_once "../../../App/Models/professor.php";
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
										<h3 class="geral-title-terceiar">Professores de '.$nomeCurso.'</h3>
									</div>';
									if(listaProfessorExpecificandoCurso($public,$idCurso)!=Null){
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th">CODIGO</th>
									 			<th class="tabela-head-th">NOME</th>
									 			<th class="tabela-head-th">TELEFONE</th>
									 			<th class="tabela-head-th">E-MAIL</th>
									 			<th class="tabela-head-th">Sexo</th>
									 			<th class="tabela-head-th">Permissão</th>
									 			<th class="tabela-head-th">Ações</th>
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
                    
											$dados = listaProfessorExpecificandoCurso($public,$idCurso);
                      //print_r($dados);
											$dado = new arrayIterator($dados);
											while ($dado->valid()){
										 echo '
											<tr class="tabela-body-tr">
												<td class="tabela-body-td">
													<form method="post" action="action.php">
														<input type="hidden" name="id" id="status" value="'.$dado->current()->id_profe_curso.'">
														<input type="hidden" name="status" id="status" value="'.$dado->current()->professor_Ativo.'">
														<input type="checkbox" name="status" id="status"'; if($dado->current()->professor_Ativo==1){ echo "checked";} echo' value="'.$dado->current()->professor_Ativo.'"
															 onclick="this.form.submit();">
														
													</form>
												</td>
												<td class="tabela-body-td">'.$dado->current()->id_profe_curso.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->NomePessoa.'
									 			</td>
									 			<td class="tabela-body-td">'.$dado->current()->Telefone.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->Email.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->Sexo.'</td>
									 			<td class="tabela-body-td">Professor</td>
									 			<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="'.$url2.'adminA/professor/edita.php?id='.$dado->current()->idProfessor.'" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
									 				</span>
									 				<span class="span-img-delete">
									 					<a href=""><img src="'.$url2.'assets/img/elimina.png" class="img delete" /></a>
									 				</span>
									 			</td>

											</tr>';
										 $dado->next();}
											
											echo '
										</tbody>
									</table>';
								}else{
									echo '
										<div class="corpo-message0">
											<div class="message0">
												<p class="">Nenhum dados ou Professor encontrado!<br/>
												<a href="cadastra-professor.php">Por favor adicione  Usuarios para poder  visualizar</a></p>
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
													<a href="'.$url2.'adminA/professor/cadastra-professor.php" class=" btn-add estilo-btn">Adiciona</a>
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
              }else{//VERIFICA SE EXISTE IDCURSO E NOME DO CURSO ATRAVÉZ DO MÉTODO GET
								echo"else";
                header("location:".$url."Views/adminA/curso");
              }
      }else{// VERIFICA PERMISSÃO
        header("location:".$url."login.php");
      }
?>
