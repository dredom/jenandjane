<?php
/*
 * update.php
 * Necklaces.
 * Updates item text file - ajax call.
 * Created on Nov 23, 2008
 */
 error_reporting(E_ALL);
 require '../showCommon.php';
 require '../updateCommon.php';

 checkAuthorized();
 
 define('SITE', 'neck');
 define('TEXTPATH', DOCPATH.'img/');
 
 updateText('n');
 
 // Clear cached pics
 clearPicsSession(SITE);
?>
