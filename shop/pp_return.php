<?php
 require '../init.php';
 $title = 'purchase';
 require DOCPATH.'jewel/return_from_paypal.tran.php';

 $site = 'shop';
 $function = 'thankYou';
 
 execTransaction($site, $function);

?>