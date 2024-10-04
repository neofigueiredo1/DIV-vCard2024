<?php
include_once('config.php');

//Padrão de retorno para as requisições.
$dados_retorno = json_decode('{"error":"0","message":"","resource":"null"}');

$ac = isset($_GET['ac']) ? Text::clean($_GET['ac']) : '' ;
$ac = isset($_POST['ac']) ? Text::clean($_POST['ac']) : $ac ;

// $recaptcha_token = isset($_POST['recaptcha']) ? $_POST['recaptcha'] : "";
// $remoteIp = $m_cadastro->saveIpAcesso();
// $recaptcha_ok = false;

// if(trim((string)$recaptcha_token)!=''){
//     $recaptcha = new \ReCaptcha\ReCaptcha(Sis::config("GOOGLE-RECAPTCHA-PRIVATE-KEY"));
//     // $resp = $recaptcha->setExpectedHostname('localhost')->verify($recaptcha_token, $remoteIp);
//     $host = explode(':', $_SERVER['HTTP_HOST']);
//     $resp = $recaptcha->setExpectedHostname($host[0])->verify($recaptcha_token, $remoteIp);
//     $recaptcha_ok = $resp->isSuccess();
// }

switch ($ac) {

    /**
    * Cadastro na newsletter.
    */
    case 'unidadesGetStatus':
        
        $empreendimentoId = isset($_POST['empreid']) ? (int)$_POST['empreid'] : 0;
        try {    
            $unidades = $m_espelho_vendas->allUnidades($empreendimentoId);
            $dados_retorno->resource = $unidades;
            $dados_retorno->error = 0;
            $dados_retorno->message = "sucesso";
        } catch (Exception $e) {
            $dados_retorno->error = 1;
            $dados_retorno->message = $e->getMessage();
        }
        
        break;
}

if (ob_get_length()>0) ob_end_clean();
echo json_encode($dados_retorno);
exit();

?>