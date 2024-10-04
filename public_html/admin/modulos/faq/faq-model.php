<?php
class faq_model extends HandleSql{
	
	protected $TB_FAQ;
	
	public function __construct(){

		parent::__construct();

		$this->TB_FAQ = self::getPrefix() . "_faq";

	}
}
?>