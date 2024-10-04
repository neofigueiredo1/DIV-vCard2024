<?php

// VERIFICANDO A PERMISSÃO
if (!Sis::checkPerm('10002-2') && !Sis::checkPerm('10002-3'))
{
	Sis::setAlert('Você não tem acesso à este recurso!', 1, '/admin/');
}


//Armazenamento do id do tipo de banner
$tid = isset($_GET['tid']) ? $_GET['tid'] : "";
if($tid==0){ Sis::setAlert('Selecione um tipo para carregar a lista de banners!', 1,'?mod=banner&pag=banner&act=tipo-list'); }

//Envio dos dados do formulário
$exe = isset($_POST['exe']) ? $_POST['exe'] : "";
if(!is_numeric($exe)){ $exe=0; }
if($exe==1)
{
    $directIn->theInsert();
}
?>
<ol class="breadcrumb">
    <li><a href="?pag=<?php echo $pag; ?>&amp;act=tipo-list">Tipos de Banner</a></li>
    <li>
    		<a href="?pag=<?php echo $pag; ?>&amp;tid=<?php echo $tid; ?>">
			<?php
			$listaTipo = $directIn->tipoListSelected($tid);
            if(isset($listaTipo) && $listaTipo !== false)
                foreach ($listaTipo as $listaTipoArr)
                    echo $listaTipoArr['nome'];
			?>
			</a>
		</li>
		<li>Criar novo banner</li>
</ol>

<div class="btn-group">
    <a class="btn btn-default" href="?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=tipo-list">Tipos de banner</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=tipo-add" <?php echo (!Sis::checkPerm('10002-2') && !Sis::checkPerm('10002-4'))?"disabled='disabled'":""; ?> >Criar novo tipo</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=list&tid=<?php echo $tid; ?>" >Lista de banners</a>
    <a class="btn btn-default" href="?mod=<?php echo $mod; ?>&pag=<?php echo $pag; ?>&act=add&tid=<?php echo $tid; ?>" disabled="disabled" >Criar novo banner</a>
</div>

<hr />

<div class="alert alert-danger" id="error-box" style="display:none;"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;Preencha todos os campos corretamente!</div>

