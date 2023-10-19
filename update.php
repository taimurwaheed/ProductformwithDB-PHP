<?php
$Id = $_POST['Id'];
$name = $_POST['name'];
$Brand = $_POST['Brand']; 
$Color = $_POST['Color'];
$Warranty = $_POST['Warranty'];
$Material = $_POST['Material'];
$Delivery = $_POST['Delivery'];
$Price = $_POST['Price'];
$availability = $_POST['availability'];

define('dbHostname', 'localhost');  
define('dbUsername', 'root');
define('dbPassword', '');
define('dbName', 'webform');

$con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);

if ($con->connect_error) {
    die("Connection Error".$con->connect_error);
}

$qry = "UPDATE product SET
        Name = '$name',
        Brand = '$Brand',
        Color = '$Color',
        Warranty = '$Warranty',
        Material = '$Material',
        Delivery = '$Delivery',
        Price = '$Price',
        Availability = '$availability'
        WHERE Id='$Id'";

$result = $con->query($qry);

if ($result) {
    // echo "Data has been saved successfully.";
    header("Location:./select.php");
} 
else {
    echo "Data didn't save";
}

$con->close();
?>