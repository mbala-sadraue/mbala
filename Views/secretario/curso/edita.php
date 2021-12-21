<?php	
	require_once "../../../config/auth.php";
	if($permissao ==2){
			if(isset($_GET["id"])&& $_GET["id"]>0 && isset($_GET["idD"])&& $_GET["idD"]>0 ){
		$id = $_GET["id"];
	 $idDeparta = 	$_GET["idD"]
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Curso</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
	<div class="corpo">
		<div class="sub_corpo">
			<?php  
        require_once "../layout/layout2.php";
        require_once "../../../App/Models/departamento.php";
				require_once "../../../App/Models/curso.php";
				echo $header;
			
				 echo '<div class="corpo_geral">';
				 	echo $aside;
				echo '<section class="main_section">
					<div class="section_main">
						<header class="section_header">
							<h1 class="section_header_h1">Editar Curso</h1>
						</header>
					</div>
					<article class="article_main">
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Curso</h3>
							</div>';
					if(is_array(buscaCurso($id))){
					echo'<form class="form_main" method="post" action="'.$urlF2.'insertcurso.php">';
					$dados = buscaCurso($id);
                      $dado   = new ArrayIterator($dados);
                      while ($dado->valid()){
			echo'<div class="group-form">
									<label class="form_label">Nome de Curso</label>
									<input type="" name="nome_curso" id="input_valida"value="'.$dado->current()->NomeCurso.'" title="Nome de Curso" class="form_input_main" placeholder="Digite o nome de Curso">
									<input type="hidden" name="idCurso" id="input_valida"value="'.$dado->current()->idCurso.'">
								</div>
              <div class="group-form">
                    <input type="hidden" name="departamento" value="'.$index_idDeparta.'"/>
								</div>';
								$dado->next();					
							}
						echo'<input type="hidden" name="Editar" value="Curso">
								<input type="hidden" name="idusuario" value="'.$idUsuario.'">
								<div>
									<button class="btn_cadastra" id="btn_cadastra">Editar</button>
									<a href="../" class="btn_cansela">Cansela</a>
								</div>
							</form>';
							//VALIDA DADOS 
			echo'	</div>
						<div class="section_article">
							<div class="">
								<h3 class="article_h3">Curso Existente</h3>
							</div>
							<ul class="article_ul">';
							$count = 1;
							$ativo = 1;
								$dados2 =  listaCurso($index_idDeparta,$ativo);
								$d1 = new ArrayIterator($dados2);
								while($d1->valid()){
									echo'<li>
										<a href="" class="article_ul_a">'.$count.' -> '.$d1->current()->NomeCurso.'</a>
									</li>';
									$count = $count + 1;
									$d1->next();
								}
					echo'</ul>
						</div>';
						}else{
                 echo "Nenha dados foi encotrado";
               }
				echo'	</article>
				</section>';
				
				 echo'</div>
					 <script type="text/javascript" src="../assets/js/jquery.js"></script>
    				<script type="text/javascript" src="../assets/js/main.js"></script>'
    				;
				echo $javascript;
				echo $fim;
				
				}else{
						header("location:".$url."login.php");
				}//VALIDA ID VINDO DO GET
			}else{
				header("location:".$url."login.php");
			}// VALIDA A PERMISSÃO
?>