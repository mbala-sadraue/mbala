<?php
  require_once "../../../config/auth.php";
  if($permissao ==2){
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
        require_once "../../../App/Models/departamento.php";
        echo $header;
      
         echo '<div class="corpo_geral">';
          echo $aside;
        echo '<section class="main_section">
          <div class="section_main">
            <header class="section_header">
              <h1 class="section_header_h1">Cadastra o/a <small>Secretário/a</small></h1>
            </header>
          </div>
          <article class="article_main_form">
            <div class="section_article">
              <div class="">
                <h3 class="article_h3">Secretário</h3>
              </div>
              <form class="form_main " enctype="multi-part/form-data" method="post" action="'.$urlF2.'insertsecretario.php">
                <div class="grid2">
                    <div class="form-left">
                      <h3 class="form_h3">Dados Pessoal</h3>
                      <ul>
                        <li class="form_li">
                          <label class="form_label">Nome completa</label>
                          <div class="form_input">
                            <input type="text" name="nome" class="form_input_main" placeholder="Digite o nome completo" title="Nome">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Data de Nascimento</label>
                          <div class="form_input">
                            <input type="date" name="nascimento" class="form_input_main" title="Data de Nascimento">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Genero</label>
                          <table class="tabela">
                            <tbody>
                              <tr class="flex">
                                <td class="form_lable">
                                  <label>Masculino
                                    <input type="radio" name="sexo" value="Masculino" checked="">
                                  </label>
                                </td>
                                <td class="form_lable">
                                  <label>Feminino
                                    <input type="radio" name="sexo" value="Feminino">
                                  </label>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Adiciona Imagem</label>
                          <div class="form_input">
                            <input type="file" name="imagem">
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
                            <input type="texte" name="telefone" class="form_input_main input_valida" placeholder="Digite o Telefone" title="Telefone">
                          </div>
                        </li>
                        <li class="form_li">
                          <label class="form_label">Email</label>
                          <div class="form_input">
                            <input type="email" name="email" class="form_input_main" placeholder="Digite o Email" title="Email">
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
                                    <input type="text" name="provincia" class="form_input_main" placeholder="Provincia" title="Provincia">
                                  </div>
                                </td>
                                <td>
                                  <div class="form_input">
                                    <input type="text" name="municipio" class="form_input_main" placeholder="Munícipio" title="Munícipio">
                                  </div>
                                </td>
                                <td>
                                  <div class="form_input">
                                    <input type="text" name="bairro" class="form_input_main" placeholder="Bairro" title="Bairro">
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
                         <input type="hidden" name="departa" value="'.$index_idDeparta.'"/>
                        </li>
                         <li class="form_li">
                          <label class="form_label">Usuario</label>
                          <div class="form_input">
                            <input type="text" name="usuario" class="form_input_main input_valida" placeholder="Digite o usuario">
                          </div>
                        </li>
                         <li class="form_li">
                          <label class="form_label">Senha</label>
                          <div class="form_input">
                            <input type="password" name="password" class="form_input_main input_valida" placeholder="Digite a senha">
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <input type="hidden" name="cxadyaswtraz" value="c1ad2as3tra4">
								  <input type="hidden" name="idusuario" value="'.$idUsuario.'">
                <div class="center">
                  <button class="btn_cadastra col-4" id="btn_cadastra" name="cadastra" value="admina">Cadastra</button>
                  <a href="" class="btn_cansela col-4">Cansela</a>
                </div>
              </form>
            </div>
          </article>
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
