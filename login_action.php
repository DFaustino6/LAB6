<?php

include 'db.php';
session_start();

  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
  if($db && !empty($_SESSION)){
      $Email = $_REQUEST['email'];
      $Pwd = $_REQUEST['pwd'];
      if(!existingEmail($db,$Email) || !rightPwd($db,$Email,$Pwd))
        returnLogin();
      else
        SignIn();
  } 
  
  function existingEmail($db,$Email){
    $query= "SELECT * from users where email = '$Email'";
    if(!($result = @ mysql_query($query,$db)))
        showerror();
      $nrows  = mysql_num_rows($result);
    if($nrows>0){
      return true;
    }
    else
      return false;
  }

  function rightPwd($db,$Email,$Pwd){
    $PwdHash=substr(md5($_REQUEST['Pwd']),0,32);
    $query="SELECT * from users where email = '$Email', passowrd_digest='$PwdHash'";  
    if(!($result = @ mysql_query($query,$db)))
        showerror();
    $nrows  = mysql_num_rows($result);
    if($nrows==1)
      return true;
    else 
      return false;

  }

  function returnLogin(){
    header("Location: login.php?isWrong=1");
  }

  function SignIn(){
    header("Location: index.php?Username=$Username");
  }

  mysql_close($db);
?>