<?php
 require '../../../init.php';
 require DOCPATH.'jewel/update_product.tran.php';
 
 $_GET['id'] = "101";
 $_GET['optiontype'] = "length";
 $_GET['value'] = "18in";
 $_GET['price'] = "12.34";
 $_GET['seq'] = "1";
 $_GET['code'] = "a302-gar-ss";
 $_GET['ix'] = "1_0";
 
 $_SERVER['REQUEST_URI'] = "/";
 $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
 $name = 'Jane';
 $rusr = 'test';
 $usr = new User($rusr, $name);
 $md5 = md5($rusr . date('YMD'));
 $usr->md5 = $md5;
 Cacher::set('user', $usr);
 
 $site = 'ankle';
 $function = 'updateOption';
 $successView = 'jewel/ajax/option';
  
 execTransaction($site, $function, $successView);
?>