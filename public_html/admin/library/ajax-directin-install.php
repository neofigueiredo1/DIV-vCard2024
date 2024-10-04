<?php
require_once("bootstrap.php");

//Carrega as variáveis de ambiente do sistema.
global $env;
$env = new EnvLoad();
$env->loadVars();

require_once("database/connect.class.php");
Connect::loadVarsFromEnv();


$act = (isset($_POST['act'])) ?  $_POST['act'] : 0 ;
$act = (isset($_GET['act'])) ?  $_GET['act'] : $act ;
if(!is_numeric($act)){$act=0;}

/*
  class PHPErrorException extends Exception
  {
      private $context = null;
      public function __construct($code, $message, $file, $line, $context = null)
      {
          parent::__construct($message, $code);
          $this->file = $file;
          $this->line = $line;
          $this->context = $context;
      }
  }
  function error_handler($code, $message, $file, $line) {
      throw new PHPErrorException($code, $message, $file, $line);
  }
  function exception_handler(Exception $e)
  {
      $errors = array(
          E_USER_ERROR        => "User Error",
          E_USER_WARNING      => "User Warning",
          E_USER_NOTICE       => "User Notice",
          );

      $_n_erros="";
      if(array_key_exists($e->getCode(), $errors)){
        $_n_erros=$errors[$e->getCode()];
      }
      echo $_n_erros.': '.$e->getMessage().' in '.$e->getFile().' on line '.$e->getLine()."\n";
      echo $e->getTraceAsString();
  }
  set_error_handler('error_handler');
  set_exception_handler('exception_handler');

  define("MYSQL_CONN_ERROR", "Unable to connect to database.");
  // Ensure reporting is setup correctly
  mysqli_report(MYSQLI_REPORT_STRICT);

  // Connect function for database access
  function a_connect($usr,$pw,$db,$host)
  {
    mysqli_report(MYSQLI_REPORT_STRICT);
     try {
        $mysqli = new mysqli($host,$usr,$pw,$db);
     }catch (mysqli_sql_exception $e){
        throw $e;
     }
  }
*/

/*Valida os dados de conexão com a base de dados*/
if($act==1)
{
  $HOST = (isset($_POST['dbhost']))?  $_POST['dbhost'] : '' ;
  $BASE = (isset($_POST['dbbase']))?  $_POST['dbbase'] : '' ;
  $USER = (isset($_POST['dblogin']))?  $_POST['dblogin'] : '' ;
  $PASS = (isset($_POST['dbsenha']))?  $_POST['dbsenha'] : '' ;
  try {
    Connect::validadeConnection($HOST,$BASE,$USER,$PASS);
    die("1");
  } catch (Exception $e) {
    die($e->getMessage());
  }
}

/*Cria o arquivo de conexao*/
if($act==2)
{

  $HOST = (isset($_POST['dbhost']))?  $_POST['dbhost'] : '' ;
  $NOME = (isset($_POST['dbbase']))?  $_POST['dbbase'] : '' ;
  $USER = (isset($_POST['dblogin']))?  $_POST['dblogin'] : '' ;
  $PASS = (isset($_POST['dbsenha']))?  $_POST['dbsenha'] : '' ;
  $PREFIX = (isset($_POST['dbprefix']))?  $_POST['dbprefix'] : '' ;

  $Path = dirname(dirname(dirname(dirname(__FILE__))));

  /*Le o arquivo base*/
  $conn_txt = file_get_contents($Path.'/.env-sample', true);

  if(file_exists($Path."/.env")){
    unlink($Path."/.env");
  }

  $conn_txt = str_replace("DB_HOST=[DB_HOST]","DB_HOST=".$HOST."",$conn_txt);
  $conn_txt = str_replace("DB_NOME=[DB_NOME]","DB_NOME=".$NOME."",$conn_txt);
  $conn_txt = str_replace("DB_USER=[DB_USER]","DB_USER=".$USER."",$conn_txt);
  $conn_txt = str_replace("DB_PASS=[DB_PASS]","DB_PASS=".$PASS."",$conn_txt);
  $conn_txt = str_replace("DB_PREFIX=[DB_PREFIX]","DB_PREFIX=".$PREFIX."",$conn_txt);

  /*Cria o arquivo final*/
  $fp = fopen($Path."/.env","wb");
  fwrite($fp,$conn_txt);
  fclose($fp);
  die("1");
}

/*Faz o dump SQL*/
if($act==3)
{
  $Path = realpath("../library/database");

  $prefix = Connect::getPrefix();
  $conn = Connect::getInstance();
  /*Le o arquivo base*/
  $dumpsql = file_get_contents($Path.'/directinadmin.sql', true);
  $dumpsql = str_replace("[ADMPREFIX]",$prefix,$dumpsql);
  /*Executa o DUMP do sistema*/
  $conn->exec($dumpsql);
  $conn = null;
  die("1");
}

/*Cria a conta de usuario do admininistrador*/
if($act==4)
{
  $login = (isset($_POST['login']))?  Text::clean($_POST['login']) : '' ;
  $email = (isset($_POST['email']))?  Text::clean($_POST['email']) : '' ;
  $senha = (isset($_POST['senha']))?  md5(Text::clean($_POST['senha'])) : '' ;
  $prefix = Connect::getPrefix();
  $conn = Connect::getInstance();
  $conn->query("INSERT INTO ".$prefix."_login(status,nivel,nome,email,senha,login,set_validade,validade) values(1,1,'Admin','".$email."','".$senha."','".$login."',1,(Now()+90))  ");
  $conn = null;
  die("1");
}

/*Define as Variáveis de ambiente do sistema*/
if($act==5)
{
  $prefix = Connect::getPrefix();
  $sql = "INSERT INTO ".$prefix."_config(nivel,status,nome,valor,descricao) VALUES
                                        (0,1, 'SIS_NOME','DirectIn', 'Nome do Sistema'),
                                        (0,1, 'SIS_VERSAO','1.0', 'Versão do sistema')";
  $conn = Connect::getInstance();
  $conn->query($sql);
  $conn = null;
  die("1");
}

/*Check processo*/
if($act==6)
{
  die("1");
}

?>