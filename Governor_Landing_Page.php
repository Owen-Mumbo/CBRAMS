<?php
session_start();
//Creating variables to contain the connection details to the database
$host = "localhost";
$database = "expenditure";
$username = "Governor";
$password = "#Greece2024*";
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
            width: 400px;
            max-width: 100%;
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
            color: mediumspringgreen;
        }

        #header1 {
            background-color: aquamarine;
            padding: 10px 20px;
            border-bottom: 1px solid blue;
            font-size: 14px;
            text-align: center;
        }

        #header2 {
            background-color: aquamarine;
            padding: 10px 20px;
            border-bottom: 1px solid blue;
            font-size: 14px;
            text-align: center;
        }

        body {
            background-color: blueviolet;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;

        }

        #form {
            padding: 30px 40px;
        }

        #label {
            margin-bottom: 10px;
            padding-bottom: 20px;
            position: relative;
            display: inline-block;
            margin-bottom: 5px;
        }

        #label input {
            border: 2px solid black;
            border-radius: 4px;
            display: block;
            font-size: 14px;
            width: 100%;
            padding: 10px;
        }

        status {
            display: block;

        }

        button {
            background-color: #8e44ad;
            border: 2px solid #8e44ad;
            border-radius: 4px;
            color: #fff;
            display: block;
            font-size: 16px;
            padding: 10px;
            margin-top: 40px;
            margin-left: 85px;
            width: 50%;
        }
    </style>

</head>

<body>
    <div id="container">
        <div id="nav">
            <a href="ind.html">Home</a>
            <a href="Governor_Registration.php">Sign Up</a>
            <a href="Governor_Reports.html">Reports</a>
            <a href="logout.php">Log out</a>
        </div>
        <div id="header1">
            <h1>Welcome to the Governor's Page</h1>
        </div>
        <div id="header2">
            <h2>Disbursment of Funds</h2>
        </div>
        <form action="Governor_Landing_Page.php" method="POST" id="form" onsubmit="return validateForm()">
            <p>Hello,
                <?php echo $_SESSION['uname'] ?>
            </p>
            <p>Kindly fill in the form below</p>
            <div id="label">
                <label>Receipt Number</label>
                <input type="text" name="receipt_number" id="receipt_number" placeholder="receipt_number" />
            </div>
            <div id="label">
                <label>Budget Id</label>
                <input type="text" name="budget_id_num" id="budget_id_num" placeholder="budget_id_num" />
            </div>
            <div id="label">
                <label>Budget item</label>
                <input type="text" name="budget_item_name" id="budget_item_name" placeholder="budget_item_name" />
            </div>
            <div id="label">
                <label>Amount</label>
                <input type="text" name="Amount_allocated" id="Amount_allocated" placeholder="Amount_allocated" />
            </div>
            <div id="label">
                <label>Status</label>
                <input type="text" name="Status" id="Status" placeholder="Status" />
            </div>
            <div id="label">
                <label>Date</label>
                <input type="text" name="Date" id="Date" placeholder="Date" />
            </div>

            <button type="Submit" name="Submit">Submit</button>

        </form>

    </div>
    <script type="text/javascript">
        function validateForm() {
            var receipt_number = document.getElementById('receipt_number').value;
            var budget_id = document.getElementById('budget_id_num').value;
            var budget_item = document.getElementById("budget_item_name").value;
            var amount = document.getElementById("Amount_allocated").value;
            var status = document.getElementById("Status").value;
            var date = document.getElementById("Date").value;

            if (receipt_number == " " || isNaN(receipt_number)) {
                alert("Please enter the receipt number");
                return false;
            }
            if (budget_id == " " || isNaN(budget_id)) {
                alert("Please enter the budget id number");
                return false;
            }
            if (budget_item == " ") {
                alert("Please enter the budget item");
                return false;
            }
            if (amount == " " || isNaN(amount)) {
                alert("Please enter the amount");
                return false;
            }
            if (duration == " " || isNaN(duration)) {
                alert("Please enter the duration");
                return false;
            }
            if (Status == " ") {
                alert("Please enter the approval status");
                return false;
            }
            comps = date.split("-");
            if (comps[0].length < 4 || comps[1].length < 1 || comps[2].length < 1) {
                alert("Date must be of the format (yyyy-mm-dd)");
                return false;
            }
            return true;

        }

    </script>

    <?php
    // $_POST is a super-global array which is used to collect form data after submitting an HTML form with the method post
    $getreceipt = $_POST['receipt_number'];
    $getbudgetID = $_POST['budget_id_num'];
    $getbudgetItem = $_POST['budget_item_name'];
    $getamount = $_POST['Amount_allocated'];
    $getapproval = $_POST['Status'];
    $getdate = $_POST['Date'];
    $id = $_SESSION['user_id'];
    $time = date("H:i:s");


    $query = "INSERT INTO budget_approvals(Receipt_number,Budget_ID,budget_item_name, Amount_allocated, Status, Date)VALUES('$getreceipt',' $getbudgetID','$getbudgetItem','$getamount','$getapproval','$getdate')";
    //To execute the SQL, call query method on the mysqli object passing in the SQL var as an arguement
    //This returns a result object
    $result = $mysqli->query($query);
    if ($result) {
        echo "Successful Approval";
        //selects the default database to be used when performing queries against the database connection
        $mysqli->select_db('reports');
        //SQL query that inserts log information to the log table
        $sql = "INSERT INTO log(Action, ActionBy, Date, Time, Table_modified, Category)VALUES('Initiate expenditure approvals','$id','$getdate','$time','budget_approvals','insert')";
        $mysqli->query($sql) or die($mysqli->error); //Returns a string description of the last error
        //Returns the no of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query
        if ($mysqli->affected_rows > 0) {
            echo "Log table updated successfully";
        }
    } else {
        if ($mysqli->errno === 1062) {
            die("Budget item already approved");
        } else {
            die($mysqli->error . "" . $mysqli->errno); //returns the error description and error code from the most recent function call
        }
    }
    ?>
</body>

</html>