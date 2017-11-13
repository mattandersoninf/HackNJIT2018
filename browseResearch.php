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
			<li><a href = "browseResearch.php">BROWSE RESEARCH</a></li>
			<li><a href = "appications.php">APPLICATIONS</a></li>		
		</ul>
		
		
	</body>
</html>
