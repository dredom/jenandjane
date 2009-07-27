<?php /*
Routers:
 jewel/neck/*.php
 jewel/arm/*.php
 jewel/ear/*.php
 jewel/ankle/*.php
 
Routers do basic initialization, set values. They call transaction functions.

Transaction Functions:
 jewel/*.tran.php
 
Multiple routers can call a single transaction function, e.g.
 jewel/neck/index.php -> jewel/show_page.tran.php
 jewel/ear/index.php -> jewel/show_page.tran.php
 
Transaction functions set up the controllers, then run.
  $template = $controller->handle();

The template is used to show some page in the vw/ directory.
  $template->show('jewel/ankle/index')

*/
?>