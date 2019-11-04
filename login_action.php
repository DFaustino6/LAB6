<?php

include 'db.php';
session_start();
// put full path to Smarty.class.php
require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
  if($db && !empty($_SESSION)){
      $Email = $_SESSION['username'];
      $Pwd = $_SESSION['pwd'];
      if(!existingEmail($db,$Email) || !rightPwd($db,$Email,$Pwd))
        returnLogin();
      else
        SignIn();
  } 
   print_r(existingEmail());
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