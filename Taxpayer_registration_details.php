<?php
//Start new or resume existing session
session_start();
//Creating variables to contain the connection details to the database
$host = "localhost";
$database = "users";
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
    <title>Taxpayer Registration Page</title>
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
            padding: 10px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        #header {
            background-color: green;
            padding: 10px 40px;
            border-bottom: 1px solid blue;
            font-size: 14px;
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

        #form-group {
            margin-bottom: 0;
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
            width: 100%;
            padding: 10px;
        }

        #captcha {
            margin-bottom: 10px;
        }

        button {
            background-color: #8e44ad;
            border: 2px solid #8e44ad;
            border-radius: 4px;
            color: #fff;
            display: block;
            font-size: 16px;
            padding: 10px;
            margin-top: 30px;
            margin-left: 85px;
            width: 50%;
        }

        h5 {
            padding: 10px 80px;
        }

        p {
            margin-left: 20%;
        }
    </style>

</head>

<body>
    <div id="container">
        <div id="nav">
            <a href="ind.html">Home</a>
            <a href="logout.php">Logout</a>
        </div>
        <div id="header">
            <h1>Taxpayer Registration</h1>
        </div>
        <form action="Taxpayer_registration_details.php" method="POST" name="form" id="form" class="form"
            onsubmit="return validateForm()">
            <div id="form-group">
                <label for="ID_number">ID_number</label>
                <input type="text" name="ID_number" id="ID_number" placeholder="ID_number">
            </div>
            <div id="form-group">
                <label for="Username">Username</label>
                <input type="text" name="Username" id="Username" placeholder="Username">
            </div>
            <div id="form-group">
                <label for="County_name">County_name</label>
                <input type="text" name="County_name" id="County_name" placeholder="County">
            </div>
            <div id="form-group">
                <label for="Password">Password</label>
                <input type="text" name="Password" id="Password" placeholder="Password">
            </div>
            <div id="form-group">
                <label for="KRA_Pin">KRA_Pin</label>
                <input type="text" name="KRA_Pin" id="KRA_Pin" placeholder="KRAPin">
            </div>
            <div id="form-group">
                <label for="Email">Email</label>
                <input type="text" name="Email" id="Email" placeholder="Email">
            </div>
            <div id="form-group">
                <label for="Phone">Phone</label>
                <input type="text" name="Phone" id="Phone" placeholder="PhoneNumber">
            </div>

            <div id="captcha">
                <label>Enter Captcha:</label>
            </div>

            <div id="form-row">
                <div id="form-group col-md-6">
                    <input type="text" readonly id="capt">
                </div>
                <div id="form-group col-md-6">
                    <input type="text" id="textinput">
                </div>

                <button type="submit" onclick="validcap()">Submit</button>

            </div>
        </form>
        <h5>Captcha not visible <img src="refresh.png" height="20px" width="20px" onclick="cap()"></h5>

    </div>

    <script type="text/javascript">
        function validateForm() {
            var idnum = document.getElementById("ID_number").value;
            var Username = document.getElementById("Username").value;
            var County_name = document.getElementById("County_name").value;
            var Password = document.getElementById("Password").value;
            var KRA_Pin = document.getElementById("KRA_Pin").value;
            var email = document.getElementById("Email").value;
            var phone = document.getElementById("Phone").value;
            var captcha = document.getElementById("textinput").value;

            if (idnum.length == 0 || isNaN(idnum)) {
                alert("You must enter a valid ID Number");
                return false;
            }
            if (Username == null) {
                alert("Please enter a valid Username");
                return false;
            }
            if (County_name == null) {
                alert("Please enter a valid County_name");
                return false;
            }
            if (Password == null || Password.length < 8 || Password.length > 64) {
                alert("Please enter a valid Password");
                return false;
            }
            if (KRA_Pin == null) {
                alert("Please enter a valid KRA_Pin");
                return false;
            }
            if (email.length == 0 || email.indexOf("@") == -1 || email.indexOf(".") == -1) {
                alert("You must enter a valid email");
                return false;
            }
            if (phone.length == 0 || isNaN(phone)) {
                alert("You must enter a valid Phone Number");
                return false;
            }
            if (captcha == null) {
                alert("Please key in corresponding values to the captcha ");
                return false;
            }
            return true;
        }
        function cap() {
            var alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V'
                , 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i',
                'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '@', '#', '$', '%', '^', '&', '*', '+'];
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
            var stg1 = document.getElementById('capt').value;
            var stg2 = document.getElementById('textinput').value;
            if (stg1 == stg2) {
                alert("Form is validated Succesfully");
                return true;
            } else {
                alert("Please enter a valid captcha");
                return false;
            }
        }
    </script>
    <?php
    // $_POST is a super global array which is used to collect form data after submitting an HTML form with the method post    
    $getid_no = $_POST['ID_number'];
    $getusername = $_POST['Username'];
    $getcounty_name = $_POST['County_name'];
    $hashedpwd = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $getkra_pin = $_POST['KRA_Pin'];
    $getemail = $_POST['Email'];
    $getphone = $_POST['Phone'];

    $query = "INSERT INTO taxpayer_table(ID_number,Username,Email,KRA_Pin,Phone,County_name,Password) VALUES ('$getid_no','$getusername','$getemail','$getkra_pin','$getphone','$getcounty_name',' $hashedpwd')";
    //To execute the SQL, call query method on the mysqli object passing in the SQL var as an arguement
    //This returns a result object
    $result = $mysqli->query($query);
    if ($result) {
        echo "New user successfully created.";
    } else {
        if ($mysqli->errno === 1062) {
            die(" User already exists");
        } else {
            die($mysqli->error . "" . $mysqli->errno); //Returns an error description and error code for the most recent function call
        }
    }

    ?>

</body>

</html>