<form action="<?php echo Sis::currPageUrl(); ?>" method="post" class="form_dados" name="form_dados" enctype="multipart/form-data" >

    <input type="hidden" name="exe" value="1" >
    <input type="hidden" name="tid" value="<?php echo $tid; ?>" >

    <table class="table table_form">
			<tr>
				<th width="25%" class="middle bg">Situação</th>
				<td width="25%">
					<label class="radio-inline"><input type="radio" name="status" value="1" id="status1" checked > On-line</label>
					<label class="radio-inline"><input type="radio" name="status" value="0" id="status0" > Off-line</label>
				</td>
				<th width="25%" class="middle bg">Formato</th>
				<td width="25%" >
					<label class="radio-inline" ><input type="radio" name="formato" value="1" id="formato-1" checked >Imagem</label>
					<label class="radio-inline" ><input type="radio" name="formato" value="2" id="formato-2" >Adobe Flash</label>
				</td>
			</tr>
			<tr>
				<th class="top bg">Alinhamento</th>
				<td>
					<div class="radio"><label><input type="radio" name="alinhamento" value="0" id="alinhamento" checked> Esquerda</label></div>
					<div class="radio"><label><input type="radio" name="alinhamento" value="1" id="alinhamento" > Centralizado</label></div>
               <div class="radio"><label><input type="radio" name="alinhamento" value="2" id="alinhamento" > Direita</label></div>
				</td>
				<th width="25%" class="top bg">Estatísticas para:
					<a class="fa fa-info-circle ctn-popover"
					data-content="Ao marcar qualquer opção o sistema irá guardar informações sobre a impressão e cliques no banner permitindo a criação de uma breve estatística."
					data-original-title="Estatísticas" ></a>
				</th>
				<td width="25%" class="top">
					<div class="checkbox"><label><input type="checkbox" name="monitor_impressao" value="1" id="monitor_impressao" > Impresão</label></div>
					<div class="checkbox"><label><input type="checkbox" name="monitor_clique" value="1" id="monitor_clique" > Clique</label></div>
				</td>
			</tr>
			<tr>
				<th class="middle bg">Nome</th>
				<td colspan="3"><input type="text" class="form-control" name="nome" id="nome" data-required="true" ></td>
			</tr>
			<tr>
				<th class="middle bg" valign="top">Descrição</th>
				<td colspan="3"><textarea name="descricao" id="descricao" class="ckeditor"  ></textarea></td>
			</tr>
			<tr>
				<th class="top bg">
					Arquivo<br>
				</th>
				<td colspan="3">
					<div class="fl_left">
						Dimensões de exibição:
						largura: <b><?php echo $listaTipo[0]['largura']?>px</b>  &nbsp;x&nbsp;
						altura: <b><?php echo $listaTipo[0]['altura']?>px</b> <br>
						<input type="file" name="arquivo" id="arquivo" title="Escolher arquivo">
					</div>
					<div class="clear"></div>
				</td>
			</tr>

			<tr>
				<th class="top bg" > Páginas </th>
				<td colspan="3" >
					<div style="width:100%; float:left;" >
						<div id="caixa-tipo-1" style="width:100%;" >
							Selecione as páginas onde o banner será visualizado.
							<div style="background:#eee;margin:5px 0;overflow:auto;padding:10px">
								<table class="table" style="margin:0px;" >
									<tr class="no_bg">
										<td>
											<label for="pagina-0">
												<input type="checkbox" name="pagina[]" value="0" id="pagina-0">&nbsp;<span style="font-size:14px;">Todas</span>
											</label>
										</td>
									</tr>
									<?php
									//Lista de páginas
									$lista_pg_m = $directIn->listContentPages();
									if(!empty($lista_pg_m)){
										foreach($lista_pg_m as $lista_arr_m){
											?>
											<tr class="no_bg">
												<td style="padding:0px;" >
													<div class="radio" >
														<label for="pagina-<?php echo $lista_arr_m['pagina_idx']; ?>" >
															<input type="checkbox" name="pagina[]" value="<?php echo $lista_arr_m['pagina_idx']; ?>" id="pagina-<?php echo $lista_arr_m['pagina_idx']; ?>">
															<?php echo $lista_arr_m['titulo']; ?>
														</label>
													</div>
												</td>
												<?php
												//Lista de páginas filho
												$lista_pg_f = $directIn->listContentPages($lista_arr_m['pagina_idx']);
												if(!empty($lista_pg_f)){
													foreach($lista_pg_f as $lista_arr_f){
														?>
														<tr class="no_bg">
															<td style="padding:0px;padding-left:25px;" >
																<div class="radio" >
																	<label for="pagina-<?php echo $lista_arr_f['pagina_idx']; ?>">
																		<input type="checkbox" name="pagina[]" value="<?php echo $lista_arr_f['pagina_idx'];?>" id="pagina-<?php echo $lista_arr_f['pagina_idx'];?>" >
																		<?php echo $lista_arr_f['titulo'];?>
																	</label>
																</div>
															</td>
														</tr>
														<?php
													}
												}
												?>
											</tr>
											<?php
										}
									}
									?>
								</table>
							</div>
						</div>

					</div>
				</td>
			</tr>
			<tr>
				<th class="middle bg" >Link</th>
				<td><input type="text" class="form-control" name="url" id="url" placeholder="#" ></td>
				<th class="middle bg" >Alvo do Link</th>
				<td>
					<select name="alvo" class="form-control" id="alvo">
						<option value="_blank">Nova Janela</option>
						<option value="_parent">Janela Pai</option>
						<option value="_self">Mesma Janela</option>
						<option value="_top">Janela Superior</option>
					</select>
				</td>
			</tr>
			<tr>
				<th height="52" class="top bg">

					<a class="fa fa-exclamation-circle ctn-popover pull-right"
					style='font-size:20px;text-decoration: none;'
					data-content="Ao indicar um horário de exibição o banner somente é exibido no site no intervalo de horário especificado."
					data-original-title="Horário de exibição" ></a>

				</th>
				<td class="top"><label><input type="checkbox" name="horario" id="horario" value="1" onclick="javascript:checkboxCmdToogle(this,$('.horario'));"> &nbsp;Indicar horário de exibição</label></td>
				<td colspan="2" style="padding:0px;" >

					<div class="horario s-hidden">

						<table class="table table_form" style="margin:0px;" >
							<tr style="border:0px;" >
								<th width="50%" class="middle bg" >Horário</th>
								<td>
									<select name="horario_ini" class="form-control pull-left" style="width:45%;margin-right:15px;" >
										<option value="0" >Inicio</option>
										<?php
									         for($i=0;$i<24;$i++){ echo("<option value=".$i." >".$i."</option>"); }
										?>
									</select>
									     <select name="horario_fim" class="form-control pull-left" style="width:45%;" >
										<option value="0" >Fim</option>
									         <?php
									         for($i=0;$i<24;$i++){ echo("<option value=".$i." >".$i."</option>"); }
										?>

									</select>
								</td>
							</tr>
						</table>

					</div>
				</td>

			</tr>
			<tr>
				<th class="top bg">
					<a class="fa fa-exclamation-circle ctn-popover pull-right"
					style='font-size:20px;text-decoration: none;'
					data-content="Opção indicada para banner com exibição temporal, com data para iniciar a exibir e data de sua saída do site."
					data-original-title="Período de publicação" ></a>
				</th>
				<td class="top" >
						<label><input type="checkbox" name="indica_data" id="indica_data" onclick="javascript:checkboxCmdToogle(this,$('#validade'));"> &nbsp;Indicar período de publicação.</label>
				</td>
				<td colspan="2" style="padding:0px;" >
					<div id="validade" class="s-hidden" >

						<table class="table table_form" style="margin:0px;" >
							<tr style="border:0px;" >
								<th width="50%" class="middle bg" >Data de publicação</th>
								<td><input type="text" class="datepicker form-control" name="data_publicacao" id="data_publicacao" value="<?php echo date("d/m/Y");?>" /></td>
							</tr>
							<tr>
								<th width="50%" class="middle bg" >Data de expiração</th>
								<td><input type="text" class="datepicker form-control" name="data_expiracao" id="data_expiracao" value="<?php echo date('d/m/Y', strtotime(date('Y-m-d', strtotime(date('Y-m-d'))) . '+1 month')); ?>" /></td>
							</tr>
						</table>

					</div>
				</td>
			</tr>
			<tr>
				<td colspan="4" class="right" >

					<input type="button" value="Cancelar" class="btn btn-default" onclick="javascript:if(confirm('Você deseja realmente cancelar?\n Os dados não salvos serão perdidos.')){ window.location.href='?pag=<?php echo $pag; ?>&amp;act=list&amp;tid=<?php echo $tid; ?>'}else{ return false; };">
	     			<input type="button" value="Enviar" class="btn btn-primary" data-loading-text="Carregando..."  onclick="javascript:checkFormRequire(document.form_dados,'#error-box');">

				</td>
			</tr>
		</table>
	</form>
