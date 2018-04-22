<?php
define("FILE", dirname(dirname(__FILE__)));  //D:\phpStudy\WWW\mxs
define("WWW",basename(dirname(__DIR__))); //mxs     站点文件夹名字
define("URL", "//".$_SERVER['HTTP_HOST'].'/'.WWW.'/'); //http://localhost:8080/mxs/
/*
define("URL", "//".$_SERVER['HTTP_HOST'].'/'); //http://localhost:8080/
*/
