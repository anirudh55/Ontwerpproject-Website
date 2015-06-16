<!DOCTYPE html>
<html><head><title></title></head>
	
	<body>
		<?php 
		
		require_once('includeGraph.php');

	//	$wname = strval($_POST['wname']);
	//	$wwname = $_POST['wname'];
	
	$tableName = $_POST['tableName'];
	$colName = $_POST['colName'];
	$download = $_POST['download'];

	$colName = preg_replace('/\s+/', '', $colName);

	$sql = "SELECT date, " .$colName . " FROM " .$tableName;

	$result = $conn->query($sql);
	$columns = array();
	$dat = array(); 
	$tmp = array();

	$col = strval($colName);
	
	while ($row = $result->fetch_assoc()) {
    if ($result->num_rows > 0) {
        	array_push($dat, 		$row["date"]);
			array_push($columns, 	$row[$col]);
		array_push($tmp, 		$row["date"]);
		array_push($tmp, 		$row[$col]);
      	}
		
	}if($download == 'false'){
		
	echo json_encode($dat),json_encode($columns);
	}else 
		////////////////////GENERATE CONVERT TO JSON FORMAT. SOMEONE ELSE CAN DO THIS /////////////////////////////////
		if($download == 'true'){
	//TODO : create JSON FILE for DOWNLOAD!!
		$downloadFile = fopen("results.json","w") or die("Unable to open file");
	//	$txt = json_encode($dat) + json_encode($columns);
	
	//	fwrite($downloadFile,json_encode($dat));
	//	fwrite($downloadFile,json_encode($columns));
		fwrite($downloadFile,json_encode($tmp));
		fclose($downloadFile);
	
			}

		?>
	</body>
</html>
