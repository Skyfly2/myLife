<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	if(isset($username)){
	
		if($_POST['newcolor'] != $_SESSION['color'] || $_POST['newbuttoncolor'] != $_SESSION['buttoncolor'] || $_POST['newtaskcolor'] != $_SESSION['taskcolor']){
			if($_POST['newcolor'] != $_SESSION['color']){
				//Change Color!
				$_SESSION['color'] = $_POST['newcolor'];
				$color = $_POST['newcolor'];
				$query = "UPDATE user_colors SET maincolor = '$color' WHERE user = '$username'";
				$result = mysqli_query($link, $query);
				if(!$result){
					die('error: ' . mysqli_error($link));
				}
				header("location:../pages/settings.php");
			}
			if($_POST['newbuttoncolor'] != $_SESSION['buttoncolor']){
				//Change Button Color
				$_SESSION['buttoncolor'] = $_POST['newbuttoncolor'];
				$buttoncolor = $_POST['newbuttoncolor'];
				$query = "UPDATE user_colors SET buttoncolor = '$buttoncolor' WHERE user = '$username'";
				$result = mysqli_query($link, $query);
				if(!$result){
					die('error: ' . mysqli_error($link));
				}
				header("location:../pages/settings.php");
			}
			if($_POST['newtaskcolor'] != $_SESSION['taskcolor']){
				//Change Task Color
				$_SESSION['taskcolor'] = $_POST['newtaskcolor'];
				$taskcolor = $_POST['newtaskcolor'];
				$query = "UPDATE user_colors SET taskcolor = '$taskcolor' WHERE user = '$username'";
				$result = mysqli_query($link, $query);
				if(!$result){
					die('error: ' . mysqli_error($link));
				}
				header("location:../pages/settings.php");
			}
		}
		else{
			header("location:../pages/settings.php");
		}
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>