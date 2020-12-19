<?php echo 'test der ja'; exit; ?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Testing Ja</h1>
<p>This is a paragraph.</p>
<?php
$servername = "192.168.100.188";
$username = "talekteam";
$password = "9kg]Hdmu,gvl";

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
