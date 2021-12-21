<?php
  require_once "../../../config/auth.php";
  if($permissao ==1){
    $public  = 1;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Departamento</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
          require_once "../layout/layout.php";
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
										<h3 class="geral-title-terceiar">DEPARTAMENTO</h3>
									</div>';
									require_once"../../../layout/alert.php";
									if(listaDepartamentoIndex($public)!=Null){
								echo'
									<table class="tabela table">
										<thead class="tabela-head">
											<tr>
												<th class="tabela-head-th">ATIVO/D</th>
												<th class="tabela-head-th">CODIGO</th>
												 <th class="tabela-head-th">NOME DO DEPARTAMENTO</th>
												 <th class="tabela-head-th">Q.Cursos</th>
                         	<th class="tabela-head-th">CADASTRADO</th>
									 			<th class="tabela-head-th">Ações</th>
											</tr>
										</thead>
										<tbody class="tabela-body">
										';
											$dados = listaDepartamentoIndex($public);
											$dado = new arrayIterator($dados);
											while ($dado->valid()){
										 	$id = $dado->current()->idDeparta;
											$dadoC	= listaCursoDepartamento($public,$id);
											$curso = $dadoC[0]["COUNT(*)"];
										 echo '
											<tr class="tabela-body-tr">
												<td class="tabela-body-td">
													<form method="post" action="action.php">
														<input type="hidden" name="id" id="status" value="'.$dado->current()->idDeparta.'">
														<input type="hidden" name="status" id="status" value="'.$dado->current()->departa_Ativo.'">
														<input type="checkbox" name="status" id="status"'; if($dado->current()->departa_Ativo==1){ echo "checked";} echo' value="'.$dado->current()->departa_Ativo.'"
															 onclick="this.form.submit();">
														
													</form>
												</td>
												<td class="tabela-body-td">'.$dado->current()->idDeparta.'</td>
									 			<td class="tabela-body-td">'.$dado->current()->NomeDeparta.'
												 </td>
												 	<td class="tabela-body-td"><a href="../curso/lista-curso.php?idDeparta='.$dado->current()->idDeparta.'&&nomeDeparta='.$dado->current()->NomeDeparta.'">'.$curso.'</a></td>
									 			<td class="tabela-body-td">'.$dado->current()->idAdminG.'</td>
									 			<td class="tabela-body-td">
                           <span class="span-img-edite">
                           <a href="'.$url2.'adminG/departamento/edita.php?idDeparta='.$dado->current()->idDeparta.'" ><img src="'.$url2.'assets/img/edita.png"  class="img edita"/></a>
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
												<p class="">Nenhum dados ou departamento registrado!<br/>
												<a href="departamento.php">Por favor adicione  departamento para poder  visualizar</a></p>
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
													<a href="'.$url2.'adminG/departamento/departamento.php" class=" btn-add estilo-btn">Adiciona</a>
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
