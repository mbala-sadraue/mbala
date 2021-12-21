<?php
	require_once "../../../config/auth.php";
  if($permissao ==1){ // VERIFICA A PERMISSÃO
    if(isset($_GET["idDeparta"]) && $_GET["idDeparta"]>0){
      $idDepartamento = $_GET["idDeparta"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastra Departamento</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
				require_once "../layout/layout2.php";
				require_once "../../../App/Models/departamento.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Atualizar o Departamento</h1>
						</header>
					</div>
					<article class="article_main">
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Atualizar Departamento</h3>
              </div>';
              if(listaDepartamentoExpecificado($idDepartamento)){  //VERIFICA SE A RETORNO DE DADOS
                $dados = listaDepartamentoExpecificado($idDepartamento);
                
                $d = new ArrayIterator($dados);
                while($d->valid()){ // LOP PARA LISTAR OS DADOS DO CURSO
						echo'	<form class="form_main" method="post" action="'.$urlF2.'insertdeparta.php">
								<div class="group-form">
									<label class="form_label">Nome de Departamento</label>
                  <input type="text" name="nome_departamento" value="'.$d->current()->NomeDeparta.'"id="input_valida" title="Nome" class="form_input_main" placeholder="Digite o nome de departamento">
                  <input type="hidden" name="idDeparta" value="'.$d->current()->idDeparta.'"/>
								</div>
								<input type="hidden" name="atualizar" value="departamento">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
								<div>
									<button class="btn_cadastra" id="btn_cadastra">Editar</button>
									<a href="./" class="btn_cansela">Cansela</a>
								</div>
               </form>';
               $d->next();
                }
              }else{
                echo"O departamento não foi encontrado c:";
              }//VERIFICA SE A RETORNO DE DADOS
						echo'</div>
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Departamento Existente</h3>
							</div>
							<ul class="article_ul">';
							$count = 1;
							if($dados = listaDepartamento(1)){
								$dados = listaDepartamento(1);
								$d = new ArrayIterator($dados);
								while($d->valid()){
									echo'<li>
										<a href="" class="article_ul_a">'.$count.' -> '.$d->current()->NomeDeparta.'</a>
									</li>';
									$count = $count + 1;
									$d->next();
								}
							}else{
								echo "Não foi encontrado departamento ativo";	
							}

					echo'</ul>
						</div>
					</article>
				</section>';
				 echo'</div>
					 <script type="text/javascript" src="../assets/js/jquery.js"></script>
    				<script type="text/javascript" src="../assets/js/main.js"></script>'
    				;
				echo $javascript;
        echo $fim;
            }else{// VERIFICA SE EXISTE UM IDCURSO NO  MÉTODDO GET
              header("location:index.php");
            }
			}else{// VERIFICA A PERMISSÃO
				header("location:".$url."login.php");
			}
?>
