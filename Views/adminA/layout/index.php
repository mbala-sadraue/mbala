<?php 
require_once "../../config/auth.php";
	$header = '<header class="pg_main_header">
				<div>
					<p class="pg_main_header_p">Director/a: <span class="pg_header_nome">'.$nomeUsuario.'<span></p>
					</div>
				<div>
					<a href="'.$url.'destroy.php" class="pg_header_a_sair">Sair</a>
				</div>
			</header>';

	$mode = '
		<div class="pg_modulo">
					<section class="pg_section">
						<a href="index2.php" class="pg_section_a">
							<article class="pg_artigo">
								<div  class="pg_artigo_img pg_artigo_img1"></div>
								<h3 class="pg_artigo_h3">Control Acadêmico</h3>
								<div>
									<p class="pg_artigo_p">Permitindo gerenciar secretarios, professores, alunos...</p>
								</div>
							</article>	
						</a>
						<a href="index3.php" class="pg_section_a">
							<article class="pg_artigo">
								<div  class="pg_artigo_img pg_artigo_img2"></div>
								<h3 class="pg_artigo_h3">Control Pedagógica</h3>
								<div>
									<p class="pg_artigo_p">Permitindo gerenciar secretario, professor, alunos...</p>
								</div>
							</article>	
						</a>
						<a href="" class="pg_section_a">
							<article class="pg_artigo" >
								<div  class="pg_artigo_img pg_artigo_img3"></div>
								<h3 class="pg_artigo_h3">Control Financeiro</h3>
								<div>
									<p class="pg_artigo_p">Permitindo gerenciar secretario, professor, alunos...</p>
								</div>
							</article>	
						</a>
						<a href="" class="pg_section_a">
							<article class="pg_artigo" >
								<div class="pg_artigo_img pg_artigo_img4"></div>
								<h3 class="pg_artigo_h3">Outros exercicio</h3>
								<div>
									<p class="pg_artigo_p">Permitindo gerenciar secretario, professor, alunos...</p>
								</div>
							</article>	
						</a>
						</article>
					</section>
				</div>	';
	$fim = '
				
		</div>
	</div>
</body>
</html>';
?>