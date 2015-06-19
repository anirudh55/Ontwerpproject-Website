<html><head><title>General Information</title>
	
	
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="custom.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	</head>
<script>
	
	
		function selectComponentGeneral(){
				var xmlhttp;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					document.getElementById("main").innerHTML=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","generalInfo.php?t=" + Math.random(),true);
				xmlhttp.send();
		}
		
		function generateGeneralInfo(){
				var tname = document.getElementById('generalBox').value;
			
			if(tname != 'null'){
			//	document.getElementById('tmp').innerHTML = tmp;
				var xmlhttp;
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						parseInformation(xmlhttp.responseText);
					}
				  }
				xmlhttp.open("POST","generalInfo.php",true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("tname="+tname);
			} else {document.getElementById('information').innerHTML = "" ;}
				
		}
		
		function parseInformation(information){
				var info = information.toString();
				info = info.replace(/['" /{ /} /[ ]+/g, '');
			info = info.replace("]","");
			info = info.split(',');
			document.getElementById("information").innerHTML= info + "   type of info: "  + typeof(info);
			
			var result = "<table class='table table-hover'> <thead><tr><th>Attribute</th><th>Value</th> </tr></thead><tbody>";
			
			var tmp = info[0].split(':');
			result= result + "<tr><td> Date </td><td>"+ new Date(parseInt(tmp[1])) + "</td></tr>";
			
			for(var i  = 1; i < info.length; i++){
				tmp = info[i].split(':');
				result= result + "<tr><td>"+ tmp[0] +"</td><td>"+ tmp[1] + "</td></tr>";
			}
			
			
			result = result + "</tbody></table>";
			document.getElementById('information').innerHTML = result;
		}
	
	</script>

<body>
	
	
<script src="globalLayout.js"></script>	
	
	<div class="container">
		<div class="jumbotron">
		
		<h1>General Information</h1>
		</div>
	
		<script>selectComponentGeneral();	</script>
		<h3>Please select a component</h3>
		<div id="main">
		
		</div>
		<div id="information">
		
		</div>
		<div id="test">
			</div>
	</div>
	
</body>
</html>