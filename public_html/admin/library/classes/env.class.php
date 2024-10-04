<?php

/**
 * Carrega as configurações do site a partir da raiz
 */
global $env; //Variável global

class EnvLoad
{
	private $envFile;
	private $envData;

	function __construct()
	{
		$rootBase = dirname(dirname(dirname(dirname(__FILE__))));
		$this->envFile = (file_exists(dirname($rootBase).'/.env')) ? file_get_contents(dirname($rootBase).'/.env') : '';
		$this->envData = array();
	}

	public function loadVars()
	{
		$fileLines = explode("\n",$this->envFile);
		
		foreach ($fileLines as $key => $line) {
			//Remove comments at line
			$starCommentPos = strpos($line, '#');
			$strReplace = ($starCommentPos!==false) ? substr($line, $starCommentPos, strlen($line)) : '';
			$lineClean = trim($line);
			if (trim($strReplace)!='') {
				$lineClean = str_replace( $strReplace, "", $line);
			}
			$varData = explode("=",$line);
			if (count($varData)==2) {
				$this->envData[trim($varData[0])] = trim($varData[1]);
			}
		}
		
	}

	public function get($string)
	{
		return (isset($this->envData[$string])) ? $this->envData[$string] : null;
	}

}