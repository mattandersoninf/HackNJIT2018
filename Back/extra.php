<?php 
     /*
     _______________________________________
     Connor Watson
     9/26/2017
     CS 490 - Design in Software Engineering
     Theodore Nicholson
     _______________________________________
     ============ALPHA RELEASE==============
     Front end - Chidanand Khode
     Middle end - Connor Watson
     Back end - Cole Degeorges

     Below is the middle-end PHP script for
     a login system using a local database
     and the NJIT login system.
     _______________________________________
     */

     //Front end url
     $urlF = 'https://web.njit.edu/~crk23/cs490/alpha/cs490_f.php';
     //Back end url
     $urlB = 'https://web.njit.edu/~ccd5/cs490/alpha/cs490_b.php';
     //NJIT login URL
     $urlNJIT = "https://cp4.njit.edu/cp/home/login";
     
     //Store front end contents as string
     //String: username/password
     $req1 = file_get_contents('php://input');
     $reqarray = explode("/", $req1);
     $username = $reqarray[0];
     $password = $reqarray[1];
     $post_njit = "user=".$username."&pass=".$password."&uuid=".'0xACA021';
     
     //Spoofing the NJIT login
     $login2 = curl_init();
     curl_setopt($login2, CURLOPT_URL, $urlNJIT);
     curl_setopt($login2, CURLOPT_POSTFIELDS, $post_njit);
     curl_setopt($login2, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($login2, CURLOPT_FOLLOWLOCATION, true);
     $outLogin2 = curl_exec($login2);
     curl_close($login2);  

     //We tried creating JSON objects to send to front end
     //Instead we are using plain text for now
     if(strpos($outLogin2, "Failed")!==false){
     echo nl2br("NJIT Login Failed\n");
     }
     if(strpos($outLogin2, "Successful")!==false){
     echo nl2br("NJIT Login Successful\n");
     }

     //Local database login
     $login1 = curl_init($urlB);
     curl_setopt($login1, CURLOPT_POSTFIELDS, $req1);
     $outLogin1 = curl_exec($login1);
     curl_close($login1);
     $varr = file_get_contents($urlB);
?>
