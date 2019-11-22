<?php

    function safe($val){
        str_replace('\'', '', $val);
        return val;
    }
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	if(isset($_POST['sendto'])){
		if(isset($_POST['message'])){
			$sendto = safe($_POST['sendto']);
			$message = safe($_POST['message']);
			$subject = safe($_POST['subject']);
			//Make sure user exists
			$query = "SELECT UName FROM users WHERE UName = '$sendto'";
			$result = mysqli_query($link, $query);

			if(mysqli_num_rows($result) != 1){
				header("location:../pages/compose.php?InvalidMessage= Message was unable to be sent because the user does not exist");
			}

			//Send message
			$query = "INSERT INTO messages (user, fromuser, viewed, message, timesent, subject) VALUES ('$sendto', '$username', 'no', '$message', NOW(), '$subject')";
			$result = mysqli_query($link, $query);
			if(!$result){
				die('error: ' . mysqli_error($link));
			}
			header("location:../pages/messages.php?Success= Message successfully sent to $sendto");
		}
		else{
			header("location:../pages/compose.php?InvalidMessage= Please Enter a Message to Send");
		}

	}
	else{
		header("location:../pages/compose.php?InvalidMessage= Please Enter a User to send the Message to");
	}
?>