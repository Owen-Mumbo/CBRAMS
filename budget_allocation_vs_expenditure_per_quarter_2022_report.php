<?php
//set variables that contain the database connection details
$servername = "localhost";
$dbusername = "root";
$dbpassword = "*Mumbo28";
$dbname = "reports";

//Creating a new mysqli object to connect to the database
$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);

/*Check for errors in the db connection using the mysqli connect errno property that is set to an error 
code from the most recent connection attempt. If there's no error it is set to zero*/
if ($mysqli->connect_errno) {
    die("Connectin failed:" . $mysqli->connect_error); //Returns a description of the last connection error
}


//SQL query that selects all data from the q1_revenue_collection table
$sql = "Select * from budget_allocation_vs_expenditure_per_quarter_2022";
/*running the sql query against the database by passing it as an argument in the mysqli query function
that returns a result object*/
$result = $mysqli->query($sql);



?>

<!DOCTYPE html>
<html>

<head>
    <title>Budget Allocation vs Expenditure Per Quarter 2021/2022</title>
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
            <th colspan="9">Budget Allocation vs Expenditure Per Quarter 2021/2022</th>
        </tr>
        <tr>
            <td>Budget ID</td>
            <td>Budget Item Name</td>
            <td>Amount Allocated</td>
            <td>Qtr 1</td>
            <td>Qtr 2</td>
            <td>Qtr 3</td>
            <td>Qtr 4</td>
            <td>Total Spent</td>
            <td>Balance</td>
        </tr>
        <tr>
            <?php
            $total = 0;
            /*while loop that iterates over the rows in the database and the mysqli fetch assoc method
             gets the row contents from the database as an associative array */
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['Budget_ID']; ?>
                </td>
                <td>
                    <?php echo $row['Budget_item_name']; ?>
                </td>
                <td>
                    <?php echo $row['Amount_allocated']; ?>
                </td>
                <td>
                    <?php echo $row['Qtr1'] ?>
                </td>
                <td>
                    <?php echo $row['Qtr2'] ?>
                </td>
                <td>
                    <?php echo $row['Qtr3'] ?>
                </td>
                <td>
                    <?php echo $row['Qtr4'] ?>
                </td>
                <td>
                    <?php echo number_format($row['Total_spent']) ?>
                </td>
                <td>
                    <?php echo number_format($row['Balance']); //formats a number with grouped thousands
                        $total = $total + $row['Balance'] ?>
                </td>
            </tr>

            <?php
            }
            ?>
        <tr>
            <td colspan='8'>Total Balance</td>
            <td>
                <?php echo number_format($total) ?>
            </td>
        </tr>


    </table>

</body>

</html>