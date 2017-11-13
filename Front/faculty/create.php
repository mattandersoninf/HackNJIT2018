<?php 
	if(!isset($_COOKIE['teacherUser']))
	{
		header("Location: http://afsaccess1.njit.edu/~crk23/hack/login/login.php");
	}
?>
<html>
	<head>
		<link rel = "stylesheet" href = "http://afsaccess1.njit.edu/~crk23/hack/faculty/create.css">
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
		
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Research Title: </label>&nbsp
			<input class="formFields" id="titleOfResearch" placeholder="Enter title of research"/>
		</p>
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Research Role(s): </label>&nbsp
			<input class="formFields" id="researchRoles" placeholder="Enter research roles"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="position:relative;left:43%;width:300px;color:CC2127">Select College Name:</label>
				<div class="listColleges">
					<button id = "selectCollege" style="width:400px;position:relative;left:-200px;"><span id="college">Select...</span></button>
  					<div class="colleges">
    					<a id = "cadCollege" onclick="selectCollege('College of Architecture and Design')">College of Architecture and Design</a>
    					<a id = "cslaCollege" onclick="selectCollege('College of Science and Liberal Arts')">College of Science and Liberal Arts</a>
    					<a id = "mtsmCollege" onclick="selectCollege('Martin Tuchman School of Management')">Martin Tuchman School of Management</a>
    					<a id = "nceCollege" onclick="selectCollege('Newark College of Engineering')">Newark College of Engineering</a>
    					<a id = "ywccCollege" onclick="selectCollege('Ying Wu College of Computing')">Ying Wu College of Computing</a>
  					</div>
				</div>
		</p>
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Number of Students Needed: </label>&nbsp
			<input class="formFields" id="numStudents" placeholder="Number of students"/>
		</p>
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Hours per Week: </label>&nbsp
			<input class="formFields" id="hoursPerWeek" placeholder="Enter hours per week"/>
		</p>
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Description: </label>&nbsp
			<textarea class="formFields" id="researchDescription" style="resize:none;word-wrap:break-word;height:100px;" placeholder="Enter description"></textarea>
		</p>
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Student Requirements: </label>&nbsp
			<input class="formFields" id="requirements" placeholder="Enter any requirements a student must meet"/>
		</p>
		<p id="formQuestion">
			<label id="formLabels" style="color:CC2127">Daily Responsibilities / Tasks: </label>&nbsp
			<input class="formFields" id="responsibilities" placeholder="Enter research roles"/>
		</p>
		<p id="formQuestion">
			<button id="createButton" onclick="submit()" type="button"><span>Create!</span></button>
		</p>
		<p id="formQuestion">
			<label id="verification" style="color:white"></label>
		</p>
	</body>
	
	<script>
		function submit()
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
			
			var xmlhttp = new XMLHttpRequest();
			var collegeName = document.getElementById("college").innerHTML;
			var opportunity = "Research Title: " + document.getElementById("titleOfResearch").value + 
							  ". The following research roles are needed: " + document.getElementById("researchRoles").value + 
							  ". This opportunity is welcome to students under: " + document.getElementById("college").value + 
							  ". The number of students needed is: " + document.getElementById("numStudents").value + 
							  ". The maximum hours any student can work is: " + document.getElementById("hoursPerWeek").value + 
							  document.getElementById("researchDescription").value + ". The student requirements are: " + 
							  document.getElementById("requirements").value + ". The daily responsibilities would be: " + 
							  document.getElementById("responsibilities").value + ".";
			
			var formData = 'facID=' + nameOfCookie + '&opportunity=' + opportunity + '&college=' + collegeName;
			xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/faculty/create_f.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    		xmlhttp.onreadystatechange = function() 
       	 	{
       	 	   	if (this.readyState == 4 && this.status == 200) 
        		{
    		   	    var resultOfStudentLoginAttempt = this.responseText.trim('\n');
    		   	    var result = resultOfStudentLoginAttempt;
    		   	   	document.getElementById("verification").innerHTML = result;
    		   	   	
    		   	   	document.getElementById("titleOfResearch").value = "";
    		   	   	document.getElementById("researchRoles").value = "";
    		   	   	document.getElementById("college").innerHTML = "Select...";
    		   	   	document.getElementById("numStudents").value = "";
    		   	   	document.getElementById("hoursPerWeek").value = "";
    		   	   	document.getElementById("researchDescription").value = "";
    		   	   	document.getElementById("requirements").value = "";
    		   	   	document.getElementById("responsibilities").value = "";
    		   	}
    		};
       		xmlhttp.send(formData);
		}
		
		function selectCollege(college)
		{
			document.getElementById("college").innerHTML = college;
		}
	</script>
</html>