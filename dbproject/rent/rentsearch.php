<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "000000", "dbproject");

$columns = array('ID', 'Name', 'Price', 'Displacement', 'StoreID', 'Description');
$input = $_POST(['MotorID']);

$query = "SELECT MotorId, Name, Displacement,StoreID,Description
           FROM motorcycle 
           WHERE MotorID = $input";
$rentday = "SELECT RentDays
            FROM customer
            WHERE RentMotorID = $input"; 
$rentdaymoney = "SELECT price
           FROM motorcycle 
           WHERE MotorID = $input";    
           /*
if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE ID LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

*/
$stmt = $db->prepare($query);
$days = $db->prepare($rentday);
$money = $db->prepare($rentdaymoney);
$finalmoney = ($days * $money);


                          


$stmt->execute();
$motorinforesult = $stmt->fetchAll();

    echo "<tr>";
    echo "<td>".$motorinforesult[$i]['MotorID']."</td>";
    echo "<td>".$motorinforesult[$i]['Name']."</td>";
    echo "<td>".$motorinforesult[$i]['Price']."</td>";
    echo "<td>".$motorinforesult[$i]['Displacement']."</td>";
    echo "<td>".$motorinforesult[$i]['StoreID']."</td>";
    echo "<td>".$motorinforesult[$i]['Description']."</td>";
    echo "<td>".$days['RentDay']."</td>";
    echo "<td>".$finalmoney['RentMoney']."</td>";
    echo "</tr>.";



echo "</table>";
echo "<br><input type ='button' onclick='history.back()' value='Go Back'></input>"
?>