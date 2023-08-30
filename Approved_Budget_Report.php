<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "*Mumbo28";
$dbname = "expenditure";

$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($mysqli->connect_errno) {
    die("Connection Error:" . $mysqli->connect_error);
}

if (isset($_POST['Submit'])) {
    // $_SESSION['startdate'] = $_POST['startdate'];
    // $_SESSION['enddate'] = $_POST['enddate'];
    $_SESSION['year'] = $_POST['year'];

    // Get user input
    // $startdate = $_SESSION['startdate'];
    // $enddate = $_SESSION['enddate'];
    $year = $_SESSION['year'];

    //SQL query that selects all data from actual_expenditure
    $query = "select * from budget_approvals where YEAR(Date) = '$year'";
    /*running the sql query against the database by passing it as an argument in the mysqli query function
    that returns a result object*/
    $result = $mysqli->query($query);
}

?>
<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        body {
            background-color: #76e3d4;
        }

        table {
            width: 75%;
            margin-left: 200px;
            margin-top: 20px;
        }
    </style>
    <title>Search Data</title>
</head>

<body>
    <form method="POST" action="Approved_Budget_Report.php">
        <div id="paragraph">
            <p>First Quarter is between July 1st - Sep 30th </p>
            <p>Second Quarter is between Oct 1st - Dec 31st </p>
            <p>Third Quarter is between Jan 1st - March 31st </p>
            <p>Fourth Quarter is between April 1st - June 30th </p>

        </div>
        <select name="year">
            <option value="" Disabled>Select option</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
        </select>

        <button type="Submit" name="Submit">Search</button><br>

    </form>
    <!-- <script type="text/javascript">
        function validateForm() {
            var str_date = document.getElementById("startdate").value;
            var end_date = document.getElementById("enddate").value;

            comp = str_date.strip("-");

            if (comp[0].length < 4 || comp[1].length < 1 || comp[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }

            comp = end_date.strip("-");

            if (comp[0].length < 4 || comp[1].length < 1 || comp[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }
            return true;
        }

    </script> -->
    <table border="1">
        <tr>
            <th colspan="6"> Approved Budget Report</th>
        </tr>
        <tr>
            <td>Receipt number</td>
            <td>Budget ID</td>
            <td>Budget Item Name</td>
            <td>Amount Allocated</td>
            <td>Status</td>
            <td>Date</td>
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
                    <?php echo $row['Amount_allocated']; ?>
                </td>
                <td>
                    <?php echo $row['Status']; ?>
                </td>
                <td>
                    <?php echo $row['Date']; ?>
                </td>

            </tr>
            <?php
            }
            ?>


    </table>

</body>

</html>