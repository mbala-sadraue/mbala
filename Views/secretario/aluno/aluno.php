<?php
  require_once "../../../config/auth.php";
  if($permissao ==3){
    $public  = 1;
    /*
      VERIFICA SE EXISTE UM IDCURSO
    */
    if((isset($_GET['idAluno']) && $_GET["idAluno"]>0)&& (isset($_GET["acao"])&& $_GET["acao"]=="buscaDadosAluno")){

   $idAluno = $_GET['idAluno'];
   
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dado do Aluno</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/estilo4.css">
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
										<h2 class="geral-title-terceiar">Dados do Aluno</h2>
                  </div>';
                  //VERIFICA SE A FUNÇÃO LISTA-ALUNO-CUROS TRAZ VALOR MAIOR QUE O ZERO
                  if(listaDadosAluno($idAluno)){
							
                    $dados =listaDadosAluno($idAluno);
								//	 print_r($dados);
										$dado = new arrayIterator($dados);
											$count = 1;
											while ($dado->valid()){
								echo'
										<article class="article_main_form">
						<div class="section_article">
							<div class="conteudo-felt">
								<h3 class="article_h3">Dados do(a) aluno(a) '.$dado->current()->NomePessoa.'</h3>
							</div>
							<section class="section_dados">
								<div class="conteudo-left">
									<article class="article_dados">
										<nav class="dado-nav">
											<ul class="dados-ul">
												<h3 class="h3-dados">Dados Pessoais</h3>
												<li class="section_aluno_li">
													<span class="span_left">Nome: </span><span class="span_lright">'.$dado->current()->NomePessoa.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Nascimento: </span><span class="span_lright">'.date("d/m/Y",strtotime($dado->current()->Nascimento)).'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Sexo: </span><span class="span_lright">'.$dado->current()->Sexo.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Telefone: </span><span class="span_lright">'.$dado->current()->Telefone.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Email: </span><span class="span_lright">'.$dado->current()->Email.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Encarregado: </span><span class="span_lright">'.$dado->current()->NomeEncarregado.'</span>
												</li>
											</ul>
											<ul class="dados-ul">
												<h3 class="h3-dados">Localização</h3>
												<li class="section_aluno_li">
													<span class="span_left">Provincia: </span><span class="span_lright">'.$dado->current()->Cidade.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Munícipio: </span><span class="span_lright">'.$dado->current()->Municipio.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Bairro: </span><span class="span_lright">'.$dado->current()->Bairro.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">................</span><span class="span_lright">..............</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">................</span><span class="span_lright">..............</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">................</span><span class="span_lright">..............</span>
												</li>
											</ul>
											<ul class="dados-ul">
												<h3 class="h3-dados">Dados Acadêmico</h3>
												<li class="section_aluno_li">
													<span class="span_left">Curso: </span><span class="span_lright">'.$dado->current()->NomeCurso.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Class: </span><span class="span_lright">'.$dado->current()->NomeAnoEscolar.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Turma: </span><span class="span_lright">'.$dado->current()->NomeTurma.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Sala Nº: </span><span class="span_lright">'.$dado->current()->Sala.'</span>
												</li>
												<li class="section_aluno_li">
													<span class="span_left">Ano Letivo: </span><span class="span_lright">'.$dado->current()->NomeAnoletivo.'</span>
												</li>

												<li class="section_aluno_li">
													<span class="span_left">Data de registro: </span><span class="span_lright">';
													$dataRegistro  = date("d/m/Y H:i:s",strtotime($dado->current()->DataRegistro ));
													echo $dataRegistro;
													echo'</span>
												</li>
											</ul>
										</nav>
									</article>
								</div>
								<div class="conteudo-right">
									<div>';
									if(isset($dado->current()->NomeImagem) && $dado->current()->NomeImagem!=null && $dado->current()->NomeImagem !=''){
										echo'<figure class="dados-figure">
											<div>
												<img src="../../aluno/imagem/'.$dado->current()->NomeImagem.'" class="foto-dados">
											</div>
											<figcaption class="figcaption">'.$dado->current()->NomePessoa.'</figcaption>
										</figure>';
									}else{
											echo'<figure class="dados-figure">
											<div>
												<img src="../../aluno/imagem/aluno.png" class="foto-dados">
											</div>
											<figcaption class="figcaption figcaption-erro">'.$dado->current()->NomePessoa.' Não possui imagem</figcaption>
										</figure>';
									}
									echo'</div>
								</div>
							</section>
						</div>
					</article>
										';
										
										
											$count = $count + 1;
										 $dado->next();}
											
										
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
