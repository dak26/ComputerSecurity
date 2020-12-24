<?php

$servername = "localhost";
$username = "root";
$db = "assignment";
$password = "";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$cipher = "AES-128-CBC";
$options = 0;
$decryption_iv = "1234567891011121";
$decryption_key = "secret";

$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];



$userQuery = "SELECT * FROM customer";
$userResult = $conn->query($userQuery);

$userFound = 0;

if (strlen($username) > 0 && $userResult->num_rows > 0){
	while ($userRow = $userResult->fetch_assoc()){
		if (openssl_decrypt($userRow['username'], $cipher, $decryption_key, $options, $decryption_iv) == $username){
			$userFound = 1;
			if (password_verify($password, $userRow['password'])){
				echo "Welcome " . $username . "!";
			} 
			else {
				echo "Sorry, wrong password";
			}
		}
	}
}

if ($userFound == 0){
	echo "This user was not found in our database";
}

echo "<br/>";
echo "<form action='cwLoginForm.php'>";
echo "<input type='submit' value='Go Back'>";

?>