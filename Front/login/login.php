<html>
	<head>
		<link rel = "stylesheet" href = "http://afsaccess1.njit.edu/~crk23/hack/login/login.css">
	</head>

	<body>
		<ul id = "logo">
			<img src = "logo.png" style = "width:200px; height:100px;"></img>
			<hr>		
		</ul>
		<p class = "formData">
			<label id = "formLabels">UCID:</label>			
			<input id = "user" type = "text" placeholder = "Enter UCID here" autocomplete = "off" value = "" />
		</p>
		<p class = "formData">
			<label id = "formLabels">Password:</label>			
			<input id = "pwd" type = "password" placeholder = "Enter password here" autocomplete = "off" value = "" />
		</p>
		<p class = "formData" style = "position:relative; left: -1.0%;">
			<label class = "loginContainer">
				<input id = "facultyRadio" type = "radio" name = "loginType" value = "faculty"/>
				<span class = "check">Faculty</span>
			</label>			
			<label class = "loginContainer">
				<input id = "studentRadio" type = "radio" name = "loginType" value = "student"/>
				<span class = "check">Student</span>
			</label>			
		</p>
		<p class = "formData"> 
			<button id = "loginButton" onclick = "login()" ><span>Log In</span></button>
		</p>
		<p class = "formData" id = "verification">
		</p>
	</body>

	<script>
		function login()
		{
			var userNameString = document.getElementById("user").value;
			var passwordString = document.getElementById("pwd").value;
			if((!document.getElementById("facultyRadio").checked && 
			   !document.getElementById("studentRadio").checked) ||
			   (userNameString.length == 0 || passwordString.length == 0))
			{
				document.getElementById("verification").innerHTML = "PLEASE COMPLETE FORM!";
			}
			else
			{	
				//Check what table to check
				var tableToCheck = "";
				if(document.getElementById("facultyRadio").checked)
				{
					tableToCheck = "Faculty";
				}
				else if(document.getElementById("studentRadio").checked)
				{
					tableToCheck = "Students";
				}
				
				var xmlhttp = new XMLHttpRequest();
				var formData = 'table=' + tableToCheck + '&username='+userNameString+'&password='+passwordString;
				xmlhttp.open("POST", "http://afsaccess1.njit.edu/~crk23/hack/login/login_f.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    	    	xmlhttp.onreadystatechange = function() 
       		 	{
       		 	   	if (this.readyState == 4 && this.status == 200) 
       	 		   	{
        		   	    var resultOfStudentLoginAttempt = this.responseText.trim('\n');
        		   	    document.getElementById("verification").innerHTML = resultOfStudentLoginAttempt;
        		   	    var result = resultOfStudentLoginAttempt;
           		 		if(result == "GOODSTUDENT")
           		 		{
           		 			document.getElementById("verification").style.color = "green";
            				document.getElementById("verification").innerHTML = "WELCOME STUDENT";
            				document.cookie = "studentUser=" + userNameString + ";path=/";
            				window.open("http://afsaccess1.njit.edu/~crk23/hack/student/studentProfile.php", "_self");
            			}
            			else if(result == "GOODTEACHER")
            			{
            				document.getElementById("verification").style.color = "green";
            				document.getElementById("verification").innerHTML = "WELCOME TEACHER";
            				document.cookie = "teacherUser=" + userNameString + ";path=/";
							window.open("http://afsaccess1.njit.edu/~crk23/hack/faculty/facultyProfile.php", "_self");
            			}
            			else
            			{
            				document.getElementById("verification").style.color = "red";
            		    	document.getElementById("verification").innerHTML = "Invalid Credentials! Try Again!";
            		    }
        		   	}
    			};
       			xmlhttp.send(formData);
			}	
		}
	</script>

</html>
