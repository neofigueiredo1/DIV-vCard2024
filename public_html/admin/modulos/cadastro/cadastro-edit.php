<?php
	$enviar = isset($_POST['enviar']) ? (int)$_POST['enviar'] : 0 ;
	$id     = isset($_GET['id'])      ? (int)$_GET['id']      : 0 ;
	if ($enviar ===	 1) $directIn->theUpdate();
?>

<ol class="breadcrumb">
    <li><a href="?mod=<?php echo $mod ?>&pag=cadastro">Cadastros</a></li>
    <li class="active">Editar cadastro</li>
</ol>

<div class="btn-group">
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=cadastro">Cadastros</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=cadastro&act=add">Adicionar cadastro</a>
</div>
<div class="btn-group">
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=area-interesse">Áreas de interesse</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod ?>&pag=area-interesse&act=add" >Nova área de interesse</a>
</div>
<div class="btn-group">
  	<a class="btn btn-success" href="?mod=<?php echo $mod ?>&pag=cadastro&act=exportar">Exportar cadastros</a>
</div>

<hr />

<section class="content">
	<?php
	$list = $directIn->listSelected($id);
	if(is_array($list) && count($list) > 0){
		foreach ($list as $arrayList){
			?>
			<form action="<?php echo sis::currPageUrl(); ?>" method="post" id="form_dados" class="form_dados" name="form_dados" enctype="multipart/form-data">
				<input type="hidden" name="enviar" value="1">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<table class="table table_form">
			    	<tr>
			            <th width="20%" class="middle bg">Situação</th>
			            <td class="middle">
			               <label class="radio-inline">
								  <input type="radio" id="" name="status" value="1" <?php if ($arrayList['status']=="1"){ echo "checked='checked'"; } ?>>Ativo
								</label>
								<label class="radio-inline">
								  <input type="radio" id="" name="status" value="0" <?php if ($arrayList['status']=="0"){ echo "checked='checked'"; } ?>>Inativo
								</label>
								<label class="radio-inline">
								  <input type="radio" id="" name="status" value="4" <?php if ($arrayList['status']=="4"){ echo "checked='checked'"; } ?>>Newsletter
								</label>
			            </td>
			            <td></td>
            			<td></td>
			        </tr>
			        <tr>
			            <th width="20%" class="middle bg">Nome completo </th>
			            <td colspan="3">
			                <input type="text" class="form-control" name="nome_completo" id="nome_completo" data-required="true" value="<?php echo $arrayList['nome_completo']; ?>">
			            </td>
			        </tr>
			    	<tr>
						<th width="20%" class="middle bg">
			                Nome informal
			                <a class="fa fa-info-circle ctn-popover" data-content="<p>Nome como prefere ser chamado.</p>" data-original-title="Nome informal" ></a>
			            </th>
						<td>
			                <input type="text" class="form-control" name="nome_informal" id="nome_informal" value="<?php echo $arrayList['nome_informal']; ?>">
			            </td>
			            <th width="20%" class="middle bg">CPF </th>
			            <td>
			                <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" value="<?php echo $arrayList['cpf_cnpj']; ?>">
			            </td>
					</tr>
			        <tr>
			            <th class="middle bg">E-mail: </th>
			            <td>
			                <input type="email" class="form-control" name="email" id="email" data-required="true" value="<?php echo $arrayList['email']; ?>">
			            </td>
			            <th class="middle bg">Telefone residencial </th>
			            <td>
			                <input type="text" class="form-control telefone_edit" name="telefone_resid" id="telefone_resid" value="<?php echo $arrayList['telefone_resid']; ?>">
			            </td>
					</tr>
			        <tr>
						<th class="middle bg">Telefone comercial </th>
			            <td>
			                <input type="text" class="form-control telefone_edit" name="telefone_comer" id="telefone_comer" value="<?php echo $arrayList['telefone_comer']; ?>">
			            </td>
			            <th class="middle bg">Celular </th>
			            <td>
			                <input type="text" class="form-control telefone_edit" name="celular" id="celular" value="<?php echo $arrayList['celular']; ?>">
			            </td>
			        </tr>
			        <tr>
			            <th class="middle bg">Gênero </th>
			            <td class="middle">
			                <label class="radio-inline">
			                  <input type="radio" id="" name="genero" value="1" <?php if ($arrayList['genero']=="1"){ echo "checked='checked'"; } ?>>Masculino
			                </label>
			                <label class="radio-inline">
			                  <input type="radio" id="" name="genero" value="2" <?php if ($arrayList['genero']=="2"){ echo "checked='checked'"; } ?>>Feminino
			                </label>
			            </td>
			            <th class="middle bg">Data de nascimento </th>
			            <td>
			                <input type="text" class="form-control" name="data_nasc" id="data_nasc" value="<?php echo (strtotime($arrayList['data_nasc'])!==false)?date("d/m/Y",strtotime($arrayList['data_nasc'])):''; ?>">
			            </td>
			        </tr>
			        <tr>
			            <th class="middle bg">Endereço </th>
			            <td>
			                <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo $arrayList['endereco']; ?>">
			            </td>
			            <th class="middle bg">Nº </th>
			            <td>
			                <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $arrayList['numero']; ?>">
			            </td>
			        </tr>
			        <tr>
			            <th class="middle bg">Complemento </th>
			            <td>
			                <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $arrayList['complemento']; ?>">
			            </td>
			            <th class="middle bg">Bairro </th>
			            <td>
			                <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo $arrayList['bairro']; ?>">
			            </td>
			        </tr>
			        <tr>
			            <th class="middle bg">Cep </th>
			            <td>
			                <input type="text" class="form-control" name="cep" id="cep" value="<?php echo $arrayList['cep']; ?>">
			            </td>
			            <th class="middle bg">Cidade </th>
			            <td>
			                <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $arrayList['cidade']; ?>">
			            </td>
					</tr>
			        <tr>
			            <th class="middle bg">Estado </th>
			            <td>
			                <input type="text" class="form-control" name="estado" id="estado" value="<?php echo $arrayList['estado']; ?>">
			            </td>
			            <th class="middle bg">País </th>
			            <td>
			                <input type="text" class="form-control" name="pais" id="pais" value="<?php echo $arrayList['pais']; ?>">
			            </td>
			       	</tr>
			       <tr>
			            <th>
			                <div class='checkbox'>
			                    <label>
			                        <input name="definir" type="checkbox" value="" id="c_senha" onclick="javascript:$('#senha').toggle('slow');" >
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
			                        <input name="receber_boletim" type="checkbox" value="1" <?php if($arrayList['receber_boletim']){ echo "checked='checked'"; } ?>>
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
			<?php
		}
	}else{
		echo "<div class='alert alert-warning'>
               <i class='fa fa-exclamation-triangle'></i>&nbsp;&nbsp;
               Nenhum registro encontrado.
            </div>";
		sis::redirect("?mod=".$mod."&pag=" . $pag , 2);
	}
	?>
</section>
<script>
    $('#cpf_cnpj').mask('999.999.999-99');
    jQuery(document).ready(function($) {
		$('.telefone_edit').focusout(function(){
	      var phone, element;
	      element = $(this);
	      element.unmask();
	      phone = element.val().replace(/\D/g, '');
	      element.val(phone);
	      if(phone.length > 10) {
	         element.mask("(99) 99999-9999");
	      } else {
	         element.mask("(99) 9999-99999");
	      }
	   }).trigger('focusout');
		// $("#c_senha").click(function() {
		// 	$("#senha").toggle("slow");
		// });
	});
</script>