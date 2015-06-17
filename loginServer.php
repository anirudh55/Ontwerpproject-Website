<?php 
session_start(); 

include_once('includeUser.php');
		
		$e = $_POST['e'];
		$p = $_POST['p'];

	$match = false;
	$sql = "SELECT email,pass1 FROM users";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row["email"]==$e && $row["pass1"] == $p){
			$e = $row["email"];
			$p = $row["pass1"];
			$match = true;
			break;
		}
    }
} else {
    echo "0 results";
}

if($match){	//exists
	$_SESSION['email']  = $e;
	//header("location: dbaccess.php");
	echo true;
} else{
	echo "Failed to login";
}
		?>
