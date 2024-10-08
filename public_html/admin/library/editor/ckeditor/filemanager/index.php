﻿<?php require_once "../../../config.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>File Manager</title>
	<link rel="stylesheet" type="text/css" href="styles/reset.css" />
	<link rel="stylesheet" type="text/css" href="scripts/jquery.filetree/jqueryFileTree.css" />
	<link rel="stylesheet" type="text/css" href="scripts/jquery.contextmenu/jquery.contextMenu-1.01.css" />
	<link rel="stylesheet" type="text/css" href="styles/filemanager.css" />
	<!--[if IE]><link rel="stylesheet" type="text/css" href="styles/ie.css" /><![endif]-->

	<script>
		// Set this to the directory you wish to manage.
		var fileRoot = '/<?php echo PASTA_USUARIO; ?>/';
	</script>
</head>
<body>

	<div>

		<form id="uploader" method="post">
			<button id="home" name="home" type="button" value="Home" style="width: 26px;">&nbsp;</button>
			<h1></h1>
			<div id="uploadresponse"></div>
			<input id="mode" name="mode" type="hidden" value="add" />
			<input id="currentpath" name="currentpath" type="hidden" />
			<div class="wrap_fileinput">
				<input	id="newfile" name="newfile" type="file" title='escolher arquivo' />
			</div>
			<button id="upload" name="upload" type="submit" value="Upload"></button>
			<button id="newfolder" name="newfolder" type="button" value="New Folder"></button>
			<button id="grid" class="ON" type="button">&nbsp;</button>
			<button id="list" type="button">&nbsp;</button>
		</form>

		<div id="splitter">
			<div id="filetree"></div>
			<div id="fileinfo">
				<h1></h1>
			</div>
		</div>

		<ul id="itemOptions" class="contextMenu">
			<li class="select"><a href="#select"></a></li>
			<li class="download"><a href="#download"></a></li>
			<li class="rename"><a href="#rename"></a></li>
			<li class="delete separator"><a href="#delete"></a></li>
		</ul>

	</div>

	<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.form-3.24.js"></script>
	<script type="text/javascript" src="scripts/jquery.splitter/jquery.splitter-1.5.1.js"></script>
	<script type="text/javascript" src="scripts/jquery.filetree/jqueryFileTree.js"></script>
	<script type="text/javascript" src="scripts/jquery.contextmenu/jquery.contextMenu-1.01.js"></script>
	<script type="text/javascript" src="scripts/jquery.impromptu-3.2.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.tablesorter-2.7.2.min.js"></script>
	<script type="text/javascript" src="scripts/filemanager.config.js"></script>
	<script type="text/javascript" src="scripts/filemanager.js"></script>
</body>
</html>
