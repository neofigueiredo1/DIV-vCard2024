<?php
	/**
	 * Classe de gerenciamento de dados dos cadastros
	 *
	 * @package cadastro
	 **/
	class cadastro extends cadastro_m {

		public $MODULO_CODIGO 		= "10013";
		public $MODULO_AREA 		= "Cadastro";
		public $mod, $pag, $act, $pasta_modulo;

		public function __construct() {
			parent::__construct();
			
			global $act;
			$this->mod = "cadastro";
			$this->pag = "cadastro";
			$this->act = $act;

			$basedir = BASE_PATH.DS.PASTA_CONTENT;
			$this->pasta_modulo = $basedir.DS.$this->mod.DS;

			if(!is_dir($this->pasta_modulo)){
			   mkdir($this->pasta_modulo);
			}
		}

		public function listAll($filtros="", $atualPageDi=0, $totalPages=0, $campos="") {
			if($totalPages==0){
				$totalPages = 20;
			}

			if (is_array($filtros) && count($filtros) > 0) {
				$array = $filtros;
			}

			$array['orderby'] = 'ORDER BY data_cadastro DESC';

			$dados = parent::listAllM($array, $this->TB_CADASTRO, $atualPageDi, $totalPages, $campos);

			/**
			* Se os campos vierem armazenados em um array,
			* é porque está sendo feita uma exportação dos cadastros
			*/
			if(is_array($campos) && count($campos) > 0){
		      	if(is_array($dados) && count($dados) > 0){

		      		$iCount = 0;
		      		$bCount = -1;

		      		$fileName = "exportacao-directin-".rand().".xls";
			      	$exportText = '<table style="font-family: Arial; font-size: 14px;" border="1"><tr>';

			      	foreach ($campos as $key => $campo) {
			      		$exportText .=	'<th>'.$campos[$iCount].'</th>';
		      	 		$iCount++;
			      	}

			      	$path 	= BASE_PATH.DS.PASTA_CONTENT.DS.$_GET['mod'].DS.$fileName;
	         		$handle 	= fopen($path, "wb");
		            fwrite($handle,$exportText);

		            $exportText = "";
			      	foreach ($dados as $key => $dado) {
				      	$exportText .= '</tr><tr>';
				      	foreach ($campos as $key => $campo) {
				      	 	$bCount++;
				      	 	$contentTd = "";
				      	 	/**
				      	 	 * Verifica se é masculino ou feminino
				      	 	 */
				      	 	if($campos[$bCount] !== "genero"){
				      	 		$contentTd = $dado[$campos[$bCount]];
				      	 	}else if($dado[$campos[$bCount]] == "1"){
				      	 		$contentTd = "M";
				      	 	}else{
				      	 		$contentTd = "F";
				      	 	}
				      		$exportText .=	'<td>'.$contentTd.'</td>';
				      		if($bCount == count($campos)-1){
				      		  	$exportText .= '</tr><tr>';
				      		  	$bCount = -1;
				      		  	next($campos);
				      		}
				      	}
				      }

	   				$exportText .= '</tr></table>';

				      fwrite($handle,$exportText);
				      return $fileName;
			      }
		      	return $exportText;
	      	}else{
				return $dados;
	      	}
		}


		public function listSelected($id = 0, $campos="") {
			$id = (isset($id) && is_numeric($id)) ? $id : 0;
			$array = array('cadastro_idx' => $id);
	      $dados = parent::sqlCRUD($array, $campos, $this->TB_CADASTRO, '', 'S', 0, 0);

			if(is_array($dados) && count($dados)){
				return $dados;
			} else {
				return false;
			}
		}


		


		public function listLastInsert() {
			$array = array('orderby' => 'ORDER by data_cadastro DESC', 'status' => 1);

	      $dados = parent::sqlCRUD($array, '', $this->TB_CADASTRO, '', 'S', 0, 0);

			if(is_array($dados) && count($dados)){
				return $dados;
			} else {
				return false;
			}
		}


		


		public function listUserSeleciona($id = 0, $campos="") {
			$id = (isset($id) && is_numeric($id)) ? $id : 0;
			$array = array('cadastro_idx' => $id);
	      $dados = parent::sqlCRUD($array, $campos, $this->TB_AREA_SELECIONA, '', 'S', 0, 0);

			if(is_array($dados) && count($dados)){
				return $dados;
			} else {
				return false;
			}
		}


		public function theInsert() {

			$status    		  	= isset($_POST['status'])    ? (int)$_POST['status']             				: 0 ;
			$nome_completo    = isset($_POST['nome_completo'])   ? Text::clean($_POST['nome_completo']) 	: '';
			$nome_informal    = isset($_POST['nome_informal']) ? Text::clean($_POST['nome_informal'])   	: '';
			$genero			  	= isset($_POST['genero'])    ? (int)$_POST['genero']             				: 0 ;
			$data_nasc		  	= isset($_POST['data_nasc']) ? Text::clean($_POST['data_nasc'])       		: '';
			$email			  	= isset($_POST['email']) ? Text::clean($_POST['email'])       					: '';
			$senha			  	= isset($_POST['senha']) ? md5(Text::clean($_POST['senha']))       			: '';
			$telefone_resid	= isset($_POST['telefone_resid']) ? Text::clean($_POST['telefone_resid']) 	: '';
			$telefone_comer   = isset($_POST['telefone_comer']) ? Text::clean($_POST['telefone_comer']) 	: '';
			$celular		  		= isset($_POST['celular']) ? Text::clean($_POST['celular'])       			: '';
			$endereco		  	= isset($_POST['endereco']) ? Text::clean($_POST['endereco'])       			: '';
			$numero			  	= isset($_POST['numero']) ? Text::clean($_POST['numero'])       				: '';
			$complemento	  	= isset($_POST['complemento']) ? Text::clean($_POST['complemento'])       	: '';
			$bairro			  	= isset($_POST['bairro']) ? Text::clean($_POST['bairro'])       				: '';
			$cep			  		= isset($_POST['cep']) ? Text::clean($_POST['cep'])       						: '';
			$cpf_cnpj			  		= isset($_POST['cpf_cnpj']) ? Text::clean($_POST['cpf_cnpj'])       						: '';
			$cidade			  	= isset($_POST['cidade']) ? Text::clean($_POST['cidade'])       				: '';
			$estado			  	= isset($_POST['estado']) ? Text::clean($_POST['estado'])       				: '';
			$pais			  		= isset($_POST['pais']) ? Text::clean($_POST['pais'])       					: '';
			$receber_boletim  = isset($_POST['receber_boletim'])?(int)$_POST['receber_boletim']				:0;

			$array = array(
			         'status' 			=> $status,
			         'nome_completo' 	=> $nome_completo,
			         'nome_informal' 	=> $nome_informal,
			         'genero' 			=> $genero,
			         'data_nasc' 		=> $data_nasc,
			         'email' 				=> $email,
			         'senha' 				=> $senha,
			         'telefone_resid' 	=> $telefone_resid,
			         'telefone_comer'	=> $telefone_comer,
			         'celular'			=> $celular,
			         'endereco' 			=> $endereco,
			         'numero' 			=> $numero,
			         'complemento' 		=> $complemento,
			         'bairro' 			=> $bairro,
			         'cep' 				=> $cep,
			         'cpf_cnpj' 				=> $cpf_cnpj,
			         'cidade' 			=> $cidade,
			         'estado' 			=> $estado,
			         'pais' 				=> $pais,
			         'receber_boletim' => $receber_boletim
			);

			$messageLog = array('modulo_codigo'=>$this->MODULO_CODIGO,'modulo_area'=>$this->MODULO_AREA,'reg_nome'=>$array['nome_completo']);
			$dados = parent::sqlCRUD($array, '', $this->TB_CADASTRO, $messageLog, 'I', 0, 0);

			//Recupera id do último registro cadastrado
			$recuperaId = self::listLastInsert();
			$usuarioidx = $recuperaId[0]['cadastro_idx'];

			if (ob_get_contents()) ob_end_clean();

			if(isset($dados) && $dados !== NULL){
				Sis::setAlert('Dados cadastrados com sucesso!', 3, '?mod=cadastro&pag=cadastro');
			} else {
				Sis::setAlert('Ocorreu um erro ao salvar os dados!', 4);
			}
		}



		public function theUpdate() {

			$id        		  	= isset($_POST['id'])        ? (int)$_POST['id']                 				: 0 ;
			$status    		  	= isset($_POST['status'])    ? (int)$_POST['status']             				: 0 ;
			$nome_completo    = isset($_POST['nome_completo'])   ? Text::clean($_POST['nome_completo']) 	: '';
			$nome_informal    = isset($_POST['nome_informal']) ? Text::clean($_POST['nome_informal'])   	: '';
			$genero			  	= isset($_POST['genero'])    ? (int)$_POST['genero']             				: 0 ;
			$data_nasc		  	= isset($_POST['data_nasc']) ? Text::clean($_POST['data_nasc'])       		: '';
			$email			  	= isset($_POST['email']) ? Text::clean($_POST['email'])       					: '';
			$senha			  	= isset($_POST['senha']) ? Text::clean($_POST['senha'])       					: '';
			$senha_confirm	  	= isset($_POST['senha_confirm']) ? Text::clean($_POST['senha_confirm'])		: '';
			$telefone_resid	= isset($_POST['telefone_resid']) ? Text::clean($_POST['telefone_resid']) 	: '';
			$telefone_comer   = isset($_POST['telefone_comer']) ? Text::clean($_POST['telefone_comer']) 	: '';
			$celular		  		= isset($_POST['celular']) ? Text::clean($_POST['celular'])       			: '';
			$endereco		  	= isset($_POST['endereco']) ? Text::clean($_POST['endereco'])       			: '';
			$numero			  	= isset($_POST['numero']) ? Text::clean($_POST['numero'])       				: '';
			$complemento	  	= isset($_POST['complemento']) ? Text::clean($_POST['complemento'])       	: '';
			$bairro			  	= isset($_POST['bairro']) ? Text::clean($_POST['bairro'])       				: '';
			$cep			  		= isset($_POST['cep']) ? Text::clean($_POST['cep'])       						: '';
			$cpf_cnpj			  		= isset($_POST['cpf_cnpj']) ? Text::clean($_POST['cpf_cnpj'])       						: '';
			$cidade			  	= isset($_POST['cidade']) ? Text::clean($_POST['cidade'])       				: '';
			$estado			  	= isset($_POST['estado']) ? Text::clean($_POST['estado'])       				: '';
			$pais			  		= isset($_POST['pais']) ? Text::clean($_POST['pais'])       					: '';
			$receber_boletim  = isset($_POST['receber_boletim'])?(int)$_POST['receber_boletim']				: 0;

			$array = array(
	         'cadastro_idx'		=> $id,
	         'status' 			=> $status,
	         'nome_completo' 	=> $nome_completo,
	         'nome_informal' 	=> $nome_informal,
	         'genero' 			=> $genero,
	         'data_nasc' 		=> $data_nasc,
	         'email' 				=> $email,
	         'telefone_resid' 	=> $telefone_resid,
	         'telefone_comer'	=> $telefone_comer,
	         'celular'			=> $celular,
	         'endereco' 			=> $endereco,
	         'numero' 			=> $numero,
	         'complemento' 		=> $complemento,
	         'bairro' 			=> $bairro,
	         'cep' 				=> $cep,
	         'cpf_cnpj' 				=> $cpf_cnpj,
	         'cidade' 			=> $cidade,
	         'estado' 			=> $estado,
	         'pais' 				=> $pais,
	         'receber_boletim' => $receber_boletim
			);

			if($senha != "" && $senha == $senha_confirm){
				$array['senha'] = md5($senha);
			}

			$messageLog = array('modulo_codigo'=>$this->MODULO_CODIGO,'modulo_area'=>$this->MODULO_AREA,'reg_nome'=>$array['nome_completo']);
			$dados = parent::sqlCRUD($array, '', $this->TB_CADASTRO, $messageLog, 'U', 0, 0);

			
			if (ob_get_contents()) ob_end_clean();

			if(isset($dados) && $dados !== NULL){
				Sis::setAlert('Dados cadastrados com sucesso!', 3, '?mod='.$_GET["mod"].'&pag=' . $_GET["pag"]);
			} else {
				Sis::setAlert('Ocorreu um erro ao cadastrar dados!', 4);
			}
		}


		/**
	    * Retorna uma confirmação se o registro não está relacionado a algum registro de outros módulos.
	    * @return array, se a consulta for realizada com sucesso, caso contrário false
	    */
		public function hasDependecies($cadastro){
			//validação de consistencia para a relação com o módulo de ecommercex.
			//Verificação se há pedidos relacionados.
			
			// $retorno2 = parent::select("SELECT cadastro_idx FROM ".self::getPrefix()."_ecommerce_pedido WHERE cadastro_idx=".$cadastro." LIMIT 0,1 ");
			// if (is_array($retorno2)&&count($retorno2)>0) {
			// 	return true; //existem pedidos relacionados
			// }
			
			return false;
		}

		public function theDelete() {
			
			$id = (isset($_GET['id']) ? (int)$_GET['id'] : 0);
			if(self::hasDependecies($id)) {
				if (ob_get_contents()) ob_end_clean();
				Sis::setAlert('Não é possível remover os dados, existem registros de outros módulos de sistema relacionados!', 4, '?mod='.$_GET["mod"].'&pag=' . $_GET["pag"]);
				exit();
			}

			$array = array('cadastro_idx' => $id);

			if (ob_get_contents()) ob_end_clean();
			$nomeCadastro = self::listSelected($id, 'nome_completo');
			if(is_array($nomeCadastro) && count($nomeCadastro) > 0){
				$nomeCadastro = $nomeCadastro[0]['nome_completo'];
			}

			$messageLog = array('modulo_codigo'=>$this->MODULO_CODIGO,'modulo_area'=>$this->MODULO_AREA,'reg_nome'=>$nomeCadastro);
			$dados = parent::sqlCRUD($array, '', $this->TB_CADASTRO, $messageLog, 'D', 0, 0);

			if (ob_get_contents()) ob_end_clean();
			if(isset($dados) && $dados !== NULL){
				Sis::setAlert('Dados removidos com sucesso!', 3, '?mod='.$_GET["mod"].'&pag=' . $_GET["pag"]);
			} else {
				Sis::setAlert('Ocorreu um erro ao remover dados!', 4);
			}

		}


		

	   /**
		 * Retorna as informações para exibir na dashboard do sistema, até 2 linhas
		 */
		public function dashInfo()
		{
			$num_total=0;
			$num_online=0;

			$array = array('orderby' => 'Order By cadastro_idx');
			$totalRegs = parent::select('SELECT count(cadastro_idx) as numReg FROM '.$this->TB_CADASTRO);
			$num_total = (is_array($totalRegs)&&count($totalRegs)>0)?$totalRegs[0]['numReg']:0;
			$array = array('status' => 1);
			$totalRegsActive = parent::select('SELECT count(cadastro_idx) as numReg FROM '.$this->TB_CADASTRO." WHERE status=1 ");
			$num_online = (is_array($totalRegsActive)&&count($totalRegsActive)>0)?$totalRegsActive[0]['numReg']:0;
			$retorno = ($num_total>0)?" ".$num_online." ususário(s) ativos(s) de<br> ".$num_total." ususário(s) cadastrado(s).":"Nenhuma ususário cadastrado!";
			return $retorno;
		}

	}
?>