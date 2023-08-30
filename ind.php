<?php
//Starts a new session or resumes an existing one
session_start();

//Check for user id value in the SESSION array
if (isset($_SESSION['id'])) {
    //Creating variables to contain the connection details to the database
    $host = "127.0.0.1:3306";
    $database = "users";
    $username = "root";
    $password = "*Mumbo28";
    //Creating a a new mysqli object to connect to the database
    $mysqli = new mysqli($host, $username, $password, $database);
    //Connect errno property is set to an error code from the most recent connection attempt. If there's no error it is set to zero
    if ($mysqli->connect_errno) {
        die("Connection error :" . $mysqli->connect_error); // Description of the error in the connect error property
    }
    //Write the SQL to select the user record
    $sql = "SELECT * FROM user_role
        WHERE ID_number = {$_SESSION["id"]}";
    //Run the sql using the query method to get a result object
    $result = $mysqli->query($sql);
    //Gets an associative array containing the records' values using fetch_assoc method
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <head>

    <body>
        <div id="container">
            <div id="header">
                <h1>Home</h1>
            </div>

            <?php if (isset($user)): ?>

                <p>Hello
                    <? htmlspecialchars($user["Username"]) ?>
                </p>

                <p><a href="logout.php">Log out</a></p>

            <?php else: ?>

                <p><a href="User Login1.php">Log in</a> or <a href="Taxpayer registration.html">Taxpayer Sign up</a> </p>

            <?php endif; ?>

    </body>

</html>