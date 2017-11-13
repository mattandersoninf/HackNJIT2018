<?php
  /*
  This script is for checking the login.
  We attempt to hash the passwords for increased security.
  */
  
  //http://afsaccess1.njit.edu/~crk23/hack/login/login.php
  
  /*DELETE FROM Students
WHERE StuID='crk23';*/

  //"tableName&username&password"
  $content = file_get_contents('php://input');
  $urlNJIT = "https://cp4.njit.edu/cp/home/login";

  $login = explode("&", $content);
  $tableName = $login[0];
  $user = $login[1];
  $pass = $login[2];

  //connect to db
  $dbhost = "sql2.njit.edu";
  $dbuser = "cww5";
  $dbpass = "cww5cww5";
  $db = "cww5";
  
  //Set up options for password hashing
  /*$options = [
    'cost' => 12;
    ];*/
    
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
  if (!$connect) 
  {
    echo "DB Connection Failed";
    exit();
  }
  
  //query the database
  if ($tableName == "Faculty")
  {
    $result = mysqli_query($connect, "SELECT * FROM Faculty WHERE FacID = '$user' and Passwords = '$pass'"); 
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); //gets an associative array based on line above
    if($row['FacID'] == $user && $row['Passwords'] == $pass) 
    {
      echo "GOODTEACHER";
    }
    else 
    {
      echo "BADTEACHER";
    }
  }
  else if ($tableName == "Students")
  {
    $post_njit = "user=".$user."&pass=".$pass."&uuid=".'0xACA021';
    
    //Spoofing the NJIT login
    $loginN = curl_init();
    curl_setopt($loginN, CURLOPT_URL, $urlNJIT);
    curl_setopt($loginN, CURLOPT_POSTFIELDS, $post_njit);
    curl_setopt($loginN, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($loginN, CURLOPT_FOLLOWLOCATION, true);
    $outLoginN = curl_exec($loginN);
    curl_close($loginN);  
    
    //If NJIT Login is Successful
    if(strpos($outLoginN, "Successful") !== false)
    {
      //Checks if the student is in the database
      $result = mysqli_query($connect, "SELECT * FROM Students WHERE StuID = '$user'"); 
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if($row['StuID'] == $user && password_verify($pass, $row['Passwords'])) 
      {
        //If so, echo positive message
        $res2 = "GOODSTUDENT";
      }
      else 
      {
        //If not, insert student into database
        $passH = password_hash($pass, PASSWORD_BCRYPT);
        $ins = "INSERT INTO Students(StuID, StuGPA, LastName, FirstName, Class, Passwords)
        VALUES ('$user','empty','empty','empty','empty','$passH')";
        
        $resultI = mysqli_query($connect, $ins);
        
        if ($resultI !== false) 
        {
          //If added successfully, echo positive message
          $res2 = "GOODSTUDENT";
        } 
        else 
        {
          //If not added successfully, echo negative message
          $res2 = "BADSTUDENT";
        }
      }
    }
    //If NJIT Login Failed
    else if(strpos($outLoginN, "Failed") !== false)
    {
      $res2 = "BADSTUDENT";
      //$res1 = nl2br("NJIT Login Failed\n");
      //$res2 = "Local Login Unsuccessful";
    }
    echo $res2;
    /*$res = $res1 . $res2;
    echo $res;*/
  }

  //Close Connection
  mysqli_close($connect);
?>