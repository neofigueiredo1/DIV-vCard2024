<?php
include_once('config.php');

//Padrão de retorno para as requisições.
$dados_retorno = json_decode('{"error":"0","message":"","resource":"null"}');

// Run CSRF check, on POST data, in exception mode, with a validity of 10 minutes, in one-time mode.
// try{
//     NoCSRF::check('csrf_token',$_POST,true,60*10,false);
// }catch( Exception $e ){
//     var_dump($e->getMessage());
//     exit();
//     $dados_retorno->message = "Não foi possível completar sua solicitação, certifique-se de que a página carregou corretamente.";
//     if (ob_get_length()>0) ob_end_clean();
//     echo json_encode($dados_retorno);
//     exit();
// }

$ac = isset($_GET['ac']) ? Text::clean($_GET['ac']) : '' ;
$ac = isset($_POST['ac']) ? Text::clean($_POST['ac']) : $ac ;

$recaptcha_token = isset($_POST['recaptcha']) ? $_POST['recaptcha'] : "";
$remoteIp = $m_cadastro->saveIpAcesso();
$recaptcha_ok = false;

if(trim((string)$recaptcha_token)!=''){
    $recaptcha = new \ReCaptcha\ReCaptcha(Sis::config("GOOGLE-RECAPTCHA-PRIVATE-KEY"));
    // $resp = $recaptcha->setExpectedHostname('localhost')->verify($recaptcha_token, $remoteIp);
    $host = explode(':', $_SERVER['HTTP_HOST']);
    $resp = $recaptcha->setExpectedHostname($host[0])->verify($recaptcha_token, $remoteIp);
    $recaptcha_ok = $resp->isSuccess();
}

