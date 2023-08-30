<?php
session_start();
//Creating variables to contain the connection details to the database
$host = "localhost";
$database = "revenue";
$username = "Taxpayer";
$password = "*MercGLS600";
//Creating a a new mysqli object to connect to the database
$mysqli = new mysqli($host, $username, $password, $database);
//Connect errno property is set to an error code from the most recent connection attempt. If there's no error it is set to zero
if ($mysqli->connect_errno) {
    die("Connection error :" . $mysqli->connect_error); //Returns a description of the last connection error
}
?>

<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        #container {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            width: 500px;

        }

        #header {
            background-color: rgb(128, 0, 90);
            color: white;
            padding: 5px;
            border-bottom: 1px solid black;
            font-size: 14px;
            text-align: center;

        }

        body {
            background-color: darkkhaki;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        #form {
            padding: 30px 40px;
        }

        p {
            margin-top: 0;
        }

        select {
            margin-bottom: 20px;
        }

        #form-group {
            margin-bottom: 10px;
            padding-bottom: 5px;
            position: relative;
        }

        #form-group label {
            display: inline-block;
            margin-bottom: 0px;
        }

        #form-group input {
            border: 2px solid black;
            border-radius: 4px;
            display: block;
            font-size: 14px;
            width: 75%;
            padding: 10px;
        }

        button {
            background-color: #448fad;
            border: 2px solid #8e44ad;
            border-radius: 4px;
            color: #fff;
            display: block;
            font-size: 16px;
            padding: 10px;
            margin-top: 20px;
            margin-left: 85px;
            width: 50%;
        }

        #nav {
            background-color: black;
            overflow: hidden;
            width: 100%;
        }

        #nav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        #nav a:hover {
            color: aqua;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="nav">
            <a href="ind.html">Home</a>
            <a href="Taxpayer_registration_details.php">Sign Up</a>
            <a href="Taxpayer_Report.html">Reports</a>
            <a href="logout.php">Log out</a>
        </div>
        <div id="header">
            <h1>Welcome to the Taxpayer's Page!</h1>
        </div>
        <div id="header">
            <h2>Tax Details</h2>
        </div>
        <form action="Taxpayer_landing_page.php" method="POST" id="form" onsubmit="return validateForm()">
            <p>Hello,
                <?php echo $_SESSION['uname'] ?>
            </p>
            <p>Select the revenue item you're billed for</p>
            <select name="Revenue_item_name" id="Revenue_item_name">
                <option value="" Disabled>Select the Revenue Item</option>
                <option value="Land Rates">Land Rates</option>
                <option value="Parking Fees">Parking Fees</option>
                <option value="Building Permits">Building Permits</option>
                <option value="Business Permits">Business Permits</option>
                <option value="Billboards and Advertisements">Billboards and Advertisements</option>
                <option value="House Rent">House Rent</option>
                <option value="Stall Rent">Stall Rent</option>
                <option value="Fire Inspection Certificates">Fire Inspection Certificates</option>
                <option value="Food Handlers Certificates">Food Handlers Certificates</option>
                <option value="Market">Market</option>
                <option value="Court Fines">Court Fines</option>
                <option value="Court Awards">Court Awards</option>
                <option value="Conveyance Fees">Conveyance Fees</option>
                <option value="Garbage Charges">Garbage Charges</option>
                <option value="Food Hygiene License">Food Hygiene License</option>
                <option value="Attachment Fees">Attachment Fees</option>
                <option value="Pest Control">Pest Control</option>
                <option value="Encroachment Fees">Encroachment Fees</option>
                <option value="Survey Fees">Survey Fees</option>
                <option value="Civil Engineering Drawings">Civil Engineering Drawings</option>
                <option value="Outdoor Events">Outdoor Events</option>
                <option value="Electricity and Maintenance">Electricity and Maintenance</option>
                <option value="Library">Library</option>
                <option value="Social Halls">Social Halls</option>
                <option value="Inspection of Schools">Inspection of Schools</option>
                <option value="Betting Control and Lotteries">Betting Control and Lotteries</option>
                <option value="Tree Cutting">Tree Cutting</option>
                <option value="Ambulance Fees">Ambulance Fees</option>
                <option value="Landscaping Fees">Landscaping Fees</option>
                <option value="Hire of recreational parks">Hire of recreational parks</option>
            </select>

            <div id="form-group">
                <label>Revenue ID</label>
                <input type="text" name="Revenue_ID" id="Revenue_ID" placeholder="Revenue ID">
            </div>

            <div id="form-group">
                <label>Amount</label><br>
                <input type="text" name="Amount" id="Amount" placeholder="Amount">
            </div>

            <div id="form-group">
                <label>Duration</label><br>
                <input type="text" name="Duration" id="Duration" placeholder="Duration">
            </div>

            <div id="form-group">
                <label>Date of payment</label><br>
                <input type="text" name="Date_of_payment" id="Date_of_payment" placeholder="Date">
            </div>

            <div id="form-group">
                <label>Expected Date of payment</label><br>
                <input type="text" name="ExpDate_of_payment" id="ExpDate_of_payment" placeholder="Date">
            </div>

            <button type="submit" name="submit">Submit</button>

        </form>
    </div>
    <script type="text/javascript">
        function validateForm() {
            var revenueItem = document.getElementById("Revenue_item_name").value;
            var revid = document.getElementById("Revenue_ID").value;
            var amount = document.getElementById("Amount").value;
            var duration = document.getElementById("Duration").value;
            var Date_of_payment = document.getElementById("Date_of_payment").value;
            var ExpDate_of_payment = document.getElementById("ExpDate_of_payment").value;

            if (revenueItem == " ") {
                alert("Please select the revenue item name");
                return false;
            }
            if (revid == " " || isNaN(revid)) {
                alert("Enter the valid revenue id");
                return false;
            }

            if (amount == " " || isNaN(amount)) {
                alert("Enter a valid amount");
                return false;
            }
            if (duration == " " || isNaN(duration)) {
                alert("Enter the valid duration");
                return false;
            }
            comps = Date_of_payment.split("-");
            //Ensuring the date components are of correct length
            if (comps[0].length < 4 || comps[1].length < 1 || comps[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }
            comps = ExpDate_of_payment.split("-");
            //Ensuring the date components are of correct length
            if (comps[0].length < 4 || comps[1].length < 1 || comps[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }
            return true;
        }
    </script>
    <?php
    // $_POST is a super global array which is used to collect form data after submitting an HTML form with the method post
    $getrevid = $_POST['Revenue_ID'];
    $getrevenue_item = $_POST['Revenue_item_name'];
    $getamount = $_POST['Amount'];
    $getduration = $_POST['Duration'];
    $getDate = $_POST['Date_of_payment'];
    $getExpDate = $_POST['ExpDate_of_payment'];
    $id = $_SESSION['user_id'];
    $time = date("H:i:s");

    $query = "INSERT INTO revenue_items_collection_table( Revenue_item_name, Amount, Duration, Date_of_Payment, Expected_Payment_Date, ID_number, revenue_id)VALUES('$getrevenue_item','$getamount','$getduration','$getDate','$getExpDate','$id',' $getrevid ')";
    //To execute the SQL, call query method on the mysqli object passing in the SQL var as an arguement
    //This returns a result object
    $result = $mysqli->query($query);
    if ($result) {
        echo "Revenue item successfully recorded";
        //selects the default database to be used when performing queries against the database connection
        $mysqli->select_db('reports');
        //SQL query that inserts log information to the log table
        $sql = "INSERT INTO log( Action, ActionBy, Date, Time, Table_modified, Category)VALUES('Initiated tax payment','$id','$getDate','$time','revenue_items_collection_table','insert')";
        $mysqli->query($sql) or die($mysqli->error); //Returns a string description of the last error
        //Returns the no of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query
        if ($mysqli->affected_rows > 0) {
            echo "Log table updated successfully";
        }
    } else {
        if ($mysqli->errno === 1062) {
            die(" Record already exists");
        } else {
            die($mysqli->error . " " . $mysqli->errno); //Returns error description and error code of the most recent function call
        }
    }
    ?>




</body>

</html>