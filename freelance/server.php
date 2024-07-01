<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "fmarket");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function test_input($data)
{
	return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate date
function validate_date($date, $format = 'Y-m-d')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) === $date;
}

$username = $name = $email = $password = $contactNo = $birthdate = $address = "";

// Register user
if (isset($_POST["register"])) {
	$username = test_input($_POST["username"]);
	$name = test_input($_POST["Name"]);
	$email = test_input($_POST["email"]);
	$password = test_input($_POST["password"]);
	$repassword = test_input($_POST["repassword"]);
	$contactNo = test_input($_POST["contact_no"]);
	$gender = test_input($_POST["gender"]);
	$birthdate = test_input($_POST["birthdate"]);
	$address = test_input($_POST["address"]);
	$usertype = test_input($_POST["usertype"]);

	if ($password !== $repassword) {
		$_SESSION["errorMsg2"] = "Passwords do not match.";
		header("Location: register.php");
		exit();
	}

	if (!validate_date($birthdate)) {
		$_SESSION["errorMsg2"] = "Invalid birthdate format.";
		header("Location: register.php");
		exit();
	}

	$sql = "SELECT username FROM freelancer WHERE username = ? UNION SELECT username FROM employer WHERE username = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $username, $username);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
		$_SESSION["errorMsg2"] = "The username is already taken.";
		header("Location: register.php");
		exit();
	} else {
		unset($_SESSION["errorMsg2"]);
		$passwordHash = password_hash($password, PASSWORD_BCRYPT);

		if ($usertype == "freelancer") {
			$sql = "INSERT INTO freelancer (username, password, name, email, contact_no, address, gender, birthdate, prof_title, profile_sum, education, experience, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '', '', '', '', '')";
		} else {
			$sql = "INSERT INTO employer (username, password, name, email, contact_no, address, gender, birthdate, company, profile_sum) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '', '')";
		}

		$stmt = $conn->prepare($sql);
		if ($stmt === false) {
			die("Error preparing statement: " . $conn->error);
		}

		$stmt->bind_param("ssssssss", $username, $passwordHash, $name, $email, $contactNo, $address, $gender, $birthdate);
		if ($stmt->execute() === TRUE) {
			if ($usertype == "freelancer") {
				$_SESSION["Username"] = $username;
				$_SESSION["Usertype"] = 1;
				header("Location: freelancerProfile.php");
			} else {
				$_SESSION["Username"] = $username;
				$_SESSION["Usertype"] = 2;
				header("Location: employerProfile.php");
			}
			exit();
		} else {
			echo "Error: " . $stmt->error;
		}
	}
}

// Login user
if (isset($_POST["login"])) {
	session_unset();
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$usertype = test_input($_POST["usertype"]);

	if ($usertype == "freelancer") {
		$sql = "SELECT * FROM freelancer WHERE username = ?";
	} else {
		$sql = "SELECT * FROM employer WHERE username = ?";
	}

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $username);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 1) {
		$user = $result->fetch_assoc();
		if (password_verify($password, $user['password'])) {
			$_SESSION["Username"] = $username;
			$_SESSION["Usertype"] = $usertype == "freelancer" ? 1 : 2;
			unset($_SESSION["errorMsg"]);
			if ($usertype == "freelancer") {
				header("Location: freelancerProfile.php");
			} else {
				header("Location: employerProfile.php");
			}
			exit();
		} else {
			$_SESSION["errorMsg"] = "Incorrect password.";
		}
	} else {
		$_SESSION["errorMsg"] = "No user found with that username.";
	}
	header("Location: login.php");
	exit();
}

// Error messages
$errorMsg = isset($_SESSION["errorMsg"]) ? $_SESSION["errorMsg"] : "";
$errorMsg2 = isset($_SESSION["errorMsg2"]) ? $_SESSION["errorMsg2"] : "";

// Test input function (moved to the top of the file)
// function test_input($data) {
//     return htmlspecialchars(stripslashes(trim($data)));
// }
