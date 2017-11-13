<?php
  /*
    This script is to edit the faculty member's profile page.
  */

  //"facID&firstName&lastName&selectCollege&email&aboutMe"
  $content = file_get_contents('php://input');
  $login = explode("&", $content);
  $user = $login[0];
  $first = $login[1];
  $last = $login[2];
  $college = $login[3];
  $email = $login[4];
  $about = $login[5];
    
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
  
  $upd = "UPDATE Faculty SET LastName='$last',FirstName='$first',College='$college',AboutMe='$about', Email='$email' WHERE FacID = '$user'";
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