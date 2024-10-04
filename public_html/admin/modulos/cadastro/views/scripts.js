const MJS_Cadastro = {
    data:{
        ajaxBusy:false
    },
    login:function(form){
        
        const data = new FormData(form);
        const oReq = new XMLHttpRequest();

        oReq.onload = function(){
            console.log(this);
            console.log(this.responseText);
            const retorno = Util.isJson(this.responseText);
            if (retorno!==false) {
                if (retorno.error==0) {
                    window.location.reload();
                }else{
                    alert(retorno.message);
                }
            }else{
                alert('Não foi possível completar a requisição, tente novamente mais tarde.');
            }
            Util.reloadNoCSRF(form.csrf_token);

        };
        oReq.open("post","/site/direct-includes/modulo-cadastro-ajax-controller.php");
        oReq.send(data);

    },
    recoverPass:function(form){
        
        const data = new FormData(form);
        const emailCheck = data.get('email');

        if (emailCheck.trim()!="") {
            
            data.set('ac','recoveryPass');
            
            const oReq = new XMLHttpRequest();
                oReq.onload = function(){
                    
                    const retorno = Util.isJson(this.responseText);

                    if (retorno!==false) {
                        if (retorno.error==0) {
                            alert("Um e-mail lhe foi enviado com os passos para a redefinirção da sua senha.");
                        }else{
                            alert(retorno.message);
                        }
                    }else{
                        alert('Não foi possível completar a requisição, tente novamente mais tarde.');
                    }

                    Util.reloadNoCSRF(form.csrf_token);

                };
                oReq.open("post","/site/direct-includes/modulo-cadastro-ajax-controller.php");
                oReq.send(data);

        }else{
            alert("Informe seu e-mail para recuperação de senha.");
        }
    },
    register:function(form){
        
        const data = new FormData(form);
        const oReq = new XMLHttpRequest();

        oReq.onload = function(){
            const retorno = Util.isJson(this.responseText);
            if (retorno!==false) {
                if (retorno.error==0) {
                    alert("Seu cadastro foi realizado com sucesso.");
                    window.location.reload();
                }else{
                    alert(retorno.message);
                }
            }else{
                alert('Não foi possível completar a requisição, tente novamente mais tarde.');
            }
            Util.reloadNoCSRF(form.csrf_token);

        };
        oReq.open("post","/site/direct-includes/modulo-cadastro-ajax-controller.php");
        oReq.send(data);

    },
    activateAccount:function(form){

        const data = new FormData(form);
        const oReq = new XMLHttpRequest();

        $('#cd_ativacao_form').slideUp('fast');
        $('.cd_ativa_preloader').slideDown('fast');

        oReq.onload = function(){
            
            console.log(this);
            console.log(this.responseText);

            let retorno = Util.isJson(this.responseText);
            if (retorno!==false) {
                let _retorno = JSON.parse(this.responseText);
                if (_retorno.error==0) {
                    
                    $('.mensagem_sucesso').slideDown('fast');
                    $('.cd_ativa_preloader').slideUp('fast');

                    setTimeout(function(){
                        window.location.reload();
                    },3000);

                }else{
                    
                    $('.cd_ativa_preloader').slideUp('fast');
                    $('#cd_ativacao_form').slideDown('fast');

                    $('#cdAtivaModal #error-box').html(_retorno.message);
                    $('#cdAtivaModal #error-box').slideDown('fast');
                }
            }else{
                
                $('.cd_ativa_preloader').slideUp('fast');
                $('#cd_ativacao_form').slideDown('fast');
                $('#cdAtivaModal #error-box').html('Não foi possível completar a requisição, tente novamente mais tarde.');
                $('#cdAtivaModal #error-box').slideDown('fast');

            }
            // Util.reloadNoCSRF(form.csrf_token);

        };
        oReq.open("post","/site/direct-includes/modulo-cadastro-ajax-controller.php");
        oReq.send(data);

    },
    ckToken:function(){
        if (!MJS_Cadastro.data.ajaxBusy){
            MJS_Cadastro.data.ajaxBusy=true;
            const oReq = new XMLHttpRequest();
            oReq.onload = function(){
                console.log(this.responseText);
                MJS_Cadastro.data.ajaxBusy=false;
                if (this.responseText.trim()=='forbided'){
                    window.location.reload();
                }
            };
            oReq.open("get","/site/direct-includes/modulo-cadastro-ajax-controller.php?ac=ckToken");
            oReq.send();
        }
    },
    init:function(){}
};

