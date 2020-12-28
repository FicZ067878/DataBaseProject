<?php
//$connect = mysqli_connect("localhost", "root", "esti20000425", "dbproject");
require_once "../config.php";
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE customer SET ".$_POST["column_name"]."='".$value."' WHERE ID = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
