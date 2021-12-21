<?php
	if (isset($_POST['upload'])) {
		
		//echo $_FILES["nome_foto"]["name"];
		print_r($_FILES["nome_foto"]);
		//echo $_SERVER["REMOTE_ADDR"];
		$permitido = array("jpeg","png","jpg","gif");
		$extensao = pathinfo($_FILES["nome_foto"]["name"],PATHINFO_EXTENSION);
			$img= uniqid().".$extensao";
			$arq_temp = $_FILES["nome_foto"]["tmp_name"];
			if(in_array($extensao,$permitido)){
				$pasta = "../imagem/";
				if(move_uploaded_file($arq_temp,$pasta.$img)){
					echo "suceeso";
				}else{
					echo "Erro";
				}
			}
		//echo uniqid();
	} else {
		echo "Não existe";

	}

