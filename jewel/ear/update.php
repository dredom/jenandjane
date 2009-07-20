<?php
/*
 * update.php
 * Earrings.
 * Updates item text file - ajax call.
 * Created on Nov 23, 2008
 */
 require '../../init.php';
 require '../showCommon.php';
 require '../updateCommon.php';

 checkAuthorized();
 
 define('SITE', 'ear');
 define('TEXTPATH', DOCPATH.'img/');
 
 updateText('e');
 
 // Clear cached pics
 clearPicsSession(SITE);
?>
