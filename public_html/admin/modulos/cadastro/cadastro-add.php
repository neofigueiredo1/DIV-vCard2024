<?php
    $enviar = isset($_POST['enviar']) ? $_POST['enviar'] : "";
    if ($enviar != "") {
    	if ($enviar == "1") {
    		$directIn->theInsert();
    	}
    }
?>

<ol class="breadcrumb">
    <li><a href="?mod=<?php echo $mod ?>&pag=cadastro">Cadastros</a></li>
    <li class="active">Adicionar cadastro</li>
</ol>

<div class="btn-group">
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=cadastro">Cadastros</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=cadastro&act=add" disabled="disabled">Adicionar cadastro</a>
</div>
<div class="btn-group">
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=area-interesse">Áreas de interesse</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=area-interesse&act=add" >Nova área de interesse</a>
</div>
<div class="btn-group">
    <a class="btn btn-success" href="?mod=<?php echo $mod ?>&pag=cadastro&act=exportar">Exportar cadastros</a>
</div>

<hr />

<div class="alert alert-danger" id="error-box" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Preencha todos os campos corretamente!</div>

<form  action="<?php echo sis::currPageUrl(); ?>" method="post" enctype="multipart/form-data" class="form_dados" name="form_dados">
	<input type="hidden" name="enviar" value="1">
	<table class="table table_form">
    	<tr>
            <th width="20%" class="middle bg">Situação</th>
            <td class="middle">
                <label class="radio-inline">
                  <input type="radio" id="" name="status" value="1" checked>Ativo
                </label>
                <label class="radio-inline">
                  <input type="radio" id="" name="status" value="0">Inativo
                </label>
                <label class="radio-inline">
                  <input type="radio" id="" name="status" value="4" >Newsletter
                </label>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th width="20%" class="middle bg">Nome completo </th>
            <td colspan="3">
                <input type="text" class="form-control" name="nome_completo" id="nome_completo" data-required="true">
            </td>
        </tr>
    	<tr>
			<th width="20%" class="middle bg">
                Nome informal
                <a class="fa fa-info-circle ctn-popover" data-content="<p>Nome como prefere ser chamado.</p>" data-original-title="Nome informal" ></a>
            </th>
			<td>
                <input type="text" class="form-control" name="nome_informal" id="nome_informal">
            </td>
            <th width="20%" class="middle bg">CPF </th>
            <td>
                <input type="text" class="form-control cpf" name="cpf_cnpj" id="cpf_cnpj">
            </td>
		</tr>
        <tr>
            <th class="middle bg">E-mail: </th>
            <td>
                <input type="email" class="form-control" name="email" id="email" data-required="true">
            </td>
            <th class="middle bg">Telefone residencial </th>
            <td>
                <input type="text" class="form-control telefone" name="telefone_resid" id="telefone_resid">
            </td>
		</tr>
        <tr>
			<th class="middle bg">Telefone comercial </th>
            <td>
                <input type="text" class="form-control telefone" name="telefone_comer" id="telefone_comer">
            </td>
            <th class="middle bg">Celular </th>
            <td>
                <input type="text" class="form-control telefone" name="celular" id="celular">
            </td>
        </tr>
        <tr>
            <th class="middle bg">Gênero </th>
            <td class="middle">
                <label class="radio-inline">
                  <input type="radio" id="" name="genero" value="1" checked>Masculino
                </label>
                <label class="radio-inline">
                  <input type="radio" id="" name="genero" value="2">Feminino
                </label>
            </td>
            <th class="middle bg">Data de nascimento </th>
            <td>
                <input type="date" class="form-control" name="data_nasc" id="data_nasc" >
            </td>
        </tr>
        <tr>
            <th class="middle bg">Endereço </th>
            <td>
                <input type="text" class="form-control" name="endereco" id="endereco">
            </td>
            <th class="middle bg">Nº </th>
            <td>
                <input type="text" class="form-control" name="numero" id="numero">
            </td>
        </tr>
        <tr>
            <th class="middle bg">Complemento </th>
            <td>
                <input type="text" class="form-control" name="complemento" id="complemento">
            </td>
            <th class="middle bg">Bairro </th>
            <td>
                <input type="text" class="form-control" name="bairro" id="bairro">
            </td>
        </tr>
        <tr>
            <th class="middle bg">Cep </th>
            <td>
                <input type="text" class="form-control" name="cep" id="cep">
            </td>
            <th class="middle bg">Cidade </th>
            <td>
                <input type="text" class="form-control" name="cidade" id="cidade">
            </td>
		</tr>
        <tr>
            <th class="middle bg">Estado </th>
            <td>
                <input type="text" class="form-control" name="estado" id="estado">
            </td>
            <th class="middle bg">País </th>
            <td>
                <input type="text" class="form-control" name="pais" id="pais">
            </td>
       </tr>
       <tr>
            <th>
                <div class='checkbox'>
                    <label>
                        <input name="definir" type="checkbox" value="" id="c_senha" onclick="javascript:if(this.checked){$('#senha').fadeIn('fast');}else{$('#senha').fadeOut('fast');};" >
                        <b>Definir senha de acesso:</b>
                    </label>
                </div>
            </th>
           <td></td>
           <td></td>
           <td></td>
       </tr>
       <tr style="display:none;" id="senha">
            <th class="middle bg">Senha </th>
			<td>
                <input class="form-control" type="password" name="senha" id="senha">
            </td>
            <th class="middle bg">Confirme a senha </th>
            <td>
                <input class="form-control" type="password" name="senha_confirm" id="senha_confirm">
            </td>
	   </tr>
       <tr>
            <th>
                <div class='checkbox'>
                    <label>
                        <input name="receber_boletim" type="checkbox" value="1"/>
                        <b>Receber boletim? </b>
                    </label>
                </div>
            </th>
            <td></td>
            <td></td>
            <td></td>
		</tr>
        <tr>
            <td colspan="4" class="right" >
                <input type="button" value="Cancelar" class="btn btn-default" onclick="JavaScript:var x = confirm('Você deseja realmente cancelar?\n Os dados não salvos serão perdidos.'); if(x){ location.href='?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>' }">
                <input type="button" value="Enviar" class="btn btn-primary" data-loading-text="Carregando..."  onclick="JavaScript:checkFormRequire(document.form_dados,'#error-box', checkCadastro);">
            </td>
        </tr>
	</table>
</form>
<script>
    $('#cpf_cnpj').mask('999.999.999-99');
</script>