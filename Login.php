<?php
session_start();
//Creating variables to contain the connection details to the database
$host = "localhost";
$dbname = "users";
$username = "root";
$dbpassword = "*Mumbo28";
//Creating a new mysqli object to connect to the database
$mysqli = new mysqli($host, $username, $dbpassword, $dbname);
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
            width: 500px;
        }

        #header {
            background-color: yellow;
            border: 1px solid black;
            text-align: center;
            padding: 20px;
        }

        body {
            background-color: green;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;

        }

        #form {
            padding: 30px 40px;
        }

        #form-group {
            padding-bottom: 10px;
            margin-bottom: 10px;

        }

        button {
            margin-top: 20px;
            margin-left: 30%;
            width: 100px;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>User Login</h1>
        </div>
        <form action="Login.php" method="POST" id="form" onsubmit="return validateForm()">
            <div id="form-group">
                <label>Email:</label>
                <input type="text" name="email" id="email" placeholder="email">
            </div>
            <div id="form-group">
                <label>Password:</label>
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            <div id="form-group">
                <label for="Role">User role:</label><br>
                <select name="Role" id="Role">
                    <option value="">Select the user role</option>
                    <option value="Taxpayer">Taxpayer</option>
                    <option value="CCO">CCO</option>
                    <option value="CEC">CEC</option>
                    <option value="Governor">Governor</option>
                    <option value="Deputy Governor">Deputy Governor</option>
                    <option value="admin">admin</option>
                </select>
            </div>

            <label>Enter Captcha:</label>
            <div id="form-group col-md-6">
                <input type="text" readonly id="capt">
            </div>
            <div id="form-group col-md-6">
                <input type="text" id="textinput">
            </div>

            <button type="submit" name="login_submit" onclick="validcap()">Submit</button>

            <h6>Captcha not visible <img src="refresh.png" width="20px" height="20px" onclick="cap()"></h6>

        </form>
        <?php
        //PHP function that checks whether a form has been submitted via clicking the submit button by checking whether
        //the submit button with the name "login_submit" is set in the $_POST superglobal array 
        if (isset($_POST["login_submit"])) {

            $time = date("H:i:s");
            $date = date("Y-m-d");
            // $_POST is a super global array which is used to collect form data after submitting an HTML form with the method
            // post
            $email = $_POST["email"];
            $role = $_POST["Role"];

            $sql = "SELECT * FROM user_role WHERE Email='$email'";

            //To execute the SQL, call query method on the mysqli object passing in the SQL var as an arguement
            //This returns a result object
            $result = $mysqli->query($sql);

            //to get the data from the result object we call the fetch_assoc method
            //this will return a record if one was found as an associative array
            $user_rows = $result->fetch_assoc();
            if ($user_rows) {
                if ($user_rows["Role"] === 'CEC' && password_verify($_POST["password"], $user_rows["Password"])) {
                    $_SESSION['uname'] = $user_rows['Username'];
                    $_SESSION['user_id'] = $user_rows['ID_number'];
                    $_SESSION['user_email'] = $user_rows['Email'];
                    $_SESSION['user_role'] = $user_rows['Role'];

                    $mysqli->select_db('reports');
                    $sql = "INSERT INTO login( Action, ActionBy, Date, Time, Role, Email)VALUES('Login','$_SESSION[uname]','$date','$time','$role','$email')";
                    $mysqli->query($sql) or die($mysqli->error);
                    if ($mysqli->affected_rows > 0) {
                        echo "Login table successfully updated";
                    }
                    header("location:CEC_Member_for_Finance_Landing.php");

                } elseif ($user_rows["Role"] == 'Governor' && password_verify($_POST["password"], $user_rows["Password"])) {
                    $_SESSION['uname'] = $user_rows['Username'];
                    $_SESSION['user_id'] = $user_rows['ID_number'];
                    $_SESSION['user_email'] = $user_rows['Email'];
                    $_SESSION['user_role'] = $user_rows['Role'];

                    $mysqli->select_db('reports');
                    $sql = "INSERT INTO login( Action, ActionBy, Date, Time, Role, Email)VALUES('Login','$_SESSION[uname]','$date','$time','$role','$email')";
                    $mysqli->query($sql) or die($mysqli->error);
                    if ($mysqli->affected_rows > 0) {
                        echo "Login table successfully updated";
                    }
                    header("location:Governor_Landing_Page.php");

                } elseif ($user_rows["Role"] == 'Deputy Governor' && password_verify($_POST["password"], $user_rows["Password"])) {
                    $_SESSION['uname'] = $user_rows['Username'];
                    $_SESSION['user_id'] = $user_rows['ID_number'];
                    $_SESSION['user_email'] = $user_rows['Email'];
                    $_SESSION['user_role'] = $user_rows['Role'];

                    $mysqli->select_db('reports');
                    $sql = "INSERT INTO login( Action, ActionBy, Date, Time, Role, Email)VALUES('Login','$_SESSION[uname]','$date','$time','$role','$email')";
                    $mysqli->query($sql) or die($mysqli->error);
                    if ($mysqli->affected_rows > 0) {
                        echo "Login table successfully updated";
                    }
                    header("location:Deputy_Governor_Landing_Page.php");

                } elseif ($user_rows["Role"] == 'Taxpayer' && password_verify($_POST["password"], $user_rows["Password"])) {
                    $_SESSION['uname'] = $user_rows['Username'];
                    $_SESSION['user_id'] = $user_rows['ID_number'];
                    $_SESSION['user_email'] = $user_rows['Email'];
                    $_SESSION['user_role'] = $user_rows['Role'];

                    $mysqli->select_db('reports');
                    $sql = "INSERT INTO login( Action, ActionBy, Date, Time, Role, Email)VALUES('Login','$_SESSION[uname]','$date','$time','$role','$email')";
                    $mysqli->query($sql) or die($mysqli->error);
                    if ($mysqli->affected_rows > 0) {
                        echo "Login table successfully updated";
                    }
                    header("location:Taxpayer_landing_page.php");


                } elseif ($user_rows["Role"] == 'CCO' && password_verify($_POST["password"], $user_rows["Password"])) {
                    $_SESSION['uname'] = $user_rows['Username'];
                    $_SESSION['user_id'] = $user_rows['ID_number'];
                    $_SESSION['user_email'] = $user_rows['Email'];
                    $_SESSION['user_role'] = $user_rows['Role'];

                    $mysqli->select_db('reports');
                    $sql = "INSERT INTO login( Action, ActionBy, Date, Time, Role, Email)VALUES('Login','$_SESSION[uname]','$date','$time','$role','$email')";
                    $mysqli->query($sql) or die($mysqli->error);
                    if ($mysqli->affected_rows > 0) {
                        echo "Login table successfully updated";
                    }
                    header("location:CCO_Landing_Page.php");

                } elseif ($user_rows["Role"] == 'admin' && password_verify($_POST["password"], $user_rows["Password"])) {
                    $_SESSION['uname'] = $user_rows['Username'];
                    $_SESSION['user_id'] = $user_rows['ID_number'];
                    $_SESSION['user_email'] = $user_rows['Email'];
                    $_SESSION['user_role'] = $user_rows['Role'];

                    $mysqli->select_db('reports');
                    $sql = "INSERT INTO login( Action, ActionBy, Date, Time, Role, Email)VALUES('Login','$_SESSION[uname]','$date','$time','$role','$email')";
                    $mysqli->query($sql) or die($mysqli->error);
                    if ($mysqli->affected_rows > 0) {
                        echo "Login table successfully updated";
                    }
                    header("location:Admin_Landing_Page.php");

                } else {
                    die("Invalid Login");
                }
            } else {
                echo "User not found";
            }

        }

        ?>
    </div>

    <script type="text/javascript">
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var ddl = document.getElementById("Role").value;
            var captcha = document.getElementById("textinput").value

            if (email.length == 0 || email.indexOf("@") == -1 || email.indexOf(".") == -1) {
                alert("Please enter a valid email");
                return false;
            }
            if (password == " " || password.length < 8 || password.length > 64) {
                alert("Please enter a valid password");
                return false;
            }
            if (ddl == " ") {
                alert("Please select user role");
                return false;
            }
            if (captcha == " ") {
                alert("Please key in corresponding values to the captcha ")
                return false;
            }
            return true;
        }

        function cap() {
            var alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V'
                , 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
                'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '@', '#', '$', '%', '^', '&', '*', '+'];
            //Math.floor() function rounds a number down to the nearest integer
            /*The Math.random() function generates a random number between 0 (inclusive) and 1 (exclusive),
             and multiplying it by 71 gives a random index within the range of the alpha array.*/
            var a = alpha[Math.floor(Math.random() * 71)];
            var b = alpha[Math.floor(Math.random() * 71)];
            var c = alpha[Math.floor(Math.random() * 71)];
            var d = alpha[Math.floor(Math.random() * 71)];
            var e = alpha[Math.floor(Math.random() * 71)];
            var f = alpha[Math.floor(Math.random() * 71)];

            var final = a + b + c + d + e + f;
            document.getElementById("capt").value = final;
        }
        function validcap() {
            var stg1 = document.getElementById("capt").value;
            var stg2 = document.getElementById("textinput").value;
            if (stg1 == stg2) {
                alert("Form is validated successfully");
                return true;
            } else {
                alert("Enter valid captcha");
                return false;
            }

        }

    </script>
</body>

</html>