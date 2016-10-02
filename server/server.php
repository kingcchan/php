<?php
// server.php
// php -S localhost:8081 server.php

$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'] . "/www";
$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER["REQUEST_URI"];
$ext = pathinfo($path);
$uri = $_SERVER["REQUEST_URI"];
$file = "www/index.html";

// let server handle files or 404s
if (!file_exists($path)) {
	if (file_exists($file)) {
		return require($file);
	} else {
		return false;
	}
}

if (is_file($path))  {
	if ($ext['extension'] == "js") {
    	header("Content-Type: application/x-javascript");
	} else if ($ext['extension'] == "css") {
		header("Content-Type: text/css");
	}

    return require($path);
}

// append / to directories
if (is_dir($path) && $uri[strlen($uri) -1] != '/') {
    header('Location: ' . $uri . '/');
}

// send index.html and index.php
$indexes = ['index.html'];
foreach($indexes as $index) {
    $file = $path . '/' . $index;
    if (is_file($file)) {
        return require($file);
    }
}
?>
