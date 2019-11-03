<?php

include 'db.php';

// put full path to Smarty.class.php
require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';
$smarty->cache_dir = 'cache';
$smarty->config_dir = 'configs';

 /*if(isset($_REQUEST['ErrorType'])){
     $ErrorMsg=errorMsg($_REQUEST['ErrorType']);
     $Username=$_REQUEST['Username'];
     $Email=$_REQUEST['Email'];
  }*/
  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
    if($db && !empty($_REQUEST)){
      $Email = $_REQUEST['Email'];
      if(existingEmail($db,$Email)){
        $ErrorType=1;
        returnRegister("",$_REQUEST['Username'],$ErrorType);
      }
      elseif(!samePwd()){
        $ErrorType=4;
        returnRegister($Email,$_REQUEST['Username'],$ErrorType);
      }
      else
        submit($db);
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
      return 0;
  }
  mysql_close($db);
  function errorMsg(){
    $ErrorMsg="Wrong email or password";
    return $ErrorMsg;
  }


     

  // faz a atribuição das variáveis do template smarty
  //$smarty->assign('posts',$tuple);
  $smarty->assign('FORUMName',"DAW Lab");
  $smarty->assign('MENU1',"SubForum1");
  $smarty->assign('MENU2',"SubForum2");
  $smarty->assign('MENU3',"SubForum3");
  $smarty->assign('href',"index.php");
  
  // Mostra a tabela
  $smarty->display('login_template.tpl');
?>