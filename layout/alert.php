<?php

if(isset($_GET["alert"] ) && $_GET["alert"]!= Null ){
  $value = $_GET["alert"];
   echo'
    <div>
     <style type="text/css">
          
          .alert-div-main{
            margin: 10px;
          }
          .alert-caixa{
            width: 90%; 
            margin: 0 auto;
            padding: 30px;
            background:green;
            color: #fff;
            border-radius:10px; 
            display: flex; 
            justify-content: space-between;
          }
          .alert-btn_close{
            font-size: 20px;color: #fff;
          }
          .alert-btn_close:hover{
            color: #f00;
          }
          .alert-caixa2{
            width: 90%; 
            margin: 0 auto;
            padding: 30px;
            background:#ff9800;
            color: #fff;
            border-radius:10px; 
            display: flex; 
            justify-content: space-between;
          }
        </style>
    </div>
    ';

  /*ESTRUTURA SWITCH QUE VERICA OS VALORES*/
  switch($value)
  {
   

    case "1":
      echo '
       
        <div class="alert-div-main">
						<div class="alert-caixa">
							<h4 >Operação realizada com sucesso !</h4>
							<a href="?"    class="alert-btn_close">&times;</a>
						</div>
					</div>
      ';
    break;


    case "0":
        echo '
       
        <div class="alert-div-main">
						<div class="alert-caixa2">
							<h4 >Erro ao  realizada operação !</h4>
							<a href="?"    class="alert-btn_close">&times;</a>
						</div>
					</div>
      ';

  }
  unset($value,$_GET["alert"]);
}



?>