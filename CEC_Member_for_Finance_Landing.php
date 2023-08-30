<?php
session_start();
//Creating variables to contain the connection details to the database
$host = "localhost";
$database = "expenditure";
$username = "CEC Member for Finance";
$password = "*Waffles4KUHD";
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

        #header {
            background-color: rgb(128, 0, 90);
            color: white;
            padding: 10px 40px;
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

        #form-group {
            margin-bottom: 10px;
            padding-bottom: 20px;
            position: relative;
        }

        #form-group label {
            display: inline-block;
            margin-bottom: 5px;
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
    </style>
</head>

<body>
    <div id="container">
        <div id="nav">
            <a href="CEC_Member_for_Finance_Registration.php">Sign Up</a>
            <a href="CEC_Reports.html">Reports</a>
            <a href="logout.php">Log out</a>
        </div>
        <div id="header">
            <h1>Welcome to the CEC Member for Finance's Page!</h1>
        </div>
        <div id="header">
            <h2>Budget Allocation</h2>
        </div>
        <form action="CEC_Member_for_Finance_Landing.php" method="POST" id="form" onsubmit="return validateForm()">
            <p>Hello,
                <?php echo $_SESSION['uname'] ?>
            </p>
            <div id="form-group">
                <label>Budget ID</label>
                <input type="text" name="Budget_id" id="Budget_id" placeholder="Budget_id" />
            </div>
            <div id="form-group">
                <label>Budget Item</label>
                <input type="text" name="Budget_item_name" id="Budget_item_name" placeholder="Budget_item_name" />
            </div>
            <div id="form-group">
                <label>Amount</label>
                <input type="text" name="Amount" id="Amount" placeholder="Amount" />
            </div>
            <div id="form-group">
                <label>Date</label>
                <input type="text" name="Date" id="Date" placeholder="Date_of_allocation" />
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>

    </div>
    <script type="text/javascript">
        function validateForm() {
            var budget_id = document.getElementById("Budget_id").value;
            var budgetItem = document.getElementById("Budget_item_name").value;
            var amount = document.getElementById("Amount").value;
            var date = document.getElementById("Date").value;

            if (budget_id == " " || isNaN(budget_id)) {
                alert("Enter a valid budget id");
                return false;
            }
            if (budgetItem == " ") {
                alert("Enter a valid name for the budget item");
                return false;
            }
            if (amount = " " || isNaN(amount)) {
                alert("Please enter the amount");
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
    if (isset($_POST['submit'])) {
        // $_POST is a super global array which is used to collect form data after submitting an HTML form with the method post    
        $getbudget_id = $_POST['Budget_id'];
        $getbudgetItem = $_POST['Budget_item_name'];
        $getamount = $_POST['Amount'];
        $getdate = $_POST['Date'];
        // $getduration = $_POST['Duration'];
        $id = $_SESSION['user_id'];
        $time = date("H:i:s");

        $query = "INSERT INTO budget_allocation_tracking_table( Budget_item_name, Amount, Date,Budget_ID)VALUES('$getbudgetItem','$getamount','$getdate','$getbudget_id')";
        //To execute the SQL, call query method on the mysqli object passing in the SQL var as an arguement
        //This returns a result object
        $result = $mysqli->query($query);
        if ($result) {
            echo " Successful Allocation";
            //selects the default database to be used when performing queries against the database connection
            $mysqli->select_db('reports');
            //SQL query that inserts log information to the log table
            $sql = "INSERT INTO log( Action, ActionBy, Date, Time, Table_modified, Category)VALUES('Initiated allocation','$id','$getdate','$time','budget_allocation_tracking_table','insert')";
            $mysqli->query($sql) or die($mysqli->error); //Returns a string description of the last error
            //Returns the no of rows affected by the last INSERT, UPDATE, REPLACE or DELETE
            if ($mysqli->affected_rows > 0) {
                echo "Log table updated successfully";
            }
        } else {
            if ($mysqli->errno === 1062) {
                die(" Allocation already made");
            } else {
                die($mysqli->error . "" . $mysqli->errno); //returns the error description and error code from the most recent function call
            }
        }
    }
    ?>

</body>

</html>