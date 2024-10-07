<?php

global $cadastroId;

$cadastroId = (isset($_GET['cadastroId']))?(int)$_GET['cadastroId']:$cadastroId;

$cadastro = self::getCadastro($cadastroId);
$cadastroLinks = self::getCadastroLinks($cadastroId);

$cadastro = $cadastro[0];

$descritivo = $cadastro['descricao'];

?>

<style type="text/css">

	body {
	    background: <?php echo $cadastro['theme_color_c']; ?>;
	}
	.container{
		padding: 25px 0px;
		background: <?php echo $cadastro['theme_color_c']; ?>;
		max-width: initial;
	}
	.card {
		color: <?php echo $cadastro['theme_text_color']; ?>;
	    width: 350px;
	    border-radius: 10px;
	   background: linear-gradient(145deg, <?php echo $cadastro['theme_color_a']; ?>, <?php echo $cadastro['theme_color_b']; ?>);
	    border: none
	}
	.neo-button {
		display: flex;
		align-items: center;
		justify-content: center;
	    width: 40px;
	    height: 40px;
	    outline: 0 !important;
	    cursor: pointer;
	    color: <?php echo $cadastro['theme_color_a']; ?>;
	    font-size: 15px;
	    border: none;
	    margin-right: 10px;
	    border-radius: 50%;
		background: #FFFFFF;
	}
	.neo-button .fab{
		color: <?php echo $cadastro['theme_color_a']; ?>; font-size: 18px;
	}
	.num{
		
		color:#eee !important;
	}
	hr{
		opacity:0.2;
	}
	.neo-button:active {
	   border-radius: 50%;
		background: #ffffff;
		box-shadow:  28px 28px 57px #000000, 
		             -28px -28px 57px #000000;
	}

	/*.fa-facebook {
	    color: #3b5998
	}

	.fa-linkedin {
	    color: #0077b5
	}

	.fa-google {
	    color: #dc4e41
	}

	.fa-youtube {
	    color: #cd201f
	}

	.fa-twitter {
	    color: #55acee
	}*/

	.profile_button{
		color: <?php echo $cadastro['theme_text_color']; ?>;
		padding:10px; 
		border:none;
		outline:0 !important;
		border-radius: 50px;
		background: #333333;
		width: 100%;
	
		
	}

	.btn:not(.btn-light,.btn-outline-light:hover){
		height: 44px;
		font-size: 14px;
		color: <?php echo $cadastro['theme_text_color']; ?>;
	}



	.link-button{
		width: 100%;
		height: 44px;
		display: flex;
		padding: 0px;
		border-radius: 50px;
		margin-bottom:10px;
	}

	.link-button .fab,
	.link-button .fas{
		width:42px;
		height: 42px;
		background-color: #fff;
		color: #000;
		display: flex;
		align-items: center;
		justify-content: center;
		border-radius: 50px;
		font-size:16px;
	}

	figure{
		position: relative;
		width:150px;
		margin:0px auto 30px auto;
	}

	.company_logo{
		position: absolute;
		right: -50px;
		bottom: -15px;
	}


</style>

<div class="container d-flex justify-content-center align-items-center">
    <div class="card p-3 py-4">
        <div class="text-center"> 
		
        	<figure>
        		<img src="/sitecontent/cadastro/profile/<?php echo $cadastro['imagem']; ?>" width="150" class="rounded-circle">
        		<img src="/sitecontent/cadastro/profile/<?php echo $cadastro['empresa_imagem']; ?>" width="90" class="rounded-circle company_logo" >
        	</figure>

            <h3 class="mt-2"><?php echo $cadastro['nome_informal']; ?></h3>
			<span class="mt-1 clearfix"><strong><?php echo $cadastro['empresa_cargo']; ?></strong> <br/> <?php echo $cadastro['empresa_nome']; ?></span>
			
			<?php if( trim(strip_tags($descritivo)) != "" ): ?>
				<hr class="bg-white" >
				<small class="mt-4" style="font-size:13px; text-align:justify;place-items:initial;" ><?php echo $descritivo; ?></small>
				<hr class="bg-white" >
			<?php else: ?>
				<hr class="bg-transparent" >
			<?php endif ?>


		<?php foreach($cadastroLinks as $key => $linkInfo):?>
			<div class="links-buttons"> 
				<a href="<?php echo $linkInfo['valor'] ?>" class="btn btn-outline-light link-button" target="_blank" >
					<i class="<?php echo $linkInfo['icone'] ?>"></i> 
					<div class="flex-fill h-100 d-flex align-items-center justify-content-start pl-3" style="font-size:15px;" >
						<?php echo $linkInfo['titulo'] ?>
					</div>
				</a> 
			</div>
		<?php endforeach ?>

			  
			 <div class="profile mt-5">
			 
				 <a href="https://vcard.div.tec.br/sitecontent/cadastro/vcards/<?php echo $cadastro['vcard'] ?>" target="_blank" class="btn btn-light w-100 rounded-pill d-flex align-items-center justify-content-center" >Salvar Contato</a>

			</div>
			   
        </div>
    </div>
</div>