function logSubmit(event) {
  event.preventDefault();
}

// MJS_Cadastro.init();
function checkCadastroNewsletter(form,messageArea){

    form.addEventListener('submit', logSubmit);

    var nome, email, telefone, send, recaptcha;
    nome = form.nome.value;
    email = form.email.value;
    telefone = form.telefone.value;
    send = true;


    
    if (email.trim() === "" || !Util.isEmail(email))
    {
        $(messageArea).html("Preencha o e-mail corretamente!")
        send = false;
    }
    if(send) {
        $(messageArea).fadeOut();

        grecaptcha.ready(function() {
            grecaptcha.execute(reCAPTCHA_site_key, {action: 'submit'}).then(function(token) {
                //form.g_recaptcha_response.value = token;
                //form.submit();
                $.ajax({
                    type:'POST',
                    url:'/site/direct-includes/modulo-cadastro-ajax-controller.php',
                    data:{ nome:nome, email:email, telefone:telefone, ac:'newsRegister', exe:1, recaptcha:token}
                }).done(function(data){
                    
                    let dataJ = JSON.parse(data);

                    if((dataJ.message).trim()=="sucesso"){

                        $(messageArea).html("Seu cadastro foi realizado com sucesso!");
                        $(messageArea).removeClass("alert-danger");
                        $(messageArea).addClass("alert-success");
                        $(messageArea).fadeIn('fast',function(){
                            setTimeout(function(){
                                $(messageArea).fadeOut('fast');
                            },3000);
                        });
                        form.reset();
                    
                    }else{

                        console.log(data);

                        $(messageArea).html(dataJ.message);
                        $(messageArea).addClass("alert-danger");
                        $(messageArea).removeClass("alert-success");
                        $(messageArea).fadeIn('fast',function(){
                            setTimeout(function(){
                                $(messageArea).fadeOut('fast');
                            },3000);
                        });
                    }
                });
            });
        });

        // $.ajax({
        //     type:'POST',
        //     url:'/site/direct-includes/modulo-cadastro-ajax-controller.php',
        //     data:{ nome:nome, email:email, telefone:telefone, ac:'newsRegister', exe:1 }
        // }).done(function(data){
            
        //     let dataJ = JSON.parse(data);

        //     if((dataJ.message).trim()=="sucesso"){

        //         $(messageArea).html("Seu cadastro foi realizado com sucesso!");
        //         $(messageArea).removeClass("alert-danger");
        //         $(messageArea).addClass("alert-success");
        //         $(messageArea).fadeIn('fast',function(){
        //             setTimeout(function(){
        //                 $(messageArea).fadeOut('fast');
        //             },3000);
        //         });
        //         form.reset();
            
        //     }else{

        //         console.log(data);

        //         $(messageArea).html(dataJ.message);
        //         $(messageArea).addClass("alert-danger");
        //         $(messageArea).removeClass("alert-success");
        //         $(messageArea).fadeIn('fast',function(){
        //             setTimeout(function(){
        //                 $(messageArea).fadeOut('fast');
        //             },3000);
        //         });
        //     }
        // });
    }else{
        $(messageArea).addClass("alert-danger");
        $(messageArea).removeClass("alert-success");
        $(messageArea).fadeIn('fast',function(){
            setTimeout(function(){
                $(messageArea).fadeOut('fast');
            },3000);
        });
    }
}

