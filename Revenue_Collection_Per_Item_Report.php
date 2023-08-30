<?php
//Creating variables to contain the connection details to the database
$host = "localhost";
$database = "reports";
$username = "root";
$password = "*Mumbo28";
//Creating a a new mysqli object to connect to the database
$mysqli = new mysqli($host, $username, $password, $database);
//Connect errno property is set to an error code from the most recent connection attempt. If there's no error it is set to zero
if ($mysqli->connect_errno) {
    die("Connection error :" . $mysqli->connect_error); //Returns a description of the last connection error
}
//SQL query that selects all data from revenue_collection_per_item
$query = "select * from revenue_collection_per_item";
/*running the sql query against the database by passing it as an argument in the mysqli query function
that returns a result object*/
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Most Income Generating Item Report</title>
    <style>
        body {
            background-color: white;
            margin-top: 40px;
            margin-left: 200px;
        }

        td {
            text-align: center;

        }
    </style>
</head>

<body>
    <table border="1" width="75%">
        <tr>
            <th colspan="3">Revenue Collection Per Item Report</th>
        </tr>
        <tr>
            <td>Revenue Id</td>
            <td>Revenue Item Name</td>
            <td>Amount Collected</td>
        </tr>
        <tr>
            <?php
            /*while loop that iterates over the rows in the database and the mysqli fetch assoc method
           gets the row contents from the database as an associative array */
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['revenue_id'] ?>
                </td>
                <td>
                    <?php echo $row['Revenue_item_name'] ?>
                </td>
                <td>
                    <?php echo $row['Amount'] ?>
                </td>
            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>