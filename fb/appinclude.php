<?php
/*
 * Created on Nov 29, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 //echo "<br/>Requiring facebook.php... <br/>";
require_once 'facebook.php';
 //echo "<br/>Require facebook.php done! <br/>";

$appapikey = 'e0732c04795de198f534d627376cddfe';
$appsecret = '7720e563fb2e41c9b41adc1e533e7f35';
$facebook = new Facebook($appapikey, $appsecret);
$user = $facebook->require_login();

//[todo: change the following url to your callback url]
$appcallbackurl = 'http://www.jenandjane.com/fb/';
//echo ' going... ';
//catch the exception that gets thrown if the cookie has an invalid session_key in it
//try {
//  if (!$facebook->api_client->users_isAppAdded()) {
//    $facebook->redirect($facebook->get_add_url());
//  }
//} catch (Exception $ex) {
//  //this will clear cookies for your application and redirect them to a login prompt
//  $facebook->set_user(null, null);
//  $facebook->redirect($appcallbackurl);
//}
?>
