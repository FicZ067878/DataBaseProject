<?php
//$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");
require '../config.php';
if(isset($_POST["id"]))
{
 $query = "DELETE FROM motorcycle WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>