	<?php
session_start();

if(!isset($_SESSION["email"])){
	header("location: login.php");
	exit();
}

		include_once('includeUser.php');

	$e = mysqli_real_escape_string($conn, $_POST['e']);
	$e2 = mysqli_real_escape_string($conn, $_POST['e2']);
	$p1 = mysqli_real_escape_string($conn, $_POST['p1']);
	$p2 = mysqli_real_escape_string($conn, $_POST['p2']);

if($e != $_POST['e'] || $e2 != $_POST['e2'] || $p1 != $_POST['p1'] ||$p2 != $_POST['p2']){
	echo "Please don't use any quotes: ";
	exit();
}

	$match = false;
	$sql = "SELECT email FROM users";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row["email"]==$e){
			$match = true;
			break;
		}
    }
} else {
    echo "0 results";
}

if($match){	//Email is already in the database.
	echo"Email is already in the database.";
	exit();
} else if($p1 != $p2){
	echo "Password do no match. Also you bypassed the javascript code. Please don't do this anymore. ";
	exit();
} else if($p1 == "" || $p2 == "" || $e == ""){
	echo "There are empty fields. Also you bypassed the javascript code. Please don't do this anymore.";
} else  if (strlen($p1) < 3 || strlen($p2) > 88) {
	echo "The passwords must be at least 3 characters and less than 88 characters.";
	exit();
} else{
	//$cryptpass = crypt($p1);
	$sql = "INSERT INTO users (email, email2, pass1) VALUES('$e', '$e2', '$p1')";
	if ($conn->query($sql) === TRUE) {
    echo "true";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
		?>
	</body>
</html>
