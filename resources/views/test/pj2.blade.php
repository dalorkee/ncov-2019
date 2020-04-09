<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Testing Ja</h1>
<p>This is a paragraph.</p>
<?php
$servername = "10.200.2.233";
$username = "talek";
$password = "9kg]Hdmu,";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
	echo "Connected successfully";
?>

</body>
</html>
