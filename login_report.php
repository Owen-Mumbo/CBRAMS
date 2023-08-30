<?php
session_start();

$host = "localhost";
$dbusername = "root";
$dbpassword = "*Mumbo28";
$dbname = "reports";

$mysqli = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error:" . $mysqli->connect_error);
}

$sql = "select * from login";

$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Report</title>
    <style type="text/css">
        body {
            background-color: white;
            margin-top: 40px;
            margin-left: 200px;
        }

        td {
            text-align: center;

        }
    </style>
</head>

<body>
    <table border=1 width="75%">
        <th colspan="7">Login Report</th>
        <tr>
            <td>LogId</td>
            <td>Action</td>
            <td>ActionBy</td>
            <td>Date</td>
            <td>Time</td>
            <td>Role</td>
            <td>Email</td>
        </tr>
        <tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <td>
                    <?php echo $row['LogId'] ?>
                </td>
                <td>
                    <?php echo $row['Action'] ?>
                </td>
                <td>
                    <?php echo $row['ActionBy'] ?>
                </td>
                <td>
                    <?php echo $row['Date'] ?>
                </td>
                <td>
                    <?php echo $row['Time'] ?>
                </td>
                <td>
                    <?php echo $row['Role'] ?>
                </td>
                <td>
                    <?php echo $row['Email'] ?>
                </td>

            </tr>
            <?php
            }
            ?>

    </table>
</body>

</html>