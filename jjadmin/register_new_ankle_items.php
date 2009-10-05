<?php
/*
 * Convert show.config to db product rows as needed.
 */
require '../init.php';
require DOCPATH.'jjadmin/ConfigToProduct.class.php';
$filename = 'jewel/ankle/show.config';
echo "Start for $filename...<br>\n";
$configToProduct = new ConfigToProduct;
$count = $configToProduct->load($filename);
Logger::info("Registering items for $filename, $count inserts");
echo "\n Done ~ $count inserts \n";
?>