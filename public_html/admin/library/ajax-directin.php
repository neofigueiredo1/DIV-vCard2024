<?php
	require_once "../config.php";

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	$exe 			= (isset($_GET['exe'])) ? $_GET['exe'] : 0;

	$tbPrefix 	= Connect::DB_PREFIX;
	$TB_MODULO 	= $tbPrefix."_modulo";

	//Salva a ordem dos modulos no sistema
	if($exe==1025)
	{
		$sqlQuery = new HandleSql;
		$ordem = $_GET["ordem"];
		$aOrdem = explode(",",$ordem);
		$rnk = (count($aOrdem)*10)+10;
		for($i=0;$i<count($aOrdem);$i++)
		{
			$res = $sqlQuery->update("UPDATE ".$TB_MODULO." SET ranking=".round($rnk)." WHERE codigo=".round($aOrdem[$i]));
			$rnk -= 10;
		}
		ob_clean();
		echo "ok";
		exit();
	}

?>
