<?php 
	if(!isset($_COOKIE['teacherUser']))
	{
		header("Location: http://afsaccess1.njit.edu/~crk23/hack/login/login.php");
	}
?>
<html>
	<head>
		<link rel = "stylesheet" href = "http://afsaccess1.njit.edu/~crk23/hack/faculty/applications.css">
	</head>
	<body>
		<ul id="menu">
			<img src = "logo.png" alt = "logo.png" width = "200px" height = "100px">
		<hr>
		</ul>	
		
		<ul id="options">
			<li><a href = "facultyProfile.php">PROFILE</a></li>
			<li><a href = "create.php">CREATE RESEARCH</a></li>
			<li><a href = "applications.php">APPLICATIONS</a></li>		
		</ul>
		<hr>
		
		<div class="page">
			<div class="opportunitiesClass" style="display:flex;align-items:center;float:left">
				<button type="button" id="oppLeft" onclick="previousOpp()"><span>L</span></button>
				<p>
					<textarea readonly id = "opps" rows="25" cols="100">Press arrows to browse created research opportunities!</textarea>
					<br>
					<img src = "redHeart.png" id="hearted" style="width:30px; height:30px;position:relative; left:46%;margin-top:2%"/>
					<label id="numHearted">-</label>
				</p>
				<button type="button" id = "oppRight" onclick="nextOpp()"><span>R</span></button>
			</div>
		</div>
	</body>
	
	<script>
		var countOfOpps=0;
		var maxOppsInDB = 1;
		
		function previousOpp()
		{
			var name = "teacherUser=";
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
			
			countOfOpps--;
			if(countOfOpps <=1)
			{
				countOfOpps = 1;
			}
			
			var xmlhttp = new XMLHttpRequest();
			var formData = 'user=' + nameOfCookie + '&oppView='+countOfOpps;
			xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/faculty/applications_f.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       		xmlhttp.onreadystatechange = function() 
       		{
       	   		if (this.readyState == 4 && this.status == 200) 
       	   		{
       	   		    var response = this.responseText.trim('\n');
       	   		 	var json = response;
       	   		    var jsonObj = JSON.parse(json);
					var result = jsonObj.opp;
					
					//var numHearted = jsonObj.hearted;
					maxOppsInDB = parseInt(jsonObj.maxOpps);
					
       				document.getElementById("opps").value = result;
       				//document.getElementById("numHearted").innerHTML = numHearted;
       	   		}
			};
 			xmlhttp.send(formData);
		}	
		
		function nextOpp()
		{
			var name = "teacherUser=";
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
			countOfOpps++;
			if(countOfOpps>maxOppsInDB)
			{
				countOfOpps = maxOppsInDB;
			}
			
			var xmlhttp = new XMLHttpRequest();
			var formData = 'user=' + nameOfCookie + '&oppView='+countOfOpps;
			xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/faculty/applications_f.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.onreadystatechange = function() 
       		{
   			   	if (this.readyState == 4 && this.status == 200) 
   			   	{
   	  		  	    var response = this.responseText.trim('\n');
    		   	 	var json = response;
   			   	    var jsonObj = JSON.parse(json);
					var result = jsonObj.opp;
					//var numHearted = jsonObj.hearted;
					maxOppsInDB = parseInt(jsonObj.maxOpps);
					
           			document.getElementById("opps").value = result;
           			//document.getElementById("numHearted").innerHTML = numHearted;
   			   	}
    		};
    		xmlhttp.send(formData);
		}
	</script>
</html>