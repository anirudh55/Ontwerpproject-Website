<?php
	#Start session.
	session_start();

	$match = false;

	#Check if session is valid.
	if(isset($_SESSION["email"]) && isset($_SESSION["pass1"])){
		#Connect to database.
		include_once('includeUser.php');
		#Request email from session.
		$sessionMail = $_SESSION["email"];
		#Request password from session.
		$sessionPass = $_SESSION["pass1"];
		#Create sql query to select password from user.
		$sql = "SELECT pass1 FROM users WHERE email = '" .$sessionMail ."'";
		#Execute sql query.
		$result = $conn->query($sql);
		#Check if user is in database.
		if ($result->num_rows > 0) {
			#Iterate over rows.
   			while($row = $result->fetch_assoc()) {
				#Check whether entered password is equal to stored password after hashing.
				if($row["pass1"] === $sessionPass){
					$match = true;
					break;
				}
  			}
		}
	}

	#If session does not match, redirect to login page.
	if(!$match){
		header("location: login.php");
		exit();
	}
?>