function checkCadastroInicial(form)
{
    form.addEventListener('submit', logSubmit);

    var email = form.email.value;
    var alterar_senha = true;
    var senha = form.senha.value;
    var senha_conf = form.senha_conf.value;
    var send = true;
    $(form).find("input-group").removeClass("has-error");
    
    if(!Util.isEmail(email)){
        $("#msg-box-cadastro-novo").append("Indique um e-mail válido!<br/>");
        $(form.email).parent().addClass("has-error");
        send = false;
    }
    if(form.termos){
        if(form.termos.checked == false){
            $("#msg-box-cadastro-novo").append("Você precisa aceitar os nossos termos de uso!<br/>");
            send = false;
        }
    }
    if(alterar_senha){
        if (senha != senha_conf)
        {
            $(form.senha).parent().addClass("has-error");
            $(form.senha_conf).parent().addClass("has-error");
            //form.senha.style.backgroundColor = "#fedbdd";
            //form.senha_conf.style.backgroundColor = "#fedbdd";
            $("#msg-box-cadastro-novo").append("As confirmação de senha deve ser igual a senha.<br/>");
            send = false;
        }else if(senha.length < 6){
            $(form.senha).parent().addClass("has-error");
            //$(form.senha_conf).addClass("has-error");
            //form.senha.style.backgroundColor = "#fedbdd";
            //form.senha_conf.style.backgroundColor = "#fedbdd";
            $("#msg-box-cadastro-novo").append("A senha deve ter no mínimo 6 caracteres.");
            send = false;
        }
    }
    if(send) {
        $('input').removeAttr("disabled");
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $("#msg-box-cadastro-novo").slideUp("fast");
        // setTimeout(function(){
        //     form.submit();
        // }, 1500);
        grecaptcha.ready(function() {
            grecaptcha.execute(reCAPTCHA_site_key, {action: 'submit'}).then(function(token) {
                form.g_recaptcha_response.value = token;
                form.submit();
            });
        });
    }else{
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $("#msg-box-cadastro-novo").slideDown("fast");
        setTimeout(function(){
            $("#msg-box-cadastro-novo").slideUp("fast");
            $("#msg-box-cadastro-novo").html("");
        }, 5000);
    }
}

function checkCadastroUpdate(form){

    form.addEventListener('submit', logSubmit);

    var cpf_cnpj = form.cpf_cnpj.value;
    var alterar_senha = false;

    if(form != document.cadastro_form){
        var senha_antiga    = form.senha_antiga.value;
            alterar_senha   = form.alterar_senha.checked;
    }

    var senha           = form.senha.value;
    var senha_conf      = form.senha_conf.value;
    var send            = true;

    $(form).find("input-group").removeClass("has-error");

    cpf_cnpj = cpf_cnpj.replace(".", "").replace(".", "").replace("-", "");
    if(verificaCpf(cpf_cnpj) == false){
        $(form.cpf_cnpj).parent().addClass("has-error");
        $("#alerts-help").html("Insira um CPF válido!");
        send = false;
    }
    if(alterar_senha == true){
        console.log("Se Altera Senha");
        if (senha != senha_conf)
        {
            console.log("Se Diverge");
            $(form.senha).parent().addClass("has-error");
            $(form.senha_conf).parent().addClass("has-error");
            $("#alerts-help").html("As confirmação de senha deve ser igual a senha.");
            send = false;
        }else if(senha.length < 6){
            console.log("Se Senha com menos de 6 caracteres");
            $(form.senha).parent().addClass("has-error");
            $(form.senha_conf).parent().addClass("has-error");
            $("#alerts-help").html("A senha deve ter no mínimo 6 caracteres.");
            send = false;
        }

    }
    if(send) {
        console.log("Envio OK");
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $(form).slideUp("fast");
        $(".form-cadastro .alert").slideUp("fast");
        $(".alert-loader").slideDown("fast");
        // setTimeout(function(){
        //     form.submit();
        // }, 1500);
        grecaptcha.ready(function() {
            grecaptcha.execute(reCAPTCHA_site_key, {action: 'submit'}).then(function(token) {
                form.g_recaptcha_response.value = token;
                form.submit();
            });
        });
    }else{
        console.log("Envio Não OK");
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $("#alerts-help").slideDown("fast");
        setTimeout(function(){
            $("#alerts-help").slideUp("fast");
        }, 5000);
    }
    

    // else{
    //     $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
    //     $(form).slideUp("fast");
    //     $(".form-cadastro .alert").slideUp("fast");
    //     $(".alert-loader").slideDown("fast");
    //     setTimeout(function(){
    //         console.log('GoSubmit');
    //         form.submit();
    //     }, 1500);
    // }
}

