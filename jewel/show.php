<?php
// Creates a show of images for the applicable SITE.
 cmt("SITE=".SITE);
 $sitePics = SITE ."_pics";
 $siteShow = SITE ."_show";
 define(IMGPATH, $_SERVER["DOCUMENT_ROOT"]."/img/");
 
 if (isset($_SESSION[$sitePics])) {
   $pics = $_SESSION[$sitePics];
   $show = $_SESSION[$siteShow];
   cmt(" \$pics from session: ".get_class($pics).",". get_class($show));
 } else {
   cmt("new session $sitePics");
   $pics = new Pics(IMAGE_CONFIG);
   $pics->load();
   $show = new Show( sizeof($pics->show), 4 ); // 4 pics per page
   $_SESSION[$sitePics] = $pics;
   $_SESSION[$siteShow] = $show;
 }
 

 // Did we get here from a next/prev link?
 $page = $_GET['page'];
 if ( isset($page) ) {
   $show->setPageNumber($page);
 } else {
   $page = $show->nextPageNumber();
 }

 cmt("page=$page");

 // Start picture
 $pos = $show->firstPicNumForPage();
 cmt("pic pos=$pos");
 $pic = $pics->get($pos);

 print " <div class=pagenav>";
 print " ". $show->prevPageArrow() ." ";
 for ($i=1; $i<=$show->lastPage; $i++) {
   print $show->getPage($i)." ";
 }
 print $show->nextPageArrow();
 print "</div>\n";
 print "  <table class=show>";

 $i = 0;
 while ($pic != NULL && $i++ <4) {
   printPic($pic);
   $pic = $pics->next();
 }

 print "  </table>\n";

function printPic($pic) {
 print("<tr>\n");
 print(" <td>\n");
 print("  <a href=");
 print($pic->getLarge());
 print(">");
 print("<img src=");
 print($pic->getSmall());	// image
 print(" border=0 title='Click for larger image'>\n");
 print("  </a>");
 print(" </td>\n");
 print(" <td>\n");
 print($pic->getText());	// text
 print(" </td>\n");
 print("</tr>\n");
}
 function cmt($msg) {
   print("<!-- $msg -->\n");
 }
?>
