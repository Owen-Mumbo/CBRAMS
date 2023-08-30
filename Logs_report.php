<?php
//Creating variables to contain the connection details to the database
$host = "127.0.0.1:3306";
$database = "reports";
$username = "root";
$password = "*Mumbo28";
//Creating a a new mysqli object to connect to the database
$mysqli = new mysqli($host, $username, $password, $database);
//Connect errno property is set to an error code from the most recent connection attempt. If there's no error it is set to zero
if ($mysqli->connect_errno) {
    die("Connection error :" . $mysqli->connect_error); //Returns a description of the last connection error
}
//SQL query that selects all data from q1_expenditure
$query = "select * from log";
/*running the sql query against the database by passing it as an argument in the mysqli query function
that returns a result object*/
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Log Report</title>
    <style>
        body {
            background-color: #76e3d4;
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
            <th colspan="7">Log</th>
        </tr>
        <tr>
            <td>Log ID</td>
            <td>Action</td>
            <td>Action By</td>
            <td>Date</td>
            <td>Time</td>
            <td>Table Modified</td>
            <td>Category</td>
        </tr>
        <tr>
            <?php
            /*while loop that iterates over the rows in the database and the mysqli fetch assoc method
           gets the row contents from the database as an associative array */
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['LogID']; ?>
                </td>
                <td>
                    <?php echo $row['Action']; ?>
                </td>
                <td>
                    <?php echo $row['ActionBy']; ?>
                </td>
                <td>
                    <?php echo $row['Date']; ?>
                </td>
                <td>
                    <?php echo $row['Time']; ?>
                </td>
                <td>
                    <?php echo $row['Table_modified'] ?>
                </td>
                <td>
                    <?php echo $row['Category'] ?>
                </td>
            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>