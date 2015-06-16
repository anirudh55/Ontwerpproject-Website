<?php
/*	session_start();
	if(!isset($_SESSION['email'])){
	   header("location: login.php");
		exit();
	}*/
?>

<html>
	<head><title>DNS - Jedi</title> 
			 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
		
		
		
	<script>
		// Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);
		
		function createGraph(component, attribute){
			
						 if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
						var	xmlhttp = new XMLHttpRequest();
						} else {
							// code for IE6, IE5
						var	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
					xmlhttp.onreadystatechange = function() {
            			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							
								var resp = xmlhttp.responseText;
								var index = resp.indexOf("][");

								var str1 = resp.substr(0,index + 1);
								var str2 = resp.substr(index+1);

								str1 = str1.replace("[",",");
								str1 = str1.replace("]",",");
								str1 = str1.replace(/"/g,'');
								str1.trim();
								var arg1 = str1.split(',');

								str2 = str2.replace("[",",");
								str2 = str2.replace("]",",");
								str2 = str2.replace(/"/g,'');
								str2.trim();
								var arg2 = str2.split(',');

								arg1.pop(); arg2.pop(); arg1.shift(); arg2.shift();
								for(var i =0; i < arg1.length; i++){
								//	col[i] = parseInt(col[i]);
								//	dat[i] = parseInt(dat[i]);
									arg1[i] = parseInt(arg1[i]);
									arg2[i] = parseInt(arg2[i]);
								}
								
								drawChart(arg1,arg2, component, attribute);
							
						}
					}
					
					xmlhttp.open("POST","dbColRead.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				//	param.trim();
					
					xmlhttp.send("colName=" + attribute + "&tableName="+component + "&download=false");
		}
		
			function drawChart(arg1, arg2, component, attribute){
			
			var data = new google.visualization.DataTable();
			data.addColumn('datetime', 'Date');
			data.addColumn('number', attribute);
			
			var dateFormatter = new google.visualization.DateFormat({formatType: 'short'});
			
			//	data.addRow([new Date(0),5]);\
			//	document.getElementById('tmp').innerHTML = result;
				for(var i = 0; i < arg2.length; i++){
					//var tmp = new Date(columnDate[i]);
					data.addRow([new Date(arg1[i]) , arg2[i]]);
				}
		
			var options = {'title':component,'width':400,
                       'height':300,
					explorer:{}};
			
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data,options);
			
		/*	tmp  = "table_div";
			var table = new google.visualization.Table(document.getElementById(tmp));
        	table.draw(data, {showRowNumber: true});
		*/

		}
		
		function removeNoti(index, component, attribute, message){
			
			var noti = "#noti" + index;
			$(document).ready(function(){
					$(noti).remove();
			});
				
			var xmlhttp;
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function() {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200){
			//	document.getElementById("test").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("POST","notifications.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("comp=" + component + "&attr=" + attribute + "&msg=" + message);
			
		}
		
		
		function createNoti(){
			var xmlhttp;
			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function() {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("notifications").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("POST","notifications.php",true);
			xmlhttp.send();
		}
	</script>	
		
		
	</head>
	<body>
		<!--Includes the NAV bar -->
		<script src="globalLayout.js">
			
		</script>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div id="notifications">Notifcations</div>
					<script> createNoti()</script>
				</div>
				<div class="col-sm-6" >
					<div id="chart_div"></div>
				</div>
			</div>
			<div id="test"></div>
		</div>
			
		
	</body>
</html>