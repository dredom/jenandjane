<?php
 require '../init.php';
 require DOCPATH.'jewel/return_from_paypal.tran.php';

 $site = 'shop';
 $function = 'thankYou';
 
 execTransaction($site, $function);

?>