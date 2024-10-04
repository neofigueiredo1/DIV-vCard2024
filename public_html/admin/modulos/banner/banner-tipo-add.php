<?php
// VERIFICANDO A PERMISSÃO
if (!Sis::checkPerm('10002-2') && !Sis::checkPerm('10002-4'))
{
    Sis::setAlert('Você não tem acesso à este recurso!', 1, '/admin/');
}

//Envio dos dados do formulário
$exe = isset($_POST['exe']) ? $_POST['exe'] : "";
if(!is_numeric($exe)){ $exe=0; }
if($exe==1)
{
    $directIn->tipoInsert();
}
?>

<ul class="breadcrumb">
    <li><a href="?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=tipo-list">Tipos de Banner</a></li>
    <li class="active">Criar novo tipo</li>
</ul>

<div class="btn-group">
    <a class="btn btn-default" href="?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=tipo-list">Tipos de banner</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod; ?>&pag=menu&act=add" disabled="disabled" >Criar novo tipo</a>
</div>

<hr />

<div class="alert alert-danger" id="error-box" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Preencha todos os campos corretamente!</div>

<form action="<?php echo Sis::currPageUrl(); ?>" method="post" class="form_dados" name="form_dados" >
    <input type="hidden" name="exe" value="1">
    <table class="table table_form">
        <tr>
            <th class="middle bg">Nome</th>
            <td colspan="3"><input type="text" class="form-control" data-required="true" name="nome" id="nome"></td>
        </tr>
        <tr>
            <th width="25%" class="middle bg">Largura</th>
            <td width="25%" ><input type="text" class="form-control" name="largura" id="largura"></td>
            <th width="25%" class="middle bg">Altura</th>
            <td width="25%" ><input type="text" class="form-control" name="altura" id="altura"></td>
        </tr>
        <tr>
            <th class="middle bg">Tempo de intervalo</th>
            <td><input type="text" class="form-control" name="animacao_tempo" id="animacao_tempo"></td>
            <th class="middle bg">Tempo de execução</th>
            <td><input type="text" class="form-control" name="animacao_velocidade" id="animacao_velocidade"></td>
        </tr>

        <tr><th class="top bg">Perfil</th>
        	<td colspan="3" >

            	<label class="radio-inline" ><input type="radio" name="perfil" value="0" id="perfil" onclick="javascript:$('#jquery-efeitos').slideUp();" checked="checked" /> Estático &nbsp;</label>
            	<label class="radio-inline" ><input type="radio" name="perfil" value="1" id="perfil" onclick="javascript:$('#jquery-efeitos').slideUp();" /> Sorteio &nbsp;</label>
                <label class="radio-inline" ><input type="radio" name="perfil" value="2" id="perfil" onclick="javascript:$('#jquery-efeitos').slideDown();" /> Animação ( jQuery )</label>

                <div id="jquery-efeitos" style="display:none;margin-top:15px;" >
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Efeitos</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table_form" style="margin:0px;" >
                                    <tr class="no_bg">
                                        <?php
                                        //Listagem dos efeitos de transição do banner
                                        $index = 0;
                                        foreach (sis::jqueryEfx() as $key => $value) {
                                            echo '<td><label style="display:initial" >
                                                        <span class="btn btn-default transition" style="width:100%;" >
                                                        <input onclick="javascript:if(this.checked){
                                                                                $(this).parent().find(\'i\').removeClass(\'hide\');
                                                                                $(this).parent().removeClass(\'btn-default\');
                                                                                $(this).parent().addClass(\'btn-success\');
                                                                            }else{
                                                                                $(this).parent().find(\'i\').addClass(\'hide\');
                                                                                $(this).parent().removeClass(\'btn-success\');
                                                                                $(this).parent().addClass(\'btn-default\');
                                                                            }" type="checkbox" style="display:none" name="animacao[]" id="'.$value.'" value="'.$value.'"><i class="fa fa-check-circle hide" style="font-size:13px;" ></i> '.$key.' </span></label></td>';
                                            $index++;
                                            if ($index == 3) { echo "</tr><tr class='no_bg'>"; $index = 0; }
                                        }
                                        ?>
                                    </tr>
                                </table>
                        </div>
                    </div>
                </div>


            </td>
        </tr>
        <tr>
            <td colspan="4" class="right" >
                <input type="button" value="Cancelar" class="btn btn-default" onclick="JavaScript:var x = confirm('Você deseja realmente cancelar?\n Os dados não salvos serão perdidos.'); if(x){ location.href='?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=tipo-list' }">
                <input type="button" value="Enviar" class="btn btn-primary" data-loading-text="Carregando..."  onclick="JavaScript:checkFormRequire(document.form_dados,'#error-box',checkCadTipoBanner);">
            </td>
        </tr>
    </table>
</form>
