<?php
  require_once "../../../config/auth.php";
  if($permissao ==2){
    $public  = 1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Administrador</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
        require_once "../layout/layout.php";
        require_once "../../../App/Models/administrativa.php";
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
										<h3 class="geral-title-terceiar">Administrador</h3>
									</div>';
									require_once"../../../layout/alert.php";
									if(listaAdministrativa($public)!=Null){
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th">ID</th>
									 			<th class="tabela-head-th">NOME</th>
									 			<th class="tabela-head-th">TELEFONE</th>
									 			<th class="tabela-head-th">E-MAIL</th>
									 			<th class="tabela-head-th">Sexo</th>
									 			<th class="tabela-head-th">Permissão</th>
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
											$dados = listaAdministrativa($public);
											$dado = new arrayIterator($dados);
											while ($dado->valid()){
										 echo '
											<tr class="tabela-body-tr">
												<td class="tabela-body-td">
												'; 
												if($dado->current()->admina_Ativo==1){ echo "Ativo";}else{ echo"Desativo";}
															
												echo'</td>
												<td class="tabela-body-td">'.$dado->current()->idAdminA.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->NomePessoa.'
									 			</td>
									 			<td class="tabela-body-td">'.$dado->current()->Telefone.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->Email.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->Sexo.'</td>
									 			<td class="tabela-body-td">Adiministrador
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
												<p class="">Nenhum dados ou Usuario registrado!<br/>
												<a href="adicionausuario.php">Por favor adicione  Usuarios para poder  visualizar</a></p>
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
        header("location:".$url."login.php");
      }
?>
