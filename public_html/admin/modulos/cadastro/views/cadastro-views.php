<?php

	include("admin/modulos/cadastro/cadastro-model.php");

	class cadastro_views extends HandleSql{

		public $TB_CADASTRO;
		public $TB_CADASTRO_LINKS;

		public $mod,$pag;

		public function __construct()
		{
			parent::__construct();

			$this->mod = "cadastro";
			$this->pag = "cadastro";

			$this->TB_CADASTRO = self::getPrefix() . "_cadastro";
			$this->TB_CADASTRO_LINKS = self::getPrefix() . "_cadastro_links";
			
			$basedir = $_SERVER['DOCUMENT_ROOT'];
			if(!is_dir($basedir.DS.PASTA_CONTENT.DS.$this->pag)){
				mkdir($basedir.DS.PASTA_CONTENT.DS.$this->pag);
			}
			if(!is_dir($basedir.DS.PASTA_CONTENT.DS.$this->pag.DS."profile")){
				mkdir($basedir.DS.PASTA_CONTENT.DS.$this->pag.DS."profile");
			}

		}

		public function getView($nome="")
		{
			if(file_exists('admin/modulos/cadastro/views/' . $nome . '.php')){
				require( $nome . '.php');
			}else{
				echo 'View não encontrada';
			}
		}

		public function getCadastro($uid=0, $dados="")
		{
			$array = array('cadastro_idx' => $uid);
        	return parent::sqlCRUD($array, $dados, $this->TB_CADASTRO, '', 'S', 0, 0);
		}

		public function getCadastroLinks($uid=0, $dados="")
		{
			$array = array('cadastro_idx' => $uid, 'orderby'=>' Order By ranking ASC ');
        	return parent::sqlCRUD($array, $dados, $this->TB_CADASTRO_LINKS, '', 'S', 0, 0);
		}

		public function isLogged(){
			
			//verifica se existe um cookie armazenado
			if (isset($_COOKIE["ecommerce_usuario"]) && !isset($_SESSION['ecommerce_usuario'])) {
				$usuario_dados = unserialize($_COOKIE['ecommerce_usuario']);
				if (is_array($usuario_dados)){
					if (array_key_exists("id",$usuario_dados)) {
						$_SESSION['ecommerce_usuario'] = $usuario_dados;
					}
				}
			}
			if(isset($_SESSION['ecommerce_usuario'])){
				if(is_array($_SESSION['ecommerce_usuario'])){
					return true;
				}
			}
			return false;
		}

		

		/**
		 * Login no e-commerce
		 */
		public function login()
		{
			$email 		= Text::clean(addslashes(trim(strip_tags($_POST['email']))));
			$password 	= md5(addslashes(trim(strip_tags($_POST['senha']))));

			$usuarioArr = parent::select("SELECT cadastro_idx, nome_completo, nome_informal, email FROM ".$this->TB_CADASTRO." WHERE email = '" . $email . "' AND senha =  '" . $password . "' AND status = 1 LIMIT 0,1");

			if(is_array($usuarioArr) && count($usuarioArr) > 0){
				//foreach ($usuarioArr as $usuario){
				$usuario = $usuarioArr[0];
					
					/**
					 * Gera a sessão usuário, e armazena um array com as informações do mesmo.
					 */
					$usuario_dados = array('id' => $usuario['cadastro_idx'],
											'nome'	=> $usuario['nome_completo'],
											'email' => $usuario['email']
											);

					$_SESSION['ecommerce_usuario'] = $usuario_dados;

					$lembrar_dados = (isset($_POST['lembrar_dados']))?(int)$_POST['lembrar_dados']:0;

					if ($lembrar_dados==1) {
						setcookie("ecommerce_usuario", serialize($usuario_dados), time() + (86400 * 5)); // 86400 = 1 day
					}

					/**
					 * Inserindo o Log, informando que o login foi bem sucedido.
					 */
					//Sis::insertLog(0, "Ecommerce - Login", "efetuado", $_SESSION['ecommerce_usuario']['id'], $_SESSION['ecommerce_usuario']['nome'], "Sucesso");

					//trackers - facebook / analytics
					$_SESSION["platform_event_tracker"] = "gtag('event','login',{method:'Site'});";
					$_SESSION["platform_event_tracker_destroy"] = 1;

					/**
					 * Redirecionando para onde ele estava ou para a inicial do site.
					 */
					
					if (isset($_SESSION["plataforma_url_back_login"])) {
						$sessionTemp = $_SESSION["plataforma_url_back_login"];
						unset($_SESSION["plataforma_url_back_login"]);
						die('<script>window.location = "'.$sessionTemp.'";</script>');
					}else{
						echo '<script>window.location = "/";</script>';
					}

				//}
			}else{
				/**
				 * Caso o usuário ou senha estejam incorretos, o log é inserido, e o usuário volta para a senha e login.
				 */
				Sis::insertLog(0, "Ecommerce - Login", "", 0, "", "Tentativa de Login utilizando o e-mail  ".$email);
				ob_end_clean();
				die('<script>alert("Não foi possível efetuar o login!");history.back();</script>');
			}
		}

		

		public function logout()
		{
			if (isset($_SERVER['HTTP_COOKIE'])) {
			   setcookie('ecommerce_usuario', '', time()-1000);
			}
			unset($_SESSION['ecommerce_usuario']);
			Sis::redirect('/');
		}


		/**
		 * Seleciona os dados do usuário em sessão
		 * @param String $dados => Dados que deseja selecionar. Caso seja vazio, ele seleciona todos os dados.
		 */
		public function getMyDataUserInfo($dados=""){
			if(isset($_SESSION['ecommerce_usuario']['id'])){
				return parent::sqlCRUD(array('cadastro_idx' => $_SESSION['ecommerce_usuario']['id']), $dados, $this->TB_CADASTRO, '', 'S', 0, 0);
			}
			return false;
		}
       


	} //End class
?>

