<?php
  
  global $theme_file;
  $theme_file = "page.php";

  ob_start();
  require_once "site/direct-includes/config.php";

  /* ERRO 404 - PÁGINA NÃO ENCONTRADA */
  if($pagina == "404" && $pagina_data['codigo']==0){
    if(file_exists("site/page-404.php")){
        $theme_file = "page-404.php";
        include("site/".$theme_file);
        $html = ob_get_clean ();
        echo preg_replace('/\s+/', ' ', $html);
        die();
    }
  }
  $dir = dirname(__FILE__)."/site";
  $cdir = scandir($dir);
  foreach ($cdir as $key => $value)
  {
      if(
         strrpos($value,"[".Text::friendlyUrl($pagina_data['titulo'])."]")!==false ||
         strrpos($value,"[".$pagina_data['codigo']."]")!==false ||
         strrpos($value,"page-".$pagina_data['codigo'].".")!==false ||
         strrpos($value,"page-".Text::friendlyUrl($pagina_data['titulo']).".")!==false
      ){
        $theme_file = $value;
        include("site/".$theme_file);
        $html = ob_get_clean ();
        echo preg_replace('/\s+/', ' ', $html);
        die();
      }
  }
  /*Verifica os arquivo para incluir por ordem*/
  if(file_exists("site/page-front.php") && $pagina==0){
      $theme_file = "page-front.php";
      include("site/".$theme_file);
      $html = ob_get_clean ();
      echo preg_replace('/\s+/', ' ', $html);
      die();
  }
  /*Verifica os arquivo para incluir por ordem*/
  if(file_exists("site/page.php")){
      include("site/".$theme_file);
      $html = ob_get_clean ();
      echo preg_replace('/\s+/', ' ', $html);
      die();
  }
  
?>