function checkCadastro(form)
{
    var cpf_cnpj = form.cpf_cnpj.value;
    var telefone_resid = form.telefone_resid.value;
    var telefone_comer = form.telefone_comer.value;
    var celular = form.celular.value;

    if(form != document.cadastro_form){
        var senha_antiga    = form.senha_antiga.value;
        var alterar_senha   = form.alterar_senha.checked;
    }else{
        alterar_senha = true;
    }
    var senha           = form.senha.value;
    var senha_conf      = form.senha_conf.value;
    var send            = true;

    form.cpf_cnpj.style.backgroundColor = "#f7f7f7";
    form.telefone_resid.style.backgroundColor = "#f7f7f7";
    form.telefone_comer.style.backgroundColor = "#f7f7f7";
    form.celular.style.backgroundColor = "#f7f7f7";
    form.senha.style.backgroundColor = "#f7f7f7";
    form.senha_conf.style.backgroundColor = "#f7f7f7";


    if(telefone_resid == "" && telefone_comer=="" && celular==""){
        $("#contato-help").html("Indique pelo menos um número de contato, incluindo o DDD!");
        send = false;
    }else{
        if(telefone_resid.length<10&&telefone_resid!=""){
            $("#contato-help").html("O telefone RESIDENCIAL precisa estar em um formato válido indicado!");
            send = false;
        }
        if(telefone_comer.length<10&&telefone_comer!=""){
            $("#contato-help").html("O telefone COMERCIAL precisa estar em um formato válido indicado!");
            send = false;
        }
        if(celular.length<10&&celular!=""){
            $("#contato-help").html("O telefone CELULAR precisa estar em um formato válido indicado!");
            send = false;
        }
    }

    if(form.genero.value == ""){
        $("#contato-help").html("Indique o seu gênero!");
        send = false;
    }
    if (form.termos){
        if(form.termos.checked == false){
            $("#contato-help").html("Você precisa aceitar os nossos termos e condições!");
            send = false;
        }
    }

    cpf_cnpj = cpf_cnpj.replace(".", "").replace(".", "").replace("-", "");
    if(verificaCpf(cpf_cnpj) == false){
        form.cpf_cnpj.style.backgroundColor = "#fedbdd";
        $("#contato-help").html("Insira um CPF válido!");
        send = false;
    }

    if(alterar_senha == true){
        if (senha != senha_conf)
        {
            form.senha.style.backgroundColor = "#fedbdd";
            form.senha_conf.style.backgroundColor = "#fedbdd";
            $("#contato-help").html("As confirmação de senha deve ser igual a senha.");
            send = false;
        }else if(senha.length < 6){
            form.senha.style.backgroundColor = "#fedbdd";
            form.senha_conf.style.backgroundColor = "#fedbdd";
            $("#contato-help").html("A senha deve ter no mínimo 6 caracteres.");
            send = false;
        }

        if(send) {
            $('input').removeAttr("disabled");
            $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
            $(".form-cadastro .alert").slideUp("fast");
            $(".alert-loader").slideDown("fast");
            setTimeout(function(){
                form.submit();
            }, 1500);
        }else{
            $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
            $("#contato-help").slideDown("fast");
            setTimeout(function(){
                $("#contato-help").slideUp("fast");
            }, 5000);
        }
    }else{
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $(".form-cadastro .alert").slideUp("fast");
        $(".alert-loader").slideDown("fast");
        setTimeout(function(){
            form.submit();
        }, 1500);
    }
}

