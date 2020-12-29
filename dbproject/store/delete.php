<?php
require_once "../config.php";
if(isset($_POST["id"]))
{
 $query = "DELETE FROM store WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>