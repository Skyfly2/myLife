<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	$fromuser = $_POST['fromuser'];
	$subject = $_POST['subject'];
	$timesent = $_POST['timesent'];

	//Delete the message
	$query = "DELETE FROM messages WHERE fromuser = '$fromuser' AND user = '$username' AND subject = '$subject' AND timesent = '$timesent'";
	$result = mysqli_query($link, $query);
	if(!$result){
		die('error: ' . mysqli_error($link));
	}

	header("location:../pages/messages.php?MessageDeleted= Message Deleted");

	

	
?>