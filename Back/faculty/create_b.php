<?php
  /* This script is for creating the research opportunities.*/
  //facID & whole description
  $content = file_get_contents('php://input');

  $login = explode("&", $content);
  $facID = $login[0];
  $desc = $login[1];
  $college = $login[2];
  
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
  
  $ins = "INSERT INTO Opportunities(FacID, Description, College) VALUES ('$facID', '$desc', '$college')";
  
  $resultI = mysqli_query($connect, $ins);
  
  if ($resultI !== false) 
  {
    //If added successfully, echo positive message
    echo "Insert Successful";
  } 
  else 
  {
    //If not added successfully, echo negative message
    echo "Insert Unsuccessful";
  }
  //Close Connection
  mysqli_close($connect);
?>