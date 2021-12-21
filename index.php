<?php
 require_once "Config/auth.php";
 if($permissao != null ){
    //echo '<script>window.location="http://127.0.0.1/escola/website/views/adminG"</script>';
   // header("location:".$url."views/adminG");
   switch($permissao){
      case 1:
         header("location:views/adminG/");
      break;
      case 2:
        header("location:views/adminA/");
      break;
      case 3:
        header("location:views/secretario/");
      break;
      case 4:
        header("location:views/profe/");
      break;
      case 5:
        header("location:views/aluno/");
      break;
        default:
        //header("location:".$url."login.php");
        echo "A permissao ".$permissao." não existe ";
   }
 }else{
     header("location:login.php");
 }

?>