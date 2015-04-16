<?php
	//database calls to generate the server list go here

	//make sure credentials file is hidden in .gitignore .htaccess
	$credentials = fopen("../config/db_credentials.txt", "r");
	$servername = trim(fgets($credentials));
	$username = trim(fgets($credentials));
	$password = trim(fgets($credentials));
	$dbname = trim(fgets($credentials));
	fclose($credentials);
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	else{
		$query = "SELECT DISTINCT map FROM Servers";
		$result = $conn->query($query);
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		$conn->close();
		echo json_encode($rows); //note: JS will have to be updated to match new format
	}
?>