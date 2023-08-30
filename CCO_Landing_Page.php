<?php
session_start();
//Creating variables to contain the connection details to the database
$host = "localhost";
$database = "revenue";
$username = "County Chief Officer";
$password = "*Blueberry023";
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
    <title>County Chief Officer's Landing Page</title>
    <style type="text/css">
        #container {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            width: 450px;
            max-width: 100%;
            height: 500px;
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
            padding: 20px 20px;
            border-bottom: 1px solid black;
            font-size: 18px;
            text-align: center;
            font-weight: 500;
        }

        #header2 {
            background-color: aquamarine;
            padding: 10px 20px;
            border-bottom: 1px solid black;
            font-size: 14px;
            text-align: center;
        }

        #label {
            padding-top: 20px;
            padding-left: 40px;
        }

        #label input {
            display: block;
            margin-top: 10px;
        }

        body {
            background-color: blueviolet;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        button {
            background-color: #8e44ad;
            border: 2px solid #8e44ad;
            border-radius: 4px;
            color: #fff;
            display: block;
            font-size: 16px;
            padding: 5px;
            margin-top: 30px;
            margin-left: 150px;
            width: 120px;

        }
    </style>
</head>

<body>
    <div id="container">
        <div id="nav">
            <a href="ind.html">Home</a>
            <a href="logout.php">Log out</a>
        </div>
        <div id="header1">
            <hl>Welcome to the County Chief Officer's Page!</hl>
        </div>
        <div id="header2">
            <h2>Add Revenue Items</h2>
        </div>
        <form action="CCO_Landing_Page.php" method="POST" id="form" onsubmit="return validateForm()">
            <p>Hello,
                <?php echo $_SESSION['uname'] ?>
            </p>
            <div id="label">
                <label>Revenue Item</label>
                <input type="text" name="revenue_item_name" id="revenue_item_name" placeholder="revenue_item_name" />
            </div>
            <button type="Submit" name="Submit">Submit</button>
        </form>
    </div>
    <script type="text/javascript">
        function validateForm() {
            var revItem = document.getElementById("revenue_item_name").value;

            if (revItem == " ") {
                alert("Please enter the revenue item name");
                return false;
            }
            return true;
        }
    </script>

</body>

</html>

<?php
if (isset($_POST['Submit'])) {
    // $_POST is a super global array which is used to collect form data after submitting an HTML form with the method post    
    $revItemName = $_POST['revenue_item_name'];
    $id = $_SESSION['uname'];
    $getdate = date("Y-m-d");
    $time = date("H:i:s");


    $sql = "INSERT INTO revenue_items_table(revenue_item_name)VALUES('$revItemName')";
    //To execute the SQL, call query method on the mysqli object passing in the SQL var as an arguement
    //This returns a result object
    $result = $mysqli->query($sql);
    if ($result) {
        echo "Record successfully captured";
        //selects the default database to be used when performing queries against the database connection
        $mysqli->select_db('reports');
        //SQL query that inserts log information to the log table
        $sql = "INSERT INTO log( Action, ActionBy, Date, Time, Table_modified, Category)VALUES('Initiated allocation','$id','$getdate','$time','revenue_items_table','insert')";
        $mysqli->query($sql) or die($mysqli->error); //Returns a string description of the last error
        //Returns the no of rows affected by the last INSERT, UPDATE, REPLACE or DELETE
        if ($mysqli->affected_rows > 0) {
            echo "Log table updated successfully";
        }
    } else {
        if ($mysqli->error === 1062) {
            die("Record already exists");
        } else {
            die($mysqli->error . "" . $mysqli->errno); //returns the error description and error code from the most recent function call
        }
    }
}
?>