<?php
	session_start();
	require_once('config.php');
	session_destroy();
	header("location:../index.php?Success= You have successfully logged out");
	
?>