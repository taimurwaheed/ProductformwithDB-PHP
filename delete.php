<?php
    $Id = $_GET['Id'];
    if(!isset($Id)){
        header("location: ./select.php");
    }

    define('dbHostname','localhost');
    define('dbUsername','root');
    define('dbPassword','');
    define('dbName','webform');

    $con = new mysqli(dbHostname,dbUsername,dbPassword,dbName);


    if ($con->connect_error) {
      die("Connection failed: ".$con->connect_error);
    }

    $sql = "DELETE FROM product WHERE Id='".$Id."'";
    
    if ($con->query($sql) === TRUE) {
        header("location: ./select.php");
      
    } else {
      echo "Error deleting record: " . $con->error;
    }

    $con->close();
?>