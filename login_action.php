<?php

include 'db.php';
session_start();

  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
  if($db && isset($_REQUEST['email'])){
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
    $PwdHash=substr(md5($Pwd),0,32);
    $query="SELECT * from users where email = '$Email'AND password_digest='$PwdHash'"; 
    if(!($result = @ mysql_query($query,$db)))
        showerror();
    $nrows  = mysql_num_rows($result);
    $tuple[0] = mysql_fetch_array($result,MYSQL_ASSOC);

    if($nrows==1){
      $_SESSION['username']=$tuple[0]['name'];
      $_SESSION['id']=$tuple[0]['id'];
      return true;
    }
    else 
      return false;

  }

  function returnLogin(){
    header("Location: login.php?isWrong=1");
  }

  function SignIn(){

    header("Location: index.php");
  }

  mysql_close($db);
?>