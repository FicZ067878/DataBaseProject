<?php
//$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");
require_once "../config.php";
if(isset($_POST["id"]))
{
 $query = "DELETE FROM customer WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>