<?php

//$path = $_SERVER['REQUEST_URI'];

$path = '';

$uri  = explode('/', $_SERVER['REQUEST_URI']);

for($i=0; $i<count($uri)-2; $i++) {
	$path .= $uri[$i] . '/';
}

echo "http://" . $_SERVER['HTTP_HOST']  . $path;