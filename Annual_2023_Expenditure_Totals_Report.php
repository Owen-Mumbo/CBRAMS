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

$query = "select * from annual_2023_expenditure_totals";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Annual Totals Expenditure Report 2022/2023</title>
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
            <th colspan="3">Annual Totals Expenditure Report 2022/2023</th>
        </tr>
        <tr>
            <td>Budget ID</td>
            <td>Budget item name</td>
            <td>Amount Spent</td>

        </tr>
        <tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['Budget_ID'] ?>
                </td>
                <td>
                    <?php echo $row['Budget_item_name'] ?>
                </td>
                <td>
                    <?php echo $row['Total_Amount_Spent'] ?>
                </td>
            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>