switch ($ac) {

    /**
    * Cadastro na newsletter.
    */
    case 'newsRegister':
        // if($exe == 1){

        // Verificando validação do recaptcha para processar o formulário de checkout
        if($recaptcha_ok){

            /**
            * Verifica os dados do formulário da Newsletter armazenando em um array
            */
            $array = array(
                'nome'              => isset($_POST['nome']) ? Text::clean($_POST['nome']) : '',
                'email'             => isset($_POST['email']) ? Text::clean($_POST['email']) : '',
                'telefone_resid'    => isset($_POST['telefone']) ? Text::clean($_POST['telefone']) : '',
                'status'            => 4
            );

            /**
            * Se o e-mail for válido, manda pra função que armazena os dados.
            */
            if($array['email'] != "" && Sis::isValidEmail($array['email'])){
                try {
                    $m_cadastro->newsletterSign($array);
                    $dados_retorno->error = 0;
                    $dados_retorno->message = "sucesso";
                } catch (Exception $e) {
                    $dados_retorno->error = 1;
                    $dados_retorno->message = $e->getMessage();
                }
                // if ($retorno) {
                //     echo "ok";
                // }else{
                //     echo $retorno;
                // }
            }else{
                //echo "E-mail inválido";
                $dados_retorno->error = 1;
                $dados_retorno->message = "E-mail inválido";
            }
        }else{
            $dados_retorno->error = 1;
            $dados_retorno->message = "Erro ao efetuar o seu cadastro, tente novamente mais tarde!";
        }

        break;

    /**
    * Retorna as informacoes de endereço baseado no CEP.
    */
    case 'addressByCEP':
        // if($exe==2){

        $cep = (isset($_POST['cep'])) ? $_POST['cep'] : 0;
        $localUtil  = new LocalidadesUtil();
        $enderecoAchado = $localUtil->getAddressByCEP($cep);
        if ($enderecoAchado!==false) {
             echo $enderecoAchado->endereco."&".$enderecoAchado->bairro."&".$enderecoAchado->cidade."&".$enderecoAchado->uf;
        }else{
            echo "erro";
        }
        exit();

        //OLD//$data = file_get_contents('http://apps.widenet.com.br/busca-cep/api/cep/'.$cep.'.str');
        // $ch = curl_init('http://apps.widenet.com.br/busca-cep/api/cep/'.$cep.'.str');
        //         curl_setopt($ch, CURLOPT_HEADER, 0);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //         $data = curl_exec($ch);
        //         curl_close($ch);
        
        // var_dump($data);
        // if($data !== false){
        //     $stringArr = explode("&", $data);

        //     if(count($stringArr)>4){
        //         for ($i=1; $i < count($stringArr); $i++) {
        //             $stringArr2[] = explode("=", $stringArr[$i]);
        //         }
        //         $rua = ($stringArr2[0][0]=="address")?$stringArr2[0][1]:$stringArr2[4][1];
        //         $rua = explode("+-+", $rua);
        //         $rua = urldecode(str_replace("+", " ", $rua[0]));

        //         $estado = ($stringArr2[1][0]=="state")?$stringArr2[1][1]:$stringArr2[3][1];
        //         $estado = urldecode(str_replace("+", " ", $estado));

        //         $cidade = urldecode(str_replace("+", " ", $stringArr2[2][1]));

        //         $bairro = ($stringArr2[3][0]=="district")?$stringArr2[3][1]:$stringArr2[1][1];
        //         $bairro = urldecode(str_replace("+", " ", $bairro));
        //         echo $rua."&".$bairro."&".$cidade."&".$estado;
        //     }else{
        //         echo "erro";
        //     }

        // }else{
        //     echo "erro";
        // }
        // die();


        break;

    /**
    * Autentica o usuário no sistema.
    */
    case 'auth':
        try {
            $m_cadastro->login();
            $dados_retorno->error = 0;
            $dados_retorno->message = "sucesso";
        } catch (Exception $e) {
            $dados_retorno->error = 1;
            $dados_retorno->message = $e->getMessage();
        }
        break;

    /**
    * Recupera a senha.
    */
    case 'recoveryPass':
        try {
            $m_cadastro->geraCodigoNovaSenha();
            $dados_retorno->error = 0;
            $dados_retorno->message = "sucesso";
        } catch (Exception $e) {
            $dados_retorno->error = 1;
            $dados_retorno->message = $e->getMessage();
        }
        break;

    /**
    * Registra o novo cadastro.
    */
    case 'newRegister':
        try {
            $m_cadastro->cadastroInsertInicial();
            $dados_retorno->error = 0;
            $dados_retorno->message = "sucesso";
        } catch (Exception $e) {
            $dados_retorno->error = 1;
            $dados_retorno->message = $e->getMessage();
        }
        break;

    /**
    * Registra a nova senha através da recuperação de senha.
    */
    case 'recoveryPassSaveNew':
        try {
            $m_cadastro->salvaNovaSenha();
            $dados_retorno->error = 0;
            $dados_retorno->message = "sucesso";
        } catch (Exception $e) {
            $dados_retorno->error = 1;
            $dados_retorno->message = $e->getMessage();
        }
        break;
    
    /**
    * Confirma o cadastro.
    */
    case 'confirmRegister':
        try {
            $m_cadastro->confirmaCadastro();
            $dados_retorno->error = 0;
            $dados_retorno->message = "sucesso";
        } catch (Exception $e) {
            $dados_retorno->error = 1;
            $dados_retorno->message = $e->getMessage();
        }
    break;

    case 'contatoRevenda':

        if($recaptcha_ok){

            $nome     = isset($_POST['nome']) ? Text::clean(strip_tags($_POST['nome'])) : "Não informado";
            $email    = isset($_POST['email']) ? Text::clean(strip_tags($_POST['email'])) : "";
            $telefone = isset($_POST['telefone']) ? Text::clean(strip_tags($_POST['telefone'])) : "Não informado";
            $estado   = isset($_POST['estado']) ? Text::clean(strip_tags($_POST['estado'])) : "Não informado";
            $cpf_cnpj = isset($_POST['cpf_cnpj']) ? Text::clean(strip_tags($_POST['cpf_cnpj'])) : "Não informado";

            $toEmail = Sis::config("CLI_MAIL_CONTATO");
            $assunto_mensagem = "Quero ser revendedor(a) - Contato pela plataforma";
            $corpo_mensagem = "
            <table width='100%' cellpadding='0' cellspacing='10' border='0'>
                <tr>
                    <td width='32%' valign='top'>
                        <b>Nome:</b> " . $nome . "<br>
                        <b>Email:</b> " . $email . "<br/>
                        <b>Telefone:</b> " . $telefone . "<br/>
                        <b>Estado:</b> " . $estado . "<br/>
                        <hr style=\"border:0px;border-bottom:1px solid #eee;margin:15px 0px;width:100%;height:1px;\" />
                        <b>CPF / CNPJ:</b><br />
                        " . $cpf_cnpj . "
                    </td>
                </tr>
            </table>";

            $HTML_mensagem = Sis::returnMessageBodyClient($assunto_mensagem);
            $HTML_mensagem = str_replace("[HTML_DADOS]",$corpo_mensagem,$HTML_mensagem) ;

            // ob_clean();
            // echo $HTML_mensagem;
            // exit();

            // ob_clean();
            // echo "ok";
            // exit();

            // var_dump(class_exists("PHPMailer"));
            // exit();

            if(class_exists("PHPMailer")){
                try {
                    $mail = new PHPMailer();
                    $mail->CharSet     = "UTF-8";
                    $mail->ContentType = "text/html";

                    $mail->isSMTP();
                    $mail->isHTML(true);
                    $mail->SMTPDebug = 0;

                    $mail->Host = Sis::config("CLI_SMTP_HOST");
                    if(Sis::config("CLI_SMTP_PORTA")!=""){ $mail->Port = Sis::config("CLI_SMTP_PORTA"); }
                    if(Sis::config("CLI_SMTP_CONEXAO")!=""){ $mail->SMTPSecure = Sis::config("CLI_SMTP_CONEXAO"); }

                    if(Sis::config("CLI_SMTP_MAIL")!="")
                    {
                        $mail->SMTPAuth    = true;
                        $mail->Username    = Sis::config("CLI_SMTP_MAIL");
                        $mail->Password    = Sis::config("CLI_SMTP_PASS");
                    }
                    $mail->From        = Sis::config("CLI_SMTP_MAIL");
                    $mail->FromName    = Sis::config("CLI_NOME");

                    $cli_email = explode(",",$toEmail);
                    
                    for($xx=0;$xx<count($cli_email);$xx++)
                    {
                        if($xx==0){
                            $mail->AddAddress(trim($cli_email[$xx]));
                        }else{
                            $mail->AddCC(trim($cli_email[$xx]));
                        }
                    }
                    $mail->Subject = $assunto_mensagem;
                    $mail->Body = $HTML_mensagem;
                    
                    // $mail->SMTPOptions = array (
                    //     'ssl' => array (
                    //         'verify_peer' => false,
                    //         'verify_peer_name' => false,
                    //         'allow_self_signed' => true
                    //     )
                    // );
                    
                    // var_dump($mail);

                    if (!$mail->Send()) {
                        // echo 'Mailer Error: ' . $mail->ErrorInfo;
                        // exit();
                    }else{
                        // ob_clean();
                        // echo "ok";
                        // exit();
                    }

                } catch (phpmailerException $e) {
                    // var_dump($mail);
                    // echo $e->errorMessage(); //Pretty error messages from PHPMailer
                } catch (Exception $e) {
                    // var_dump($mail);
                    // echo $e->getMessage(); //Boring error messages from anything else!
                }

                ob_clean();
                echo "ok";
                exit();
            }

        }else{
            $dados_retorno->error = 1;
            $dados_retorno->message = "Erro ao efetuar o seu cadastro, tente novamente mais tarde!";
        }
       
    break;
}

if (ob_get_length()>0) ob_end_clean();
echo json_encode($dados_retorno);
exit();

?>