<?php
	session_start();
	require('config.php');
	$username = $_SESSION['username'];
	
	//Handle Schedule Requesting
	if(isset($_POST['requesteduser'])){
		$requesteduser = $_POST['requesteduser'];
		$query = "SELECT user FROM shared_tasks WHERE user = '$requesteduser'";
		$result = mysqli_query($link, $query);
		if(!$result){
			die('error: ' . mysqli_error($link));
		}
		$hasrequested = false;

		//Make sure the request has not already been processed
		while(list($checkuser) = mysqli_fetch_array($result)){
			if($checkuser == $requesteduser){
				$hasrequested = true;
			}
		}

		//Make sure other user has not already processed the request
		$query2 = "SELECT holduser FROM shared_task_hold WHERE mainuser = '$username'";
		$result2 = mysqli_query($link, $query2);
		if(!$result){
			die('error: ' . mysqli_error());
		}

		while(list($checkuser) = mysqli_fetch_array($result2)){
			if($checkuser == $requesteduser){
				$hasrequested = true;
			}
		}

		//Process request
		if(!$hasrequested){
			$query3 = "INSERT INTO shared_task_hold (mainuser, holduser, requestuser) VALUES ('$username', '$requesteduser', '$username') ";
			$result3 = mysqli_query($link, $query3);
			if(!$result3){
				die('error: ' . mysqli_error($link));
			}
			header("location:../pages/agenda.php?SuccessTask= You have successfully requested a schedule");
		}
		else{
			header("location:../pages/agenda.php?InvalidTask= Schedule Request Invalid");
		}
	}

	//Handle schedule sharing
	if(isset($_POST['shareduser'])){
		if(empty($_POST['shareduser'])){
			header("location:../pages/agenda.php?InvalidTask= Your must enter a user");
		}
		else{
			$exists = false;
			$shareduser = $_POST['shareduser'];

			$query1 = "SELECT UName FROM users WHERE UName = '$shareduser'";
			$result1 = mysqli_query($link, $query1);
			if(!$result1){
				die('error: ' . mysqli_error($link));
			}

			//Make sure user requested exists
			if(mysqli_num_rows($result1) > 0){
				$query2 = "SELECT shareduser FROM shared_tasks WHERE user = '$username'";
				$result2 = mysqli_query($link, $query2);
				if(!$result2){
					die('error: ' . mysqli_error($link));
				}
				//Make sure request doesn't already exist
				while(list($otheruser) = mysqli_fetch_array($result2)){
					if($otheruser == $shareduser){
						$exists = true;
						break;
					}
				}
				//Process request
				if(!$exists){
					$query3 = "SELECT holduser FROM shared_task_hold WHERE mainuser = '$username'";
					$result3 = mysqli_query($link, $query3);
					if(!$result3){
						die('error: ' . mysqli_error($link));
					}
					while(list($otheruser) = mysqli_fetch_array($result3)){
						if($otheruser == $shareduser){
							$exists = true;
							break;
						}
					}
				}

				if(!$exists){
					$query = "INSERT INTO shared_task_hold (mainuser, holduser, requestuser) VALUES ('$username', '$shareduser', '$shareduser')";
					$result = mysqli_query($link, $query);
					if(!$result){
						die('error:'  .mysqli_error($link));
					}
					header("location:../pages/agenda.php?SuccessTask= Your share request has been sent!");
				}
				else{
					header("location:../pages/agenda.php?InvalidTask= You have already shared your schedule with this user");
				}
			}
			else{
				header("location:../pages/agenda.php?InvalidTask= That user does not exist.");
			}

		}
	}
	else{
		echo 'There is currently an issue connecting to the myLife servers. Please try again later.';
	}

	
?>