<?php
/*VERIFICA O TIPO DE EXTENSÃO PARA FAZER O COPIAR A IMAGEM NA PASTA DE IMNAGEM */
  function verificaExtensaoParaCopiaFoto($extensao,$novaFoto,$destino,$nomeFoto){
    try {
       $permitido = array("jpg","jpeg","png","gif");
      if(in_array($extensao,$permitido)){
        switch($extensao){
            case "jpeg":
            case "jpg":
                imagejpeg($novaFoto,$destino.$nomeFoto);
                return true;
              break;
            case "png":
              imagepng($novaFoto,$destino.$nomeFoto);
              return true;
            break;
            case "gif":
                imagegif($novaFoto,$destino.$nomeFoto);
                return true;
                break;
            default:
                return null;
        }
      }
    } catch (PDOException $e) {
     echo "Erro ".$e->getMessage();
    }
  }
   function redimecionaFoto($tempoario,$largura,$extensao,$destino,$nomeFoto){
    try {
      $dadosFoto = verificaExtensao($extensao,$tempoario);

      $x = imagesx($dadosFoto);
      $y = imagesy($dadosFoto);
      
      /*CALCULAR ALTUARA ADEQUADA PARA O LARGURA PASSADA*/
      $height = ($largura / $x) * $y;
      $novaFoto = imagecreatetruecolor($largura,$height);
      imagecopyresampled($novaFoto,$dadosFoto,0,0,0,0,$largura,$height,$x,$y);
      verificaExtensaoParaCopiaFoto($extensao,$novaFoto,$destino,$nomeFoto);
      
    } catch (PDOException $e) {
      echo "Erro ".$e->getMessage();
    }
  }




  /*VERIFICA O TIPO DE EXTENSÃO DE IMAGEM*/
  function verificaExtensao($extensao,$temporario){
    try {
     switch($extensao){
        case "jpeg":
        case "jpg":
          return imagecreatefromjpeg($temporario);
          break;
        case "png":
          return imagecreatefrompng($temporario);
         break;
        case "gif":
            return imagecreatefromgif($temporario); 
            break;
        default:
            return null;
     }
    } catch (PDOException $e) {
     echo "Erro ".$e->getMessage();
    }
  }
/*VERIFICA O TAMNHO DA  IMNAGEM */
  function verificaTamnho($temporario,$largura){
    try {
      $dadosFoto  = getimagesize($temporario);
      list($w) = $dadosFoto;
     if($w<=$largura){
        return true;
     }else{
       return false;
     }
    } catch (PDOException $e) {
     echo "Erro ".$e->getMessage();
    }
  }





















?>