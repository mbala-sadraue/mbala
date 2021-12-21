<?php
  require_once "../../../config/auth.php";
  if($permissao ==1){
      if(isset($_GET["id"]) && $_GET["id"]>0){
    $id = $_GET["id"];
 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cadastra Administrador</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo2.css">
</head>
<body>
  <div class="corpo">
    <div class="sub_corpo">
      <?php  
        require_once "../layout/layout.php";
        require_once "../../../App/Models/administrativa.php";
        require_once "../../../App/Models/departamento.php";
        echo $header;
      
         echo '<div class="corpo_geral">';
          echo $aside;
        echo '<section class="main_section">
          <div class="section_main">
            <header class="section_header">
              <h1 class="section_header_h1">Cadastra o <small>Adimistrador Adminstrativa</small></h1>
            </header>
          </div>
          <article class="article_main_form">';
          if(buscaDadosAdministrativa($id)!=null){
        echo ' <div class="section_article">
              <div class="">
                <h3 class="article_h3">Adimistrador Adminstrativa</h3>
              </div>
              <form class="form_main " enctype="multipart/form-data" method="post" action="'.$urlF2.'insertadmina.php">
                <div class="grid2">
                    <div class="form-left">
                      <h3 class="form_h3">Dados Pessoal</h3>
                      <ul>';
                      $dados = buscaDadosAdministrativa($id);
                      $dado   = new ArrayIterator($dados);
                      while ($dado->valid()){
                      echo'<li class="form_li">
                          <label class="form_label">Nome completa</label>
                          <div class="form_input">
                            <input type="text" name="nome" class="form_input_main" value="'.$dado->current()->NomePessoa.'" placeholder="Digite o nome completo" title="Nome">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Data de Nascimento</label>
                          <div class="form_input">
                            <input type="date" name="nascimento"value="'.$dado->current()->Nascimento.'" class="form_input_main" title="Data de Nascimento">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Genero</label>
                          <table class="tabela">
                            <tbody>
                              <tr class="flex">
                                <td class="form_lable">
                                  <label>Masculino
                                    <input type="radio" name="sexo" value="'.$dado->current()->Sexo.'"" checked="">
                                  </label>
                                </td>
                                <td class="form_lable">
                                  <label>Feminino
                                    <input type="radio" name="sexo" value="'.$dado->current()->NomePessoa.'">
                                  </label>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Adiciona Imagem</label>
                          <div>';
											if($dado->current()->NomeImagem != null){
												$vImagem = $dado->current()->NomeImagem;
												echo  '
													<div>
															<img src="../../admina/imagem/'.$vImagem.'" alt="foto de '. $dado->current()->NomeImagem.'" value="'. $dado->current()->NomeImagem.'"style="max-width:50px; "/>
													</div>
												';
											}else{
												$vImagem ="";
												echo '
													<div>
															<p id"p">'. $dado->current()->NomePessoa.' Não tem foto</p> 
													</div>
												';
											}

                         echo '<input type="file" name="imagem" value="' . $vImagem . '" class="">
										</div>
                        </li>
                      </ul>
                      <div>
                      </div>
                    </div>
                    <div class="form-right">
                        <h3 class="form_h3">Endereço</h3>
                      <ul>
                        <li class="form_li">
                          <label class="form_label">Telefone</label>
                          <div class="form_input">
                            <input type="texte" name="telefone"value="'.$dado->current()->Telefone.'" class="form_input_main input_valida" placeholder="Digite o Telefone" title="Telefone">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Email</label>
                          <div class="form_input">
                            <input type="email" name="email"value="'.$dado->current()->Email.'" class="form_input_main" placeholder="Digite o Email" title="Email">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Endereço</label>
                          <table class="tabela">
                            <tbody>
                              <tr class="flex">
                                <td class="form_lable form_labe2"><label>Provincia</label></td>
                                <td class="form_lable form_labe2"><label>Munícipio</label></td>
                                <td class="form_lable "><label>Bairro</label></td>
                              </tr>
                              <tr class="flex">
                                <td>
                                  <div class="form_input">
                                    <input type="text" name="provincia"value="'.$dado->current()->Cidade.'" class="form_input_main" placeholder="Provincia" title="Provincia">
                                  </div>
                                </td>
                                <td>
                                  <div class="form_input">
                                    <input type="text" name="municipio" value="'.$dado->current()->Municipio.'" class="form_input_main" placeholder="Munícipio" title="Munícipio">
                                  </div>
                                </td>
                                <td>
                                  <div class="form_input">
                                    <input type="text" name="bairro" value="'.$dado->current()->Bairro.'" class="form_input_main" placeholder="Bairro" title="Bairro">
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </li>
                      
                      </ul>
                    </div>
                    <div class="form-right">
                        <h3 class="form_h3">Dados Academico</h3>
                      <ul>
                        <li class="form_li">
                          <label class="form_label">Seleciona o departamento</label>
                          <select class="form_select" name="departa">';
                              $dadoD = listaDepartamento();
                              $d = new ArrayIterator($dadoD);
                              while($d->valid()){
                                echo'<option value="'.$d->current()->idDeparta.'"';
                                if($d->current()->idDeparta==$dado->current()->idDeparta){
                                  $selected = "selected";
                                }else{
                                   $selected = "";
                                }
                                echo $selected.'>
                                  '.$d->current()->NomeDeparta.'
                                </option>';
                                $d->next();
                              }
                     echo'</select>

                         <li class="form_li">
                          <label class="form_label"></label>
                          <div class="form_input">
                            <input type="hidden" name="idPessoa" value="'.$dado->current()->idPessoa.'" class="form_input_main input_valida">
                            <input type="hidden" name="idAdmin" value="'.$dado->current()->idAdminA.'" class="form_input_main input_valida">
                          </div>
                        </li>
                      </ul>';
                        $dado->next(); 
                      }
                   echo '</div>
                  </div>
                  <input type="hidden" name="axtuyalwizzar" value="a1tu2al3izar4">
								  <input type="hidden" name="idusuario" value="'.$idUsuario.'">
                <div class="center">
                  <button class="btn_cadastra col-4" id="btn_cadastra" name="atualizar" value="admina">Editar</button>
                  <a href="" class="btn_cansela col-4">Cansela</a>
                </div>
              </form>
            </div>';
               }else{
                 echo "Nenha dados foi encotrado";
               }
    echo '</article>
        </section>';
         echo'</div>
           <script type="text/javascript" src="../assets/js/jquery.js"></script>
           <script type="text/javascript" src="../../assets/js/valida.js"></script>
           <script type="text/javascript" src="../assets/js/main.js"></script>'
            ;
        echo $javascript;
        echo $fim;
         }else{
          header("location:index.php");
        }
      }else{
        header("location:".$url."login.php");
      }
?>
