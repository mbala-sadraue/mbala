<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Login Anuarite Cólegio</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta name="author" content="Mbala Sadraque">
	<meta name="description" content="Sistema de gerenciamento escolar">
	<link rel="stylesheet" type="text/css" href="assets/css/media.css">
	<link rel="stylesheet" type="text/css" href="assets/css/estilo.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
</head>
<body>
	<div id="corpo-login">
		<div id="subCorpo-login">
			<div class="login_title">
				<h1 class="login_title_h1">Logar no Sistema</h1>
			</div>
			<div class="login_logo">
				<img src="assets/css/img/logo.png" class="login_logo_img">
			</div>
			<div id="login-container">
				<form method="post" action="http://anuarite.com//App/section.php">
					<div class="login-group">
						<label class="login-label">Usuario</label>
						<div class="">
							<input type="text" name="usuario" class="login_input" id="usuario">
						</div>
					</div>
					<div class="login-group">
						<label class="login-label" >Senha</label>
						<div class="">
							<input type="password" name="senha" class="login_input" id="password">
						</div>
					</div>
					<div>
						<div class="login-group2">
							<div>
								<label for="checkbox" class="login_checkbox">Lembra-me</label>
								<input type="checkbox" name="" value="" id="checkbox">
							</div>
							<div><a href="" class="login_checkbox">Esqueceu a senha?</a></div>
						</div>
					</div>
					<div class="div-login-button">
						<button class="login_button" name="login" value="logar" id="">Entrar no Sistema</button>
					</div>
				</form>
			</div>
		<div>
	</div>
</body>
</html>