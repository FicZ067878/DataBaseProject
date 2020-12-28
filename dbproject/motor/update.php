<?php
//$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");
require '../config.php';
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE motorcycle SET ".$_POST["column_name"]."='".$value."' WHERE ID = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
