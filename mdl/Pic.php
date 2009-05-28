<?php
/**
 * Defines a picture of a product and where to find it,
 * plus small, tiny and large variations, as well as its
 * tooltip text.
 * E.g.
 *  n123.jpg
 *  n123-sml.jpg
 *  n123-lrg.jpg
 */
class Pic {
  public $name;
  private $path;
  private $suffix;
  public $text;
  
  public $small;
  public $large;

  function __construct($name, $path) {
    // Separate suffix from name.
    $i = strrpos($name, '.');
    if ($i===false) $i = -1;
    if ($i >= 0) {
      $this->name = substr($name, 0, $i);
      $this->suffix = substr($name, $i);
    } else {
      $this->name = $name;
      $this->suffix = '.jpg'; 	// default jpeg
    }
    $this->path = $path;
    $this->small = $path.$this->name.'-sml'.$this->suffix;
    $this->large = $path.$this->name.'-lrg'.$this->suffix;
  }

  /**
   * Returns the text for the corresponding picture image,
   * or the name if the file does not exist.
   */
  public function getText() {
    if (!empty($this->text)) 
    	return $this->text;
    $file = TEXTPATH.$this->name.'.txt';
    $text = '';
    if (file_exists($file)) {
    // read the file and return the text
      $lines = file($file);
      foreach ($lines as $line) {
         $text .= $line.' ';
      }
    }
    $this->text = $text;
    return $text;
  }
}
?>
