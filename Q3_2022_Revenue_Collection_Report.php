<?php
//set variables that contain the database connection details
$servername = "localhost";
$dbusername = "root";
$dbpassword = "*Mumbo28";
$dbname = "reports";

//Creating a new mysqli object to connect to the database
$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);
//Connect errno property is set to an error code from the most recent connection attempt. If there's no error it is set to zero
if ($mysqli->connect_errno) {
    die("Connectin failed:" . $mysqli->connect_error); //Returns a description of the last connection error
}
//SQL query that selects all data from q3_revenue_collection table
$sql = "Select * from q3_2022_revenue_collection";
/*running the sql query against the database by passing it as an argument in the mysqli query function
that returns a result object*/
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Q3 revenue collection 2021/2022</title>
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
            <th colspan="5">Q3 revenue collection 2021/2022</th>
        </tr>
        <tr>
            <td>Receipt_number</td>
            <td>Revenue ID</td>
            <td>Revenue Item Name</td>
            <td>Amount</td>
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
                    <?php echo $row['revenue_id']; ?>
                </td>
                <td>
                    <?php echo $row['Revenue_item_name']; ?>
                </td>
                <td>
                    <?php echo $row['Amount']; ?>
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