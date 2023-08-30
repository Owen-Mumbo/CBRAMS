<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "*Mumbo28";
$dbname = "revenue";

$mysqli = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($mysqli->connect_errno) {
    die("Connection Error:" . $mysqli->connect_error);
}

if (isset($_POST['Submit'])) {
    $_SESSION['dop'] = $_POST['dop'];
    $_SESSION['edop'] = $_POST['edop'];
    $_SESSION['duration'] = $_POST['duration'];

    // Get user input
    $dop = $_SESSION['dop'];
    $edop = $_SESSION['edop'];
    $duration = $_SESSION['duration'];

    //SQL query 
    $query = "select * from revenue_items_collection_table where Duration = '$duration' and Expected_Payment_Date between '$dop' and '$edop'";

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
    <form method="POST" action="Revenue_collection_reports.php" onsubmit=" return validateForm()">
        <div id="paragraph">
            <p>First Quarter is between July 1st - Sep 30th </p>
            <p>Second Quarter is between Oct 1st - Dec 31st </p>
            <p>Third Quarter is between Jan 1st - March 31st </p>
            <p>Fourth Quarter is between April 1st - June 30th </p>

        </div>
        <label>Date of Payment</label>
        <input type="text" name="dop" id="dop" placeholder="dop">
        <label>Expected Date of Payment</label>
        <input type="text" name="edop" id="edop" placeholder="edop">
        <label>Duration</label>
        <input type="text" name="duration" id="duration" placeholder="duration">
        <button type="Submit" name="Submit">Search</button><br>

    </form>
    <script type="text/javascript">
        function validateForm() {
            var dop = document.getElementById("dop").value;
            var edop = document.getElementById("edop").value;
            var duration = document.getElementById("duration").value;

            if (duration == "" || isNaN(duration)) {
                alert("Please enter the right duration");
                return false;
            }

            comp = dop.strip("-");

            if (comp[0].length < 4 || comp[1].length < 1 || comp[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }
            comp = edop.strip("-");

            if (comp[0].length < 4 || comp[1].length < 1 || comp[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }
            return true;
        }

    </script>
    <table border="1">
        <tr>
            <th colspan="6"> Revenue Collection Report</th>
        </tr>
        <tr>
            <td>Receipt number</td>
            <td>Revenue ID</td>
            <td>Revenue Item Name</td>
            <td> Amount</td>
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