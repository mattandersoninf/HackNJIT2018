<?php
  /*
    This script is to load a faculty/student profile page.
  */

  //"facID&tableCheck"
  $content = file_get_contents('php://input');
  $login = explode("&", $content);
  $user = $login[0];
  $tableCheck = $login[1];
    
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
  
  if ($tableCheck == 'Faculty')
  {
    $result = mysqli_query($connect,"SELECT * FROM Faculty WHERE FacID = '$user'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
    if ($result !== false) 
    {  
      //If updated successfully, echo JSON with information
      
      $fn = $row["FirstName"];
      $ln = $row["LastName"];
      $sc = $row["College"];
      $em = $row["Email"];
      $ab = $row["AboutMe"];
      
      $ret->firstName = $fn;
      $ret->lastName = $ln;
      $ret->selectCollege = $sc;
      $ret->email = $em;
      $ret->aboutMe = $ab;

      $data = json_encode($ret);
      echo $data;
    } 
    else 
    {
      //If not updated successfully, echo negative message
      echo "Profile Not Updated";
    }
  }
    //Close Connection
    mysqli_close($connect);
?>