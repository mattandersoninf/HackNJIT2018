<?php 
	if(!isset($_COOKIE['studentUser']))
	{
		header("Location: http://afsaccess1.njit.edu/~crk23/hack/login/login.php");
	}
?>
<html>
	<head>
		<link rel = "stylesheet" href = "http://afsaccess1.njit.edu/~crk23/hack/student/studentProfile.css">
	</head>
	<body>
		<ul id="menu">
			<img src = "logo.png" alt = "logo.png" width = "200px" height = "100px">
		<hr>
		</ul>	
		
		<ul id="options">
			<li><a href = "studentProfile.php">PROFILE</a></li>
			<li><a href = "browseOpps.php">BROWSE RESEARCH</a></li>
			<li><a href = "">APPLICATIONS</a></li>		
		</ul>
		<hr>
		<p class="profile" style="position:relative;left:300px;">
			<label class="formLabels" id="editMode" style="color:CC2127";>EDIT MODE: OFF</label>
			<button id="editProfile" onclick = "edit()" type="button" style="width:70px;"><span>Edit</span></button>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:CC2127;">First Name: </label>&nbsp
			<input class="formFields" id="firstName" placeholder="Enter first name here" disabled style="opacity:0.7;height:50px;"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:CC2127;">Last Name: </label>&nbsp
			<input class="formFields" id="lastName" placeholder="Enter last name here" disabled style="opacity:0.7;height:50px;"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="left:60px;width:300px;color:CC2127">Select College Name: </label>
				<div class="listColleges">
					<button id = "selectCollege" disabled style="width:400px;position:relative;left:-200px;opacity:0.7;"><span id="selectionOfCollege">Select...</span></button>
  					<div class="colleges">
    					<a id = "cadCollege" onclick="selectCollege('College of Architecture and Design')">College of Architecture and Design</a>
    					<a id = "cslaCollege" onclick="selectCollege('College of Science and Liberal Arts')">College of Science and Liberal Arts</a>
    					<a id = "mtsmCollege" onclick="selectCollege('Martin Tuchman School of Management')">Martin Tuchman School of Management</a>
    					<a id = "nceCollege" onclick="selectCollege('Newark College of Engineering')">Newark College of Engineering</a>
    					<a id = "ywccCollege" onclick="selectCollege('Ying Wu College of Computing')">Ying Wu College of Computing</a>
  					</div>
				</div>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:CC2127;">Email Address: </label>&nbsp
			<input class="formFields" id="email" placeholder="Enter email address here" disabled style="opacity:0.7;height:50px;"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:CC2127;">About Me: </label>&nbsp
			<input class="formFields" style="height:50px;opacity:0.7;padding:10px;"id="aboutMe" placeholder="Enter some details about yourself" disabled/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:CC2127;">GPA: </label>&nbsp
			<input class="formFields" style="height:50px;opacity:0.7;padding:10px;"id="gpa" placeholder="Enter your GPA" disabled/>
		</p>
		<p class="profile">
			<label class="formLabels" style="left:80px;width:300px;color:CC2127">Select Class Standing: </label>
				<div class="classType">
					<button id = "selectClassStanding" disabled style="width:400px;position:relative;left:-200px;opacity:0.7;"><span id="selectionOfClass">Select...</span></button>
  					<div class="classes">
    					<a id = "freshman" onclick="selectClass('Freshman (Class of 2021)')">Freshman (Class of 2021)</a>
    					<a id = "sophomore" onclick="selectClass('Sophomore (Class of 2020)')">Sophomore (Class of 2020)</a>
    					<a id = "junior" onclick="selectClass('Junior (Class of 2019)')">Junior (Class of 2019)</a>
    					<a id = "senior" onclick="selectClass('Senior (Class of 2018)')">Senior (Class of 2018)</a>    					
  					</div>
				</div>
		</p>
		<p class="profile">
			<button id="saveButton" onclick="saveProfile()" type="button" style="width:150px;left:5%;"><span>Save Profile</span></button>
		</p>
		<p class="profile">
			<label id="verification" style="position:relative;left:60px;color:green;"></label>
		</p>
	</body>
	<script>
		var editing = false;
		function selectClass(className)
		{
			if(editing==true)
			{
				document.getElementById("selectionOfClass").innerHTML = className;
			}
		}
		
		function selectCollege(college)
		{
			if(editing==true)
			{
				document.getElementById("selectionOfCollege").innerHTML = college;
			}
		}
		
		function edit()
		{
			editing=true;
			document.getElementById("editMode").style.color="green";
			document.getElementById("editMode").innerHTML = "EDIT MODE: ON";
			document.getElementById("firstName").disabled=false;
			document.getElementById("firstName").style.opacity="1.0";
			document.getElementById("lastName").disabled=false;
			document.getElementById("lastName").style.opacity="1.0";
			document.getElementById("selectCollege").disabled=false;
			document.getElementById("selectCollege").style.opacity="1.0";
			document.getElementById("email").disabled=false;
			document.getElementById("email").style.opacity="1.0";
			document.getElementById("aboutMe").disabled=false;
			document.getElementById("aboutMe").style.opacity="1.0";
			document.getElementById("gpa").disabled=false;
			document.getElementById("gpa").style.opacity="1.0";
			document.getElementById("selectClassStanding").disabled=false;
			document.getElementById("selectClassStanding").style.opacity="1.0";
		}
		
		function saveProfile()
		{
			if(editing==true)
			{
				editing=false;
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
				
				document.getElementById("editMode").style.color="red";
				document.getElementById("editMode").innerHTML = "EDIT MODE: OFF";
				document.getElementById("firstName").disabled=true;
				document.getElementById("firstName").style.opacity="0.7";
				document.getElementById("lastName").disabled=true;
				document.getElementById("lastName").style.opacity="0.7";
				document.getElementById("selectCollege").disabled=true;
				document.getElementById("selectCollege").style.opacity="0.7";
				document.getElementById("email").disabled=true;
				document.getElementById("email").style.opacity="0.7";
				document.getElementById("aboutMe").disabled=true;
				document.getElementById("aboutMe").style.opacity="0.7";
				document.getElementById("gpa").disabled=true;
				document.getElementById("gpa").style.opacity="0.7";
				document.getElementById("selectClassStanding").disabled=true;
				document.getElementById("selectClassStanding").style.opacity="0.7";
				
				var firstName = document.getElementById("firstName").value;
				var lastName = document.getElementById("lastName").value;
				var selectCollege = document.getElementById("selectionOfCollege").innerHTML;
				var email = document.getElementById("email").value;
				var aboutMe = document.getElementById("aboutMe").value;
				var gpa = document.getElementById("gpa").value;
				var classStanding = document.getElementById("selectionOfClass").innerHTML;
				var xmlhttp = new XMLHttpRequest();
				var formData = 'stuID=' + nameOfCookie + '&firstName=' + firstName + '&lastName=' + lastName +
								'&selectCollege=' + selectCollege + '&email=' + email + '&aboutMe=' + aboutMe + 
								'&gpa=' + gpa + '&classStanding=' + classStanding;
				xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/student/studentProfile_f.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    	    	xmlhttp.onreadystatechange = function() 
       		 	{
       		 	   	if (this.readyState == 4 && this.status == 200) 
       	 		   	{
        		   	    var resultOfStudentLoginAttempt = this.responseText.trim('\n');
        		   	    var result = resultOfStudentLoginAttempt;
        		   	   	document.getElementById("verification").innerHTML = result;
        		   	}
    			};
       			xmlhttp.send(formData);
			}
		}
	</script>
</html>