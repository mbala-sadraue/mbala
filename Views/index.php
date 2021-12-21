<?php
 require_once "../Config/auth.php";
 if($permissao != null ){
    //echo '<script>window.location="http://127.0.0.1/escola/website/views/adminG"</script>';
   // header("location:".$url."views/adminG");
   switch($permissao){
      case 1:
         header("location:adminG/");
      break;
      case 2:
        header("location:adminA/");
      break;
      case 3:
        header("location:secretario/");
      break;
      case 4:
        header("location:profe/");
      break;
      case 5:
        header("location:aluno/");
      break;
        default:
        header("location:../login.php");
       // echo "A permissao ".$permissao." não existe ";
        unset($permissao);
   }
 }else{
     header("location:../login.php");
 }

?>