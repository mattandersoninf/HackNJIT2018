<?php
  $content = file_get_contents('php://input');
  $login = explode("&", $content);
  $stuID = $login[0];
  $desc = $login[1];
  
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
  
  //$opIDA = (int)$opID - 1;
  $get = "SELECT StuInterest FROM Opportunities WHERE Description = '$desc'";
  $result = mysqli_query($connect, $get);
  
  $row = mysqli_fetch_row($result);
  $foo = $row[3];
  if (strlen($foo) < 1)
  {
    $foo = $stuID;
  }
  else
  {
    if(strpos($foo, $stuID) !== false)
    {
      $foo = $foo . "&" . $stuID;
    }
    else
    {
      echo "ALREADY HEARTED";
    }
  }
  
  
  $upd = "UPDATE Opportunities SET StuInterest='$result' WHERE Description = '$desc'";
  $result2 = mysqli_query($connect, $upd);
  if ($result2 !== false)
  {
    echo "HEARTED OPP";
  }
  else
  {
    echo "BAD TRY AGAIN";
  }
  
  //Close Connection
  mysqli_close($connect);
?>