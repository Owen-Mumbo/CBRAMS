<?php
session_start();
// Database configuration
$servername = "localhost";
$dbusername = "SystemAdmin";
$dbpassword = "*TrinidadnTobago008";
$dbname = "users";

// Create a database connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_errno) {
	die("Connection failed: " . $conn->connect_error);
}

// Create User
if (isset($_POST['create'])) {
	$user_id = $_POST['ID_number'];
	$role = $_POST['role'];
	$email = $_POST['email'];
	$hashedpwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$username = $_POST['username'];
	$date = date("Y-m-d");
	$time = date("H:i:s");

	$sql = "INSERT INTO user_role(ID_number, Role, Email, Password, Username) VALUES ('$user_id','$role','$email', '$hashedpwd', '$username')";

	if ($conn->query($sql) === TRUE) {
		echo "User created successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// Update User
if (isset($_POST['update'])) {
	$user_id = $_POST['ID_number'];
	$new_email = $_POST['new_email'];
	$new_password = $_POST['new_password'];

	$sql = "UPDATE user_role SET Email='$new_email', Password='$new_password' WHERE ID_number='$user_id'";

	if ($conn->query($sql) === TRUE) {
		echo "User updated successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// Delete User
if (isset($_POST['delete'])) {
	$user_id = $_POST['ID_number'];

	$sql = "DELETE FROM user_role WHERE ID_number='$user_id'";

	if ($conn->query($sql) === TRUE) {
		echo "User deleted successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// Fetch all users
$sql = "SELECT * FROM user_role";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
	<title>Admin Panel</title>
	<style>
		#container {
			background-color: white;
			width: 75%;
			height: 500px;
			margin-left: 150px;
			margin-top: 50px;

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


		h1 {
			text-align: center;
		}

		body {
			background-color: blueviolet;
		}
	</style>
</head>

<body>
	<div id="container">
		<div id="nav">
			<a href="Admin_Registration.php">Sign Up</a>
			<a href="Admin_Reports.html">Reports</a>
			<a href="logout.php">Logout</a>
		</div>
		<h1>Admin Panel</h1>

		<p>Hello,
			<?php echo $_SESSION['uname'] ?>
		</p>

		<!-- Create User Form -->
		<h2>Create User</h2>

		<form method="POST" action="Admin_Landing_Page.php">
			<input type="text" name="username" placeholder="Username" required>
			<input type="text" name="ID_number" placeholder="ID number" required>
			<input type="text" name="role" placeholder="role" required>
			<input type="email" name="email" placeholder="email" required>
			<input type="password" name="password" placeholder="Password" required>
			<input type="submit" name="create" value="Create User">
		</form>

		<!-- Update User Form -->
		<h2>Update User</h2>
		<form method="POST" action="Admin_Landing_Page.php">
			<select name="ID_number" required>
				<?php
				while ($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['ID_number'] . "'>" . $row['Email'] . "</option>";
				}
				?>
			</select>
			<input type="text" name="new_email" placeholder="New Email" required>
			<input type="password" name="new_password" placeholder="New Password" required>
			<input type="submit" name="update" value="Update User">
		</form>

		<!-- Delete User Form -->
		<h2>Delete User</h2>
		<form method="POST" action="Admin_Landing_Page.php">
			<select name="ID_number" required>
				<?php
				//Adjusts the result pointer to an arbitrary row in the result
				/* Reset pointer to the beginning of the result set */
				$result->data_seek(0);
				while ($row = $result->fetch_assoc()) {
					echo "<option value='" . $row['ID_number'] . "'>" . $row['Email'] . "</option>";
				}
				?>
			</select>
			<input type="submit" name="delete" value="Delete User">
		</form>
	</div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>