<?php

session_start();
session_unset();
session_destroy();

$smarty->display('message_template.tpl');
?>