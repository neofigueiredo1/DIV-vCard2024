<header>

	<div class="heading d-flex justify-content-between align-items-center p-4">
		<a href="/" class="btn btn-outline-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;" ><i class="fas fa-chevron-left" style="font-size:18px;margin-right:3px;"></i></a>

		<figure>
			<img src="/assets/images/logo_mru.svg" alt="" height="60" />
		</figure>

		<nav>
			<a href="javascript:;" onclick="javascript:$('.container_options').slideToggle('fast');" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;" ><i class="fas fa-ellipsis-v" style="font-size:18px;" ></i></a>
		</nav>
	</div>

	<div class="container_options" style="display:none;" >
		<nav class="d-flex justify-content-center m-auto my-3" style="border-radius:10px; background-color:rgba(0,0,0,0.2); box-shadow: inset 0 0 10px rgba(0,0,0,0.3); " >
		
			<div class="p-3" >
				<small class="text-light" style="font-size:11px;" >Exibir Legenda das situações</small><br>
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="customSwitch_legenda"
						onchange="javascript:if(this.checked){$('.legenda-status').fadeIn('fast');}else{$('.legenda-status').fadeOut('fast');};" 
					>
					<label class="custom-control-label text-light" for="customSwitch_legenda"></label>
				</div>
			</div>
			<div class="p-3" >
				<small class="text-light" style="font-size:11px;" >Mapa em alto contraste</small><br>
				<div class="custom-control custom-switch">
					<input type="checkbox" class="custom-control-input" id="customSwitch1"
						onchange="javascript:if(this.checked){$('#empre_planta').addClass('contraste_mode');}else{$('#empre_planta').removeClass('contraste_mode');};" 
					>
					<label class="custom-control-label text-light" for="customSwitch1"></label>
				</div>
			</div>
			<div class="p-3" >
				<small class="text-light" style="font-size:11px;" >Exibir por situação da venda</small><br>
				<div class="btn-group btn-group-toggle" data-toggle="buttons" style="border-radius:6px;" >

					<label class="btn btn-sm btn-outline-light active" style="font-size:13px;" >
						<input type="radio" name="situacao_venda" id="situacao_venda_all" value="all" checked
							onclick="javascript:evvSetViewStatus(this.value);" 
						> Todos
					</label>

					<?php foreach ($m_espelho_vendas->getStatusUnidade() as $key => $statusUnidade):
						$backgroundColor = $m_espelho_vendas->getStatusUnidadeCor($key);
						if ($key=='livre' && $backgroundColor=='transparent') {
							$backgroundColor = "#465623";
						}
					?>
						<label id="lb_situacao_venda_<?php echo $key ?>" class="btn btn-sm btn-outline-light active" style="font-size:13px;" >
							<input type="radio" name="situacao_venda" id="situacao_venda_<?php echo $key ?>" value="<?php echo $key ?>"
								onclick="javascript:evvSetViewStatus(this.value);" 
							> <?php echo $statusUnidade; ?>
							<style type="text/css">
								#lb_situacao_venda_<?php echo $key ?>.active{
									color: #fff !important;
									background-color: <?php echo $backgroundColor; ?> !important;
								}
							</style>
						</label>
					<?php endforeach ?>

				</div>
			</div>


		</nav>
	</div>

</header>