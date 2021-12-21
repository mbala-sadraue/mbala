
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Error gerado</title>
		<style type="text/css">
			*{
				padding: 0;
				margin:  0;
			}
			body{
				font-family: sans-serif;
				font-size: 15px;
				background: #000000;
			}
			.sessoa{
				background: rgba(63,160,31,0.51);
			}
			.boxErro{
				width: 100%;
				height: 100vh;
			}
			article>div{
				display: flex;
				flex-direction:column;
				justify-content: center;
				height: 100vh;
				width: 100%;
			}
			.boxMostraErro{
				height: auto;
				margin: 0 auto;
				background:#ffffff;
				padding-bottom: 20px;
				box-shadow: 3px 0px 10px #000000c7;
			}
			.title1{
				padding: 10px;
				background: #ff00007d;
				
			}
			.h1{
				font-family: sans-serif;
				font-size: 4vh;
				color: #fff;
				font-weight: 400;
				text-transform: uppercase;
				text-align: center;
			}
			.title2{
				padding: 10px;
			}
			.h2{
				font-family: system-ui;
				font-size: 3vh;
				text-align: center;
				font-weight: 300;
				color: blue;
			}
			.texto{
				padding: 10px;
				
			}
			.p{
				font-size:  14px;
				margin-bottom: 7px;
				color:#959090;

			}
			.btn{
				margin: 10px;
				padding: 6px 10px;
				color: blue;
				text-decoration: none;

			}
			.btn:hover{
				color: red;

			}

		</style>
	</head>
	<body>
		
		<section class="sessoa">
			<article class="boxErro">
				<div>
					<div class="boxMostraErro">
						<div>
							<div class="title1">
								<h1 class="h1"> Servidor desconectado!.</h1>
							</div>
							<div class="title2">
								<h2 class="h2">O servidor não esta ligado (não foi inicializado).</h2>
							</div>
							<div class="texto">
								<p class="p">
									 
									Para logar no sistema a obrigatóridade de inicializar o servidor caso ele fosse desligado ou desconectado.
									
								</p>
								<p class="p">
									O servidor atualmente encontra-se desconectado (desligado), e indisponível para oferecer ou antender  qualquer atividade pretendida. 
								</p>
							</div>
							<span><a href="../" class="btn">voltar</a></span>
						</div>
					</div>
				</div>
			</article>
		</section>
	</body>
</html>