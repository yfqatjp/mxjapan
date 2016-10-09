<?php
error_reporting(E_ALL);

if(!defined("SYSBASE")) define("SYSBASE", str_replace("\\", "/", realpath(dirname(__FILE__)."/../")."/"));

if(trim(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], "/")), "/") != "setup.php"){
    $base = getenv("BASE");
    if($base === false){
        $request_uri = explode("/", trim($_SERVER['REQUEST_URI'], "/"));
        $pos = strrpos(SYSBASE, "/".$request_uri[0]);
        $base = false;
        if($pos !== false) $base = substr(SYSBASE, $pos);
        if($base === false || $base == "") $base = "/";
    }
    define("DOCBASE", $base);
}

$http = "http";
if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off") || $_SERVER['SERVER_PORT'] == 443) $http .= "s";
define("HTTP", $http);
