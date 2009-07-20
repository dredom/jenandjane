<?php
/*
 * update.php
 * Bracelets.
 * Updates item text file - ajax call.
 * Created on Nov 23, 2008
 */
 require '../../init.php';
 require '../showCommon.php';
 require '../updateCommon.php';

 checkAuthorized();
 
 define('SITE', 'arm');
 define('TEXTPATH', DOCPATH.'img/');
 
 updateText('b');
 
 // Clear cached pics
 clearPicsSession(SITE);
?>
