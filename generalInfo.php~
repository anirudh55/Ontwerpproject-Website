<?php
session_start();
require_once('includeGraph.php');
					if(!isset($_POST['tname'])){
								mysql_connect($servername, $username, $password);
								$res = mysql_query("SHOW TABLES FROM $dbname");
								$tables = array();

								while($row = mysql_fetch_array($res, MYSQL_NUM)) {
									array_push($tables,"$row[0]");
								}
							$conn->close();

							echo "<select id= \"generalBox\" onchange=\"generateGeneralInfo();\">" ;
							echo "<option value='null'></option>";
								for($i = 0; $i < count($tables); $i++){
										echo "<option value=\"$tables[$i]\">Component $i - $tables[$i] </option>";
								}
							echo "</select>";
					} elseif(isset($_POST['tname'])){
						$sql = "SELECT * FROM " . $_POST['tname'] . " ORDER BY id LIMIT 1";
						$result = $conn->query($sql);
						/*
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
							}
						} else {
							echo "0 results";
						}*/
						
						$sql = "SHOW COLUMNS FROM your-table";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							echo $row['Field']."<br>";
						}
					}

?>
