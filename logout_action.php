<?php
require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

session_start();
session_unset();
session_destroy();


   $smarty->assign('MENU4',"Login");
   $smarty->assign('MENU5',"Register");
   $smarty->assign('href4',"login.php");
   $smarty->assign('href5',"register.php");
   $smarty->assign('Msg',"See you back soon!");

   $smarty->display('message_template.tpl');
?>