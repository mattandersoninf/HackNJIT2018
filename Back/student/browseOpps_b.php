<?php
  $content = file_get_contents('php://input');
  $login = explode("&", $content);
  $opID = $login[1];
  $college = $login[0];
  
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
  
  $opIDA = (int)$opID - 1;
  
  if ($college == "none")
  {
    $total = "SELECT Description FROM Opportunities";
    $result = mysqli_query($connect, $total);
    $count = $result->num_rows;
    mysqli_data_seek($result, $opIDA);
    $row = mysqli_fetch_row($result);
  
    $myJSON->opp=$row[0];
    $myJSON->maxOpps=$count;
    $ret = json_encode($myJSON);
    echo $ret;
  }
  else
  {
    $total = "SELECT Description FROM Opportunities WHERE College = '$college'";
    $result = mysqli_query($connect, $total);
    $count = $result->num_rows;
    mysqli_data_seek($result, $opIDA);
    $row = mysqli_fetch_row($result);
  
    $myJSON->opp=$row[0];
    $myJSON->maxOpps=$count;
    $ret = json_encode($myJSON);
    echo $ret;
  }

  //Close Connection
  mysqli_close($connect);
?>