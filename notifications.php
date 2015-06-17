<?php
include_once('includeNotifcation.php');
if(isset($_POST['comp'])){
	$sql = "DELETE FROM notifications WHERE component = '{$_POST['comp']}' AND attribute = '{$_POST['attr']}' AND message = '{$_POST['msg']}' AND date = '{$_POST['date']}'"; 
	
		if ($conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . $conn->error;
		}

		$conn->close();
} else{
	$sql = "SELECT component, attribute, message, date FROM notifications";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$i = 0;
		// output data of each row
		echo "<ol>";
		while($row = $result->fetch_assoc()) { 
			$i++;
			$comp = $row["component"];
			$attr = $row["attribute"];
			$msg = (string)$row["message"];
			$date = $row['date'];
			
			$epoch = $row['date'];
			$dt = new DateTime("@$epoch");
			echo "<span id=\"noti{$i}\">" . $dt->format('Y-m-d H:i:s');
			
			
			echo "<li><span onclick=\"createGraph('{$comp}' , '{$attr}')\"> <a href = \"#\" id=\"{$i}\" >" . $msg . "</a> </span> <button class=\"btn btn-primary btn-sm pull-right\" onclick=\"removeNoti({$i},'{$comp}','{$attr}', '{$msg}', '{$epoch}' )\">x</button> </li><br>";
			echo "</span>";
		}
		echo "</ol>";
	} else {
		echo "No notifications! :)";
	}
	$conn->close();
}
?>
