

<?php
/**
 * Format Class
 */
class Format{
  public function validation($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data; // here i return this $data variable so we can use this.
 }
	
}
?>