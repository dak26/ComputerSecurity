<?php

$servername = "localhost";
$username = "root";
$db = "assignment";
$password = "";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$userQuery = "SELECT * FROM customer";
$userResult = $conn->query($userQuery);

echo "<table border='1'>";

if ($userResult->num_rows > 0){
	echo "<tr>";
	echo "<td> ID </td>";
	echo "<td> Name </td>";
	echo "<td> Email </td>";
	echo "<td> DOB </td>";
	echo "<td> Address </td>";
	echo "<td> Username </td>";
	echo "<td> Password </td>";
	echo "</tr>";
	while($userRow = $userResult->fetch_assoc()){
		echo "<tr>";
		echo "<td>" . $userRow['customer_ID'] . "</td>";
		echo "<td>" . $userRow['customerName'] . "</td>";
		echo "<td>" . $userRow['customerEmailAddress'] . "</td>";
		echo "<td>" . $userRow['dateOfBirth'] . "</td>";
		echo "<td>" . $userRow['address'] . "</td>";
		echo "<td>" . $userRow['username'] . "</td>";
		echo "<td>" . $userRow['password'] . "</td>";
		echo "</tr>";
	}
}

echo "</table>";

?>