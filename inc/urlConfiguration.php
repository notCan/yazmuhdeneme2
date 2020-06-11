<?php
if (!defined("izin")) {
    header("HTTP/1.0 403 Forbidden");
    echo "403 Forbidden.";
    header("refresh:5;url=/");
    exit();
}
$req_uri = $_SERVER['REQUEST_URI'];
define('_param', $req_uri);
$req_uri = explode("?", $req_uri);
$parametreler = explode("/", ltrim($req_uri[0], "/"));
define('__param', $parametreler);
