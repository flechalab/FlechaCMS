<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
        <title><?php echo SITE_NAME ?> : <?php echo $title ?></title>
        <meta name="author" content="Flecha Web Desenvolvimento" />
        <meta http-equiv="Content-Language" content="pt-br"/>
        <meta name="description" content="<?php echo SITE_NAME ?> : <?php echo $description ?>" />
        <meta name="google-site-verification" content="hE_Q9iBqi33CeZvse-Z-vNBcVLKLic_x7cGKCARDJc8" />
        <link rel="shortcut icon" type="image/x-icon" href="./lib/favicon.ico" />

        <!-- css -->
        <link rel='stylesheet' type='text/css' href='/lib/css/all.css' />
        <link rel='stylesheet' type='text/css' href='/lib/css/style.css' />

        <!-- jquery -->
        <script type='text/javascript' src='/lib/js/jquery/jquery.js'></script>

        <script src="http://www.google.com/jsapi"></script>
        <script>
            // TODO
            // testar se consegue fazer o load do google senao buscar local
            google.load("jquery", "1.8.2");
        </script>

        <!-- jquery tools-tooltip -->
        <script type="text/javascript" src="/lib/js/jquery-tools/tools.tooltip.js"></script>
        <script type="text/javascript" src="/lib/js/jquery-tools/tools.tooltip.slide.js"></script>

        <!-- jquery tools-tabs -->
        <script type="text/javascript" src="/lib/js/jquery-tools/tools.tabs.js"></script>
        <script type="text/javascript" src="/lib/js/jquery-tools/tools.tabs.slideshow.js"></script>
        <link rel="stylesheet" type="text/css" href="/lib/js/jquery-tools/tools.tabs.slideshow.css" />

        <!-- js -->
        <script type='text/javascript' src='/lib/js/functions.js'></script>

        <!-- aditional css -->
        <?php if (isset($css)) echo $css ?>

        <!-- aditional js -->
        <?php if (isset($js)) echo $js ?>

        <!-- aditional scripts -->
        <?php if (isset($scripts)) echo $scripts ?>

    </head>

    <body>
