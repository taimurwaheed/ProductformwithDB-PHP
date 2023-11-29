<?php
ob_start();

$Id = $_GET['Id'];

if (!isset($Id)) {
    header("location: ./select.php");
    exit();
}

define('dbHostname', 'localhost');
define('dbUsername', 'root');
define('dbPassword', '');
define('dbName', 'webform');

$con = new mysqli(dbHostname, dbUsername, dbPassword, dbName);

if ($con->connect_error) {
    die("Connect Error " . $con->connect_error);
}

$qry = "SELECT * FROM product WHERE Id='" . $Id . "'";

$result = $con->query($qry);
$row = $result->fetch_assoc();

if (!isset($row)) {
    header("location: ./select.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Update operation
        $Id = $_POST['Id'];
        $name = $_POST['name'];
        $Brand = $_POST['Brand'];
        $Color = $_POST['Color'];
        $Warranty = $_POST['Warranty'];
        $Material = $_POST['Material'];
        $Delivery = $_POST['Delivery'];
        $Price = $_POST['Price'];
        $availability = $_POST['availability'];

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
            header("Location:./select.php");
            exit();
        } else {
            echo "Data update failed";
        }
    } elseif (isset($_POST['delete'])) {
        // Delete operation
        $qry = "DELETE FROM product WHERE Id='" . $Id . "'";
        $result = $con->query($qry);

        if ($result) {
            header("Location:./select.php");
            exit();
        } else {
            echo "Data deletion failed";
        }
    }
}
$con->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Product Record</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        button[name="delete"] {
    background-color: #e74c3c;
    color: #fff;
    cursor: pointer;
    border: none;
    padding: 8px 16px;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    border-radius: 4px;
}

button[name="delete"]:hover {
    background-color: #c0392b;
}
    </style>
</head>
<body>
    <form action="./update.php" method="post">
        <input type="hidden" name="Id" value="<?php echo isset($row['Id']) ? $row['Id'] : ''?>">
        <br>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo isset($row['Name']) ? $row['Name'] : ''?>">
        <br>

        <label for="Brand">Brand</label>
        <input type="text" id="Brand" name="Brand" value="<?php echo isset($row['Brand']) ? $row['Brand'] : ''?>">
        <br>

        <label for="Color">Color</label>
        <input type="text" id="Color" name="Color" value="<?php echo isset($row['Color']) ? $row['Color'] : ''?>">
        <br>

        <label for="Warranty">Warranty</label>
        <input type="text" id="Warranty" name="Warranty" value="<?php echo isset($row['Warranty']) ? $row['Warranty'] : ''?>">
        <br>

        <label for="Material">Material</label>
        <input type="text" id="Material" name="Material" value="<?php echo isset($row['Material']) ? $row['Material'] : ''?>">
        <br>

        <label for="Delivery">Delivery:</label>
        <select name="Delivery" id="Delivery">
            <option value="Yes" <?php echo isset($row['Delivery']) && $row['Delivery'] == 'Yes' ? 'selected' : ''?>>Yes</option>
            <option value="No" <?php echo isset($row['Delivery']) && $row['Delivery'] == 'No' ? 'selected' : ''?>>No</option>
        </select>
        <br>
        
        <label for="Price">Price</label>
        <input type="number" id="Price" name="Price" value="<?php echo isset($row['Price']) ? $row['Price'] : ''?>">
        <br>

        <label for="availability">Availability</label>
        <input type="text" id="availability" name="availability" value="<?php echo isset($row['Availability']) ? $row['Availability'] : ''?>">
        <br>

        <input type="submit" name="update" id="update" value="Update">
        <br>
    </form> 
    <form action="" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
        <input type="hidden" name="Id" value="<?php echo isset($row['Id']) ? $row['Id'] : '' ?>">
        <button type="submit" name="delete">Delete</button>
    </form>
</body>
</html>
