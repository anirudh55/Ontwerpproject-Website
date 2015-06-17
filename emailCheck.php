	<?php 
	session_start();
if(!isset($_SESSION["email"])){
	header("location: login.php");
	exit();
}
		include_once('includeUser.php');
		$e = $_POST['e'];
	
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
	echo false;
} else{
	echo true;
}
		?>
	</body>
</html>