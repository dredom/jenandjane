<?php
/*
 * Convert new show.config to db product rows.
 */
require '../init.php';
require DOCPATH.'jjadmin/ConfigToProduct.class.php';
$filename = 'jewel/neck/show.config';
echo "Start for $filename...<br>\n";
$configToProduct = new ConfigToProduct;
$count = $configToProduct->load($filename);
Logger::info("Registered product items for $filename, $count inserts");
echo "\n Done ~ $count inserts \n";
?>