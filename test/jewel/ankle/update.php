<?php
 require '../../../init.php';
 require DOCPATH.'jewel/update_product.tran.php';
 
 $_GET['id'] = "102";
 $_GET['text'] = "mother of pearl anklet pi.";
 
 session_start();
 $name = 'Jane';
 $rusr = 'test';
 $usr = new User($rusr, $name);
 $md5 = md5($rusr . date('YMD'));
 $usr->md5 = $md5;
 $_SESSION['user'] = $usr;
 
 $site = 'ankle';
 $function = 'description';
 $successView = 'ok';
 
 execTransaction($site, $function, $successView);
?>