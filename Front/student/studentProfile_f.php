<?php
/* * * * * * * * * * * * * * *
 * 							 *
 * Author:  Chidanand Khode	 *
 * Role:    Front End		 *
 * Hackathon 2018			 *
 *						     *
 * * * * * * * * * * * * * * */

//Get AJAX Request
$formDataString = $_POST['stuID'] . '&' . $_POST['firstName'] . '&' . $_POST['lastName'] . '&' . 
				  $_POST['selectCollege'] . '&' . $_POST['email'] . '&' . $_POST['aboutMe'] . '&' . 
				  $_POST['gpa'] . '&' . $_POST['classStanding'];

//Back End URL
$backEndURL = 'http://afsaccess1.njit.edu/~cww5/hack/student/studentProfile_b.php';

//Send cURL POST Request to Back End URL
$curlBegin = curl_init($backEndURL);
curl_setopt($curlBegin, CURLOPT_POSTFIELDS, $formDataString);
$json = curl_exec($curlBegin);
curl_close($curlBegin);
?>