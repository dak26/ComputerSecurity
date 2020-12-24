<?php

function validUsername($encryptedUsername, $conn){
	$usernameQuery = "SELECT * FROM customer";
	$usernameResult = $conn->query($usernameQuery);
	if($usernameResult->num_rows > 0){
		while($userRow = $usernameResult->fetch_assoc()){
			if ($userRow['username'] == $encryptedUsername){
				return false;
			}
		}
	}
	return true;
}

$servername = "localhost";
$username = "root";
$db = "assignment";
$password = "";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$cipher = "AES-128-CBC";
$iv_length = openssl_cipher_iv_length($cipher);
$options = 0;
$encryption_iv = "1234567891011121";
$encryption_key = "secret";

$username = $_POST['txtUsername'];
$encryptedUsername = openssl_encrypt($username, $cipher, $encryption_key, $options, $encryption_iv);
$password = $_POST['txtPassword'];
$encryptedPassword = openssl_encrypt($password, $cipher, $encryption_key, $options, $encryption_iv);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$name = $_POST['txtName'];
$encryptedName = openssl_encrypt($name, $cipher, $encryption_key, $options, $encryption_iv);
$email = $_POST['txtEmail'];
$encryptedEmail = openssl_encrypt($email, $cipher, $encryption_key, $options, $encryption_iv);
$dob = $_POST['txtDOB'];
$address = $_POST['txtAddress'];
$encryptedAddress = openssl_encrypt($address, $cipher, $encryption_key, $options, $encryption_iv);



$userQuery = "INSERT INTO customer (customerName, customerEmailAddress, dateOfBirth, address, username, password) 
	Values('$encryptedName', '$encryptedEmail', '$dob', '$encryptedAddress', '$encryptedUsername', '$hashedPassword')";

if (strlen($username) > 0 && validUsername($encryptedUsername, $conn)){
	if ($conn->query($userQuery) == TRUE){
		echo "Registration complete";
	}
	else {
		echo "Registration unsuccessful";
	}
}
else {
	echo "Invalid username. Please try again";
}

?>