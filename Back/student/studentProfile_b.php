<?php
  /*
    This script is to edit the student member's profile page.
  */

  //"stuID&firstName&lastName&selectCollege&email&aboutMe&gpa&classStanding"
  
  $content = file_get_contents('php://input');
  $login = explode("&", $content);
  $user = $login[0];
  $first = $login[1];
  $last = $login[2];
  $college = $login[3];
  $email = $login[4];
  $about = $login[5];
  $gpa = $login[6];
  $class = $login[7];
  
  //connect to db
  $dbhost = "sql2.njit.edu";
  $dbuser = "cww5";
  $dbpass = "cww5cww5";
  $db = "cww5";
  
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
  if (!$connect) 
  {
    echo "DB Connection Failed";
    exit();
  }
  
  $upd = "UPDATE Students SET StuGPA='$gpa',LastName='$last',FirstName='$first',Class='$class', AboutMe='$about',College='$college',Email='$email'WHERE StuID = '$user'";
  
  $result = mysqli_query($connect,$upd);
        
  if ($result !== false) 
  {
    //If updated successfully, echo positive message
    echo "Profile Updated";
  } 
  else 
  {
    //If not updated successfully, echo negative message
    echo "Profile Not Updated";
  }
?>