<?php
//Select Database
define('DB_SERVER', 'localhost');
//Login to database as root
define('DB_USERNAME', 'root');
//No password
define('DB_PASSWORD', '');
//Run locally
define('DB_NAME', 'mylife');
//Database character set
define('DB_CHARSET', 'utf8');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($link === false){
	die("Error, could not connect" . mysqli_connect_error());
}
?>