<?php
print_r($_POST);
require_once "../../../config.php";
if(isset($_POST["UserID"]) && isset($_POST["RentMotorID"]))
{
 $query = "UPDATE customer 
 SET RentMotorID = '".$_POST["RentMotorID"]."'  
 WHERE ID = '".$_POST["UserID"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'you rent the motorcycle!!!';
 }
}
?>