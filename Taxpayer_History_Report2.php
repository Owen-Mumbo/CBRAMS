<?php
session_start();
//storing session variable in a variable $uname 
$uname = $_SESSION['uname'];
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

if (isset($_POST['Submit'])) {

    $_SESSION['dop'] = $_POST['dop'];
    $_SESSION['epd'] = $_POST['epd'];

    $dop = $_SESSION['dop'];
    $epd = $_SESSION['epd'];

    //SQL query that selects all data from taxpayer_history_report where Username = '$uname'
    $query = "select * from taxpayer_history_report where Expected_Payment_Date between '$dop' and '$epd '  ";
    $result = $mysqli->query($query);

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Taxpayer History Report</title>
    <style>
        body {
            background-color: #76e3d4;
            margin-top: 40px;
            margin-left: 200px;
        }

        table {
            margin-top: 10px;
        }

        td {
            text-align: center;

        }
    </style>
</head>

<body>
    <form action="Taxpayer_History_Report2.php" method="POST">
        <label>Date_of_Payment</label>
        <input type="text" name="dop" id="dop" placeholder="dop" required>
        <label>Expected Payment Date</label>
        <input type="text" name="epd" id="epd" placeholder="epd" required>
        <button name="Submit" type="Submit">Submit</button>

    </form>
    <table border="1" width="75%">
        <tr>
            <th colspan="9">Taxpayer History Report</th>
        </tr>
        <tr>
            <td>Receipt number</td>
            <td>ID number</td>
            <td>Username</td>
            <td>Revenue Item Name</td>
            <td>KRA_Pin</td>
            <td>Date of Payment</td>
            <td> Expected Payment Date</td>
            <td>Amount</td>
            <td>County Name</td>
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
                    <?php echo $row['ID_number']; ?>
                </td>
                <td>
                    <?php echo $row['Username']; ?>
                </td>
                <td>
                    <?php echo $row['Revenue_item_name']; ?>
                </td>
                <td>
                    <?php echo $row['KRA_Pin']; ?>
                </td>
                <td>
                    <?php echo $row['Date_of_Payment']; ?>
                </td>
                <td>
                    <?php echo $row['Expected_Payment_Date']; ?>
                </td>
                <td>
                    <?php echo $row['Amount']; ?>
                </td>
                <td>
                    <?php echo $row['County_name']; ?>
                </td>
            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>