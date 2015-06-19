
		<?php 
include_once('session.php');
		require_once('includeGraph.php');

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
		array_push($columns, 		$row[$col]);
		$tmp[$row["date"]] = $row[$col];
      	}
		
	}if($download == 'false'){
		
	echo json_encode($dat),json_encode($columns);
	}else 
		////////////////////GENERATE CONVERT TO JSON FORMAT. SOMEONE ELSE CAN DO THIS /////////////////////////////////
		if($download == 'true'){
		$downloadFile = fopen("results.json","w") or die("Unable to open file");
		fwrite($downloadFile,json_encode($tmp));
		fclose($downloadFile);
	
			}

		?>
