<?php
require_once "../config.php";
if(isset($_POST["ID"], $_POST["Name"], $_POST["RentDays"], $_POST["RentMotorID"], $_POST["Phone"], $_POST["Description"]))
{
 $ID = mysqli_real_escape_string($connect, $_POST["ID"]);
 $name = mysqli_real_escape_string($connect, $_POST["Name"]);
 $rentdays = mysqli_real_escape_string($connect, $_POST["RentDays"]);
 $MID = mysqli_real_escape_string($connect, $_POST["RentMotorID"]);
 $phone = mysqli_real_escape_string($connect, $_POST["Phone"]);
 $des = mysqli_real_escape_string($connect, $_POST["Description"]);
 $query = "INSERT INTO customer(ID, Name, RentDays, RentMotorID, Phone, Description) VALUES('$ID', '$name', '$rentdays', '$MID', '$phone', '$des')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>