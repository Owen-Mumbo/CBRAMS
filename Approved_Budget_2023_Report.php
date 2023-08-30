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
    die("Connection error :" . $mysqli->connect_error); // Description of the error in the connect error property
}

$query = "select * from approved_budget_2023_report ";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Approved Expenditure Report 2022/2023</title>
    <style>
        body {
            background-color: white;
            margin-top: 40px;
            margin-left: 200px;
        }
    </style>
</head>

<body>
    <table border="1" width="85%">
        <tr>
            <th colspan="6">Approved Expenditure Report 2022/2023</th>
        </tr>
        <tr>
            <td>Receipt Number</td>
            <td>Budget Id</td>
            <td>Budget Item Name</td>
            <td>Amount Allocated</td>
            <td>Status</td>
            <td>Date</td>

        </tr>
        <tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['Receipt_number'] ?>
                </td>
                <td>
                    <?php echo $row['Budget_ID'] ?>
                </td>
                <td>
                    <?php echo $row['Budget_item_name'] ?>
                </td>
                <td>
                    <?php echo $row['Amount_allocated'] ?>
                </td>
                <td>
                    <?php echo $row['Status'] ?>
                </td>
                <td>
                    <?php echo $row['Date'] ?>
                </td>
            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>