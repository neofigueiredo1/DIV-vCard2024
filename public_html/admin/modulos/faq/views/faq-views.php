<?php


class faq_views extends HandleSql
{
	function __construct(){
		parent::__construct();
	}

	/**
	 * Function que retorna um arquivo da pasta /views do módulo
	 * @param string $nome -> Nome da view a ser exibida
	 * @return void
	 */
	public function getView($nome="")
	{
		if(file_exists('admin/modulos/faq/views/' . $nome . '.php')){
			require($nome.'.php');
		}else{
			echo 'View não encontrada';
		}
	}

	public function getFaqGrupos(){
		$array = array('status'=>1,'orderby' => 'ORDER BY ranking DESC');
		return $this->sqlCRUD($array, '', $this->getPrefix()."_faq" , '', 'S', 0, 0);
	}
	public function getFaqItens($fid=0){
		$array = array('faq_idx'=>(int)$fid,'status'=>1,'orderby' => 'ORDER BY ranking DESC');
		return $this->sqlCRUD($array, '',$this->getPrefix()."_faq_item", '', 'S', 0, 0);
	}

} // End class
?>