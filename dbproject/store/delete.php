<?php
$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM store WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>