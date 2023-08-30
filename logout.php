<?php

session_start();

// $time = date("h:m:s", time());
// $email = $_SESSION['user_email'];
// $role = $_SESSION['user_role'];
// $uname = $_SESSION['uname'];

// $mysqli->select_db('reports');
// $sql = "INSERT INTO logout( Action, ActionBy, Time, Role, Email)VALUES('Logout','$uname','$time','$role','$email')";
// $mysqli->query($sql) or die($mysqli->error);
// if ($mysqli->affected_rows > 0) {
//     echo "Logout table successfully updated";
// }

session_destroy();
header("Location: Login.php");
exit;

?>