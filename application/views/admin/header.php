<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
	<title><?php echo $title?></title>
	
	<meta name="author" content="Flecha Web Desenvolvimento" />
	<meta http-equiv="Content-Language" content="pt-br"/>
	<meta name="description" content="<?php echo $description ?>" />
	
	<link rel="shortcut icon" type="image/x-icon" href="/lib/favicon.ico" />

    <!-- css files -->
    <link rel="stylesheet" type="text/css" href="/lib/css/all.css" />
	<link rel="stylesheet" type="text/css" href="/lib/css/admin.css" />
    <link rel="stylesheet" type="text/css" href="/lib/css/icons.css" />
	
	<!-- jquery -->
	<script type="text/javascript" src="/lib/js/jquery/jquery.js"></script>

	<!-- tinymce -->
	<script type="text/javascript" src="/lib/js/tinymce/jquery.tinymce.js"></script>

	<!-- functions -->
	<script type="text/javascript" src="/lib/js/adm/functions.js"></script>

	<?php 
	echo isset($tinymce) ? $tinymce : '';
	?>

</head>

<body class="admin">

<div id="wrapper">
