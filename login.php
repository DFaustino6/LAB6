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