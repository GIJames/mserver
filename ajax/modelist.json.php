<?php
	//database calls to generate the server list go here
	$servername = "localhost";
	//make sure credentials file is hidden in .gitignore .htaccess
	$credentials = fopen("../config/db_credentials.txt", "r");
	$username = trim(fgets($credentials));
	$password = trim(fgets($credentials));
	$dbname = "Servers";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		$dummy = fopen("dummydata.json", r);
		echo fread($dummy, filesize("dummydata.json"));
		fclose($dummy);
		die("Connection failed: " . $conn->connect_error);
	}
	else{
		$query = "SELECT DISTINCT mode FROM Servers";
		$result = $conn->query($query);
		$rows = array();
		while($row = $result->fetch_assoc()){
			array_push($rows, $row);
		}
		$conn->close();
		echo json_encode($rows); //note: JS will have to be updated to match new format
	}
?>