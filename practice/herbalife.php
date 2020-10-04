<?php

$total_product = 0;

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "your password"; //Change to your SQL password
 $db = "herbalife"; //your database name

 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
 
 function CalculateTotal($conn)
 {
 
$total_value = 0;

$sql = "SELECT * FROM PRODUCT";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    #echo "id: " . $row["cust_id"]. " - Name: " . $row["cust_name"]. " " . $row["cust_phone"]. "<br>";
    $total_value += $row["unit_price"];
    $GLOBALS["total_product"] +=1;
 
 }
 }
 return $total_value;

} 
   
?>