function checkLogin(form){

    form.addEventListener('submit', logSubmit);

    var email           = form.email.value;
    var senha           = form.senha.value;
    var send            = true;

    if(!Util.isEmail(email)){
        $("#msg-box-login").removeClass("alert-success").addClass("alert-danger");
        $("#msg-box-login").html("Digite um e-mail válido!<br/>");
        send = false;
    }

    if(senha == ""){
        $("#msg-box-login").removeClass("alert-success").addClass("alert-danger");
        $("#msg-box-login").html("O campo senha não pode ser vazio");
        send = false;
    }

    if(send) {

        $('input').removeAttr("disabled");
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $("#msg-box-login").slideUp("fast");

        // grecaptcha.ready(function() {
        //     grecaptcha.execute(reCAPTCHA_site_key, {action: 'submit'}).then(function(token) {
        //         form.g_recaptcha_response.value = token;
        //     });
        // });
        form.submit();

    }else{
        $('html, body').animate({ scrollTop: $(document.body).offset().top}, 'slow');
        $("#msg-box-login").slideDown("fast");
        setTimeout(function(){
            $("#msg-box-login").slideUp("fast");
            $("#msg-box-login").html("");
        }, 5000);
    }
}

function verificaEmailAtual(){
    email_atual = document.getElementById("email_atual").value;
    email = document.getElementById("email").value;
    if(email_atual != email){
        $('.email_info').html('<i class="fa fa-info-circle"></i> Ao alterar o e-mail, você será direcionado para uma tela de login e passará novamente pelo processo de ativação da sua conta.');
    }else{
        $('.email_info').html('');
    }
}

$(document).ready(function() {
    
    if ($("#cadastro_form").length>0) {
        if (document.cadastro_form.alterar_senha != null) {
            document.cadastro_form.alterar_senha.checked = false;
        }
        var cep = document.cadastro_form.cep.value;
        console.log(document.cadastro_form.endereco.value+"");
        if(document.cadastro_form.endereco.value==""){
            console.log(achaEndereco(cep));
        }
    };

    if($('#alert-bts').length>0){
        setTimeout(function(){
           $('#alert-bts').slideUp('fast');
        }, 5000);
    };
});

function verificaCpf(strCPF)
{
    var Soma;
    var Resto;

    console.log(strCPF);

    var cpf = strCPF.replace(/\D/g, '');
    
    console.log(cpf);

    Soma = 0;
    if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "999999999999"){
        return false;
    }
    for (var i=1; i<=9; i++)
        Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(cpf.substring(9, 10)) )
        return false;
    Soma = 0;
    for (var i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(cpf.substring(10, 11) ) )
        return false;

    return true;
}

function checkSenhaReset(form){
    let senhaPass=true;
    let msg="";
    if(form.senha.value!=form.senha_confirm.value){
        senhaPass=false;
        msg="Confirme sua nova senha corretamente!";
    };
    if(form.senha.value.length<4){
        senhaPass=false;
        msg="Sua nova senha deve ter no mínimo 4 caracteres!";
    };
    if(senhaPass){
        form.submit();
    }else{

        $('#error-box-combinacao-pass').html(msg);
        $('#error-box-combinacao-pass').slideDown('fast',function(){
            setTimeout(function(){
                $('#error-box-combinacao-pass').slideUp();
            },3000);
        });
    }
}

function refenirSenha(form){

    form.addEventListener('submit', logSubmit);

    var email = form.email.value;
    var send = true;

    if(email == ''){
        send = false;
    }

    if(send){

        grecaptcha.ready(function() {
            grecaptcha.execute(reCAPTCHA_site_key, {action: 'submit'}).then(function(token) {
                form.g_recaptcha_response.value = token;
                form.submit();
            });
        });

    }
}