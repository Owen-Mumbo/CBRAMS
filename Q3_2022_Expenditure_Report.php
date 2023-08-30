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
//SQL query that selects all data from q2_revenue_collection table
$query = "select * from q3_2022_expenditure";
/*running the sql query against the database by passing it as an argument in the mysqli query function
that returns a result object*/
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Q3 Expenditure Report</title>
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
            <th colspan="6">Quarter 3 Expenditure Report 2021/2022</th>
        </tr>
        <tr>
            <td>Receipt number</td>
            <td>Budget ID</td>
            <td>Budget Item Name</td>
            <td>Amount </td>
            <td>Date</td>
            <td>Duration</td>
        </tr>
        <tr>
            <?php
            /*while loop that iterates over the rows in the database and the mysqli fetch assoc method
           gets the row contents from the database as an associative array */
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['Receipt_number']; ?>
                </td>
                <td>
                    <?php echo $row['Budget_ID']; ?>
                </td>
                <td>
                    <?php echo $row['Budget_item_name']; ?>
                </td>
                <td>
                    <?php echo $row['Amount']; ?>
                </td>
                <td>
                    <?php echo $row['Date']; ?>
                </td>
                <td>
                    <?php echo $row['Duration']; ?>
                </td>
            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>