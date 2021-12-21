<?php
    //require_once "../../config/auth.php";
    $header = '
		<style type="text/css">
			.logo {
				width: 56px;
				height: 56px;
				background-image: url('.$url.'assets/css/img/logo.jpg);
				background-repeat: no-repeat;
				background-position: center center;
				background-size: cover;
				border-radius: 50px;
			}
		</style>
		<header class="main_header">
				<div class="div_logo_main">
					<div class="">
						<h1 class="logo_main_h1">
							<div class="logo"></div>
							<div class="h1_title">
								<span class="h1_span1">SASOFT</span>
								<span class="h1_span2">ESCOLAR</span>
							</div>
						</h1>
					</div>
				</div>
				<div>
					<ul>
						<nav>
							<li><a href="'.$url.'" class="a_nav_haeder">Home</a></li>
						</nav>
					</ul>
				</div>
				<div class="">
					<div>
							<ul>
								<li class="menu_perfil_li">
									<div class="perfil_img2 click_img">
										<img src="'.$url.'assets/img/usuario.jpg" class="img_perfil ">
									</div>
									<div class="popap_main hide">
										<div>
											<div class="popap_top">
												<div class="popap_main_img">
													<img src="'.$url.'assets/img/usuario.jpg" class="img_perfil">
												</div>
												<a href="" class="btn_close_popup">x</a>
												<div>
													<p class="popap_main_p">
															<span class="popap_span">Nome:</span>
															<span class="popap_span2">'.$nomeUsuario.'</span>
													</p>
													<p class="popap_main_p">
														<span class="popap_span">Cargo:</span>
														<span class="popap_span2">O director Geral</span>
													</p>
													<p>
														<span class="popap_span">Data:</span>
														<span class="popap_span2">desde 20 de janeiro de 2020</span>
													</p>
												</div>
											</div>
											<div class="popap_bottom">
												<ul class="ul_popap">
													<li><a href="" class="popap_a">Perfil</a></li>
													<li><a href="" class="popap_a">Sair</a></li>
												</ul>
												<div><a href="'.$url.'destroy.php" class="btn_sessoa">Terminar sessão</a></div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
				</div>
			</header>'
    ;
    $aside = '<aside class="main_aside">
					<div class="aside_perfil">
						<div>
							<ul>
								<li class="aside_perfil_li">
									<div class="perfil_img">
										<img src="'.$url.'assets/img/usuario.jpg" class="img_perfil">
									</div>
									<div class="div_tile_nome">
										<h4 class="h4_nome">'.$nomeUsuario.'</h4>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="div_nemu">
						<nav class="main_nav">
							<ul class="nav_ul_main">
							<li class="ul_li_main">
									<a href="" class="li_a_main">Departamento</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/departamento/" class="li2_a2">Departamento</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/departamento/departamento.php" class="li2_a2">Cadastra Departamento</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Ano letivo</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/anoLetivo" class="li2_a2">Ano letivo</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/anoLetivo/cadastra-anoletivo.php" class="li2_a2">Cadastra ano Letivo</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Diretor Adiminstrativa</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/admina/" class="li2_a2">Adminsitrativo</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/admina/cadastraAdmin.php" class="li2_a2">Cadastra Dr Administrativo</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Secretário</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/secretario/" class="li2_a2">Secretário</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/secretario/cadastra-secretario.php" class="li2_a2">Cadastra Secretário</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Professor</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/professor/" class="li2_a2">Professor</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/professor/cadastra-professor.php" class="li2_a2">Cadastra Professor</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Aluno</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="" class="li2_a2">Aluno</a>
											</li>
											<li class="ul2_li">
												<a href="" class="li2_a2">Cadastra Aluno</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Curso</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/curso" class="li2_a2">Curso</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/curso/cadastra-curso.php" class="li2_a2">Cadastra Curso</a>
											</li>
										</ul>
								</li>
								<li class="ul_li_main">
									<a href="" class="li_a_main">Disciplina</a>
										<ul class="li_ul2 hide">
											<li class="ul2_li">
												<a href="'.$url2.'adminG/disciplina" class="li2_a2">Disciplina</a>
											</li>
											<li class="ul2_li">
												<a href="'.$url2.'adminG/disciplina/cadastra-disciplina.php" class="li2_a2">Cadastra Disciplina</a>
											</li>
										</ul>
								</li>
							</ul>
						</nav>
					</div>
				</aside>'
    ;
    $section =' 
            <section class="main_section">
                conteudo central
            </section>'
    ;
    $javascript = '
    <script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script type="text/javascript" src="'.$url.'assets/js/main2.js"></script>
    </div>
	</div>'
	;
	$fim = '</body></html>';
?>