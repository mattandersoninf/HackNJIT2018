<?php 
	if(!isset($_COOKIE['studentUser']))
	{
		header("Location: http://afsaccess1.njit.edu/~crk23/hack/login/login.php");
	}
?>
<html>
	<head>
		<link rel = "stylesheet" href = "http://afsaccess1.njit.edu/~crk23/hack/student/browseOpps.css">
	</head>
	<body>
		<ul id="menu">
			<img src = "logo.png" alt = "logo.png" width = "200px" height = "100px">
		<hr>
		</ul>	
		
		<ul id="options">
			<li><a href = "studentProfile.php">PROFILE</a></li>
			<li><a href = "browseOpps.php">BROWSE RESEARCH</a></li>
			<li><a href = "applications.php">APPLICATIONS</a></li>		
		</ul>
		<hr>
		<div class="page">
			<label class = "deployedFilter" style = "cursor:pointer; font-size:15px;color:green;">
				<input class = "deployedFilter" id="none" name="deployed" value="none" checked type="radio" style="margin-right:5px;">None</input></label>
				
			<label class = "deployedFilter" style = "cursor:pointer; font-size:15px;color:purple;">
				<input class = "deployedFilter" id="architecture" name="deployed" value="coad" type="radio" style="margin-right:5px;">COAD</input></label>
			
			<label class = "deployedFilter" style = "cursor:pointer; font-size:15px;color:yellow;">
				<input class = "deployedFilter" id="language" name="deployed" value="csla" type="radio" style="margin-right:5px;">CSLA</input></label>
			
			<label class = "deployedFilter" style = "cursor:pointer; font-size:15px;color:brown;">
				<input class = "deployedFilter" id="management" name="deployed" value="mtsm" type="radio" style="margin-right:5px;">MTSM</input></label>
			
			<label class = "deployedFilter" style = "cursor:pointer; font-size:15px;color:orange;">
				<input class = "deployedFilter" id="engineering" name="deployed" value="nce" type="radio" style="margin-right:5px;">NCE</input></label>
			
			<label class = "deployedFilter" style = "cursor:pointer; font-size:15px;color:cyan;">
				<input class = "deployedFilter" id="computing" name="deployed" value="ywcc" type="radio" style="margin-right:5px;">YWCC</input></label>
			<button id="oppRight" onclick="setFilter()" style="width:120px" type="button"><span>Set Filter</span></button>
		</div>
		<div class="page">
			<div class="opportunitiesClass" style="display:flex;align-items:center;float:left">
				<button type="button" id="oppLeft" onclick="previousOpp()"><span>L</span></button>
				<p>
					<textarea readonly id = "opps" rows="25" cols="100">Press arrows to browse created research opportunities!</textarea>
					<br>
					<img src = "redHeart.png" onclick="heart()" id="hearted" style="width:30px; height:30px;position:relative;left:46%;margin-top:2%;cursor:pointer;"/>
				</p>
				<button type="button" id = "oppRight" onclick="nextOpp()"><span>R</span></button>
			</div>
		</div>
	</body>
	
	<script>
		var countOfOpps=0;
		var maxOppsInDB = 1;
		var filter = "none";
		
		function heart()
		{
			if(countOfOpps>0)
			{
				var opp = document.getElementById("opps").value;
				var name = "studentUser=";
				var nameOfCookie = "";
				var cookieDecoded = decodeURIComponent(document.cookie);
				var arrayOfCookieData = cookieDecoded.split(';');
				var lengthOfArray = arrayOfCookieData.length;
				var z=0;
				while(z<lengthOfArray)
				{
					var cookie = arrayOfCookieData[z];
					while (cookie.charAt(0) == " ") 
					{
    	   		 		cookie = cookie.substring(1);
    				}
					if(cookie.indexOf(name) == 0)
						{
						nameOfCookie = cookie.substring(name.length, cookie.length);
						break;
						}
					z++;
				}
				
				var xmlhttp = new XMLHttpRequest();
				var formData = 'stuID=' + nameOfCookie + '&opp=' + opp;
				xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/student/heart_f.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       			xmlhttp.onreadystatechange = function() 
       			{
       	   			if (this.readyState == 4 && this.status == 200) 
       	   			{
       	   			    var response = this.responseText.trim('\n');
       	   			    document.getElementById("opps").value = response;
       	   			}
				};
 				xmlhttp.send(formData);
 			}
		}
		
		function setFilter()
		{
			countOfOpps=0;
			if(document.getElementById("architecture").checked == true)
			{
				filter="College of Architecture and Design";
				document.getElementById("opps").value="COAD Filter Set!";
			}
			else if(document.getElementById("language").checked == true)
			{
				filter="College of Science and Liberal Arts";
				document.getElementById("opps").value="CSLA Filter Set!";
			}
			else if(document.getElementById("management").checked == true)
			{
				filter="Martin Tuchman School of Management";
				document.getElementById("opps").value="SOM Filter Set!";
			}
			else if(document.getElementById("engineering").checked == true)
			{
				filter="Newark College of Engineering";
				document.getElementById("opps").value="NCE Filter Set!";
			}
			else if(document.getElementById("computing").checked == true)
			{
				filter="Ying Wu College of Computing";
				document.getElementById("opps").value="YWCC Filter Set!";
			}
			else if(document.getElementById("none").checked == true)
			{
				filter="none";
				document.getElementById("opps").value="No Filter Set!";
			}
		}
		
		function previousOpp()
		{
			countOfOpps--;
			if(countOfOpps <=1)
			{
				countOfOpps = 1;
			}
			
			var xmlhttp = new XMLHttpRequest();
			var formData = 'filter=' + filter + '&oppView='+countOfOpps;
			xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/student/browseOpps_f.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       		xmlhttp.onreadystatechange = function() 
       		{
       	   		if (this.readyState == 4 && this.status == 200) 
       	   		{
       	   		    var response = this.responseText.trim('\n');
       	   		 	var json = response;
       	   		    var jsonObj = JSON.parse(json);
					var result = jsonObj.opp;					
					maxOppsInDB = parseInt(jsonObj.maxOpps);
       				document.getElementById("opps").value = result;
       	   		}
			};
 			xmlhttp.send(formData);
		}	
		
		function nextOpp()
		{
			countOfOpps++;
			if(countOfOpps>maxOppsInDB)
			{
				countOfOpps = maxOppsInDB;
			}
			
			var xmlhttp = new XMLHttpRequest();
			var formData = 'filter=' + filter + '&oppView='+countOfOpps;
			xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/student/browseOpps_f.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.onreadystatechange = function() 
       		{
   			   	if (this.readyState == 4 && this.status == 200) 
   			   	{
   	  		  	    var response = this.responseText.trim('\n');
    		   	 	var json = response;
   			   	    var jsonObj = JSON.parse(json);
					var result = jsonObj.opp;
					maxOppsInDB = parseInt(jsonObj.maxOpps);
           			document.getElementById("opps").value = result;
   			   	}
    		};
    		xmlhttp.send(formData);
		}
	</script>
</html>