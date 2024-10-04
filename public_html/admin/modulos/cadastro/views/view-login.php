<?php
	
	$act = (isset($_GET['act'])) ? trim($_GET['act']) : '';
	if ($act=='logout') {
		self::logout();
	}

	$exe = (isset($_POST['exe'])) ? (int)$_POST['exe'] : 0;

	if(count($_POST) > 0){

		switch ($exe) {
			case 1:
				self::login();
				break;
		}

	}
	
	$_SESSION["plataforma_url_back_cadastro"] = $_SERVER['REQUEST_URI'];

?>


<section class=" w-100 h-100 d-flex	align-items-center justify-content-center">
	

	<div class="s_login d-flex flex-column align-items-center" >

		<figure class="mb-5">
			<img src="/assets/images/logo_mru.svg" alt="" width="150">
		</figure>

		<h1 class="text-white mb-5" style="font-size:32px;">Espelho de Vendas</h1>

		<div class="login-container" >
						
			<form action="" name="form_login" method="post" class="form_login" id="form-login" >
				<input type="hidden" name="exe" value="1">
				<input type="hidden" name="g_recaptcha_response" value="" />

				<?php
					$emailSession = "";
					$msgSession = null;
					if(isset($_SESSION['plataforma_login_usuario_alerts']) && is_array($_SESSION['plataforma_login_usuario_alerts']))
					{
						$msgSession=$_SESSION['plataforma_login_usuario_alerts'];
						unset($_SESSION['plataforma_login_usuario_alerts']);
					}
				   
					if(isset($_SESSION['plataforma_cadastro_usuario_erros']) && is_array($_SESSION['plataforma_cadastro_usuario_erros']))
					{
						$msgSession=$_SESSION['plataforma_cadastro_usuario_erros'];
						unset($_SESSION['plataforma_cadastro_usuario_erros']);
					}

				   if ($msgSession!=null) {

				      $tipo="warning";
				      switch($msgSession['tipo'])
				      {
				         case 1 : $tipo="warning";  $icone = "<i class='fa fa-exclamation-triangle'></i>&nbsp;&nbsp;";
				         break;
				         case 2 : $tipo="info";     $icone = "<i class='fa fa-info-circle'></i>&nbsp;&nbsp;";
				         break;
				         case 3 : $tipo="success";  $icone = "<i class='fa fa-check-circle-o'></i>&nbsp;&nbsp;";
				         break;
				         case 4 : $tipo="danger";   $icone = "<i class='fa fa-ban'></i>&nbsp;&nbsp;";
				         break;
				      }
				   	?>

				      <div id="alert-bts" style="display: block;font-size: 14px;" class="alert alert-<?php echo $tipo; ?> mb-20">
				         <button onclick="javascript: $(this).parent().slideUp('fast');" type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				         <?php echo $icone.$msgSession['mensagem']; ?>
				      </div>
				      <?php
				      	if(array_key_exists('email', $msgSession)){
				      		$emailSession = $msgSession['email'];
				      	}
				         //unset($msgSession);
				   	// }else{
				      ?>
				      <?php
				   }
				?>

				<div class="alert alert-danger mb-20" id="error-box" style="display:none;font-size: 14px;" >
					Preencha os dados corretamente para continuar!
				</div>

				<div class="form-group mb-2" >
					<input type="email" name="email" class="form-control rounded-100" placeholder="Seu e-mail" aria-describedby="sizing-addon1" data-required="true" value="" >
				</div>

				<div class="form-group mb-2" >
					<input type="password" name="senha" class="form-control rounded-100" data-required="true" value="" placeholder="Sua senha" aria-describedby="sizing-addon1">
				</div>
				
				<div class="form-group  mb-0" >

					<input type="button" name="submit-1" class="btn btn-outline-primary d-flex justify-content-center align-items-center fs-16 max-150 w-100" value="Fazer login" onclick="javascript:Util.checkFormRequire(document.form_login, '#error-box', checkLogin);" />

				</div>
			</form>

			
		</div>

		<small class="text-white my-5">
			&copy;<?php echo Date('Y'); ?> maerainhaurbanismo.com.br
		</small>


	</div>
</section>










