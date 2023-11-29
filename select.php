<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Product</title>
    <link rel="stylesheet" href="styles.css">
    <style>

            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .product-table {
                width: 80%;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            a {
                display: block;
                margin-bottom: 20px;
                background-color: #3498db;
                color: #fff;
                padding: 10px;
                text-decoration: none;
                border-radius: 4px;
            }

            a:hover {
                background-color: #207cca;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #3498db;
                color: #fff;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            tr:hover {
                background-color: #f0f0f0;
            }
    </style>
</head>
<body>
    <a href="./productform.html">Add New Product Record</a>
    <table class="product-table">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Brand</th>
            <th>Color</th>
            <th>Warranty</th>
            <th>Material</th>    
            <th>Delivery</th>    
            <th>Price</th>    
            <th>Availability</th>
            <th>Action</th> <!-- Add an Action column for Edit/Delete -->
        </tr> 

        <?php
            define('dbHostname', 'localhost');
            define('dbUsername', 'root');
            define('dbPassword', '');
            define('dbName', 'webform');

            $con = new mysqli(dbHostname, dbUsername, dbPassword, dbName);

            if ($con->connect_error) { 
                die("Connect Error " . $con->connect_error);
            }

            $qry = "SELECT * FROM product";

            $result = $con->query($qry);

            while ($row = $result->fetch_assoc()) {
                $Id = $row['Id']; // Define and initialize $Id here

                echo "<tr>
                    <td>".$Id."</td>
                    <td>".$row['Name']."</td>
                    <td>".$row['Brand']."</td>
                    <td>".$row['Color']."</td>
                    <td>".$row['Warranty']."</td>
                    <td>".$row['Material']."</td>
                    <td>".$row['Delivery']."</td>
                    <td>".$row['Price']."</td>
                    <td>".$row['Availability']."</td>
                    <td>
                        <a href='./edit.php?Id=".$Id."'>Edit</a>
                    </td>
                </tr>";
            }
            $con->close();
        ?>
    </table>
</body>
</html>
