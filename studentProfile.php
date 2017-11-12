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
			<li><a href = "">BROWSE RESEARCH</a></li>
			<li><a href = "">APPLICATIONS</a></li>		
		</ul>
		<hr>
		<p class="profile" style="position:relative;left:300px;">
			<label class="formLabels" id="editMode" style="color:red";>EDIT MODE: OFF</label>
			<button id="editProfile" onclick = "edit()" type="button" style="width:70px;"><span>Edit</span></button>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:FF0000;">First Name: </label>&nbsp
			<input class="formFields" id="firstName" placeholder="Enter first name here" disabled style="opacity:0.7;"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:white;">Last Name: </label>&nbsp
			<input class="formFields" id="lastName" placeholder="Enter last name here" disabled style="opacity:0.7;"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="left:60px;width:300px;color:07A9FF">Select College Name:</label>
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
			<label class="formLabels" style="color:FF0000;">Email Address: </label>&nbsp
			<input class="formFields" id="email" placeholder="Enter email address here" disabled style="opacity:0.7;"/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:white;">About Me: </label>&nbsp
			<input class="formFields" style="height:50px;opacity:0.7;padding:10px;"id="aboutMe" placeholder="Enter some details about yourself" disabled/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:white;">GPA: </label>&nbsp
			<input class="formFields" style="height:50px;opacity:0.7;padding:10px;"id="gpa" placeholder="Enter your GPA" disabled/>
		</p>
		<p class="profile">
			<label class="formLabels" style="color:white;">Class Standing: </label>&nbsp
			<input class="formFields" style="height:50px;opacity:0.7;padding:10px;"id="aboutMe" placeholder="Freshman, Sophomore, Junior, Senior" disabled/>
		</p>
		<p class="profile">
			<button id="saveButton" onclick="saveProfile()" type="button" style="width:150px;left:5%;"><span>Save Profile</span></button>
		</p>
		<p class="profile">
			<label id="verification" style="position:relative;left:60px;color:green;"></label>
		</p>
	</body>
</html>