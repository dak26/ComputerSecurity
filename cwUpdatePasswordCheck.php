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
$oldPassword = $_POST['txtOldPassword'];
$newPassword = $_POST['txtNewPassword'];
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);


$userQuery = "SELECT * FROM customer";
$userResult = $conn->query($userQuery);

$userFound = 0;

if (strlen($username) > 0 && $userResult->num_rows > 0){
	while ($userRow = $userResult->fetch_assoc()){
		$id = $userRow['customer_ID'];
		if (openssl_decrypt($userRow['username'], $cipher, $decryption_key, $options, $decryption_iv) == $username){
			$userFound = 1;
			if (password_verify($oldPassword, $userRow['password'])){
				if (mysqli_query($conn, "UPDATE customer SET password = '".$hashedPassword."' WHERE customer_ID = '".$id."'")){
					echo "Password changed for " . $username . "!";
				}
				else {
					echo "Unsuccessful update";
				}
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
echo "<form action='cwUpdatePasswordForm.php'>";
echo "<input type='submit' value='Go Back'>";

?>