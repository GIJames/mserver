<?php
//ini_set('display_errors', 1); error_reporting(E_ALL);
if(isset($_GET["name"]) && $_GET["name"] !== 'halo'){
	$username = $_GET["name"];
	$publicIP = $_SERVER["REMOTE_ADDR"];
	if(isset($_GET["port"])){
		$port = $_GET["port"];
	}
	else $port = 11770;
	
	include 'config/db_credentials.php';
	$conn = mysqli_connect($dbhost , $dbuser, $dbpassword, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$clearTable = $conn->prepare("DELETE FROM IPAddresses WHERE username=?");
	$clearTable->bind_param("s", $username);
	if ($clearTable->execute()){
		echo "Cleared previous local IP record successfully\n";
	}
	else{
		echo "Clear failed (previous record may not exist.)\n";
	}
	$clearTable->close();
	
	$clearTable2 = $conn->prepare("DELETE FROM IPAddresses WHERE publicIP=?");
	$clearTable2->bind_param("s", $publicIP);
	if ($clearTable2->execute()){
		echo "Cleared previous public IP record successfully\n";
	}
	else{
		echo "Clear failed (previous record may not exist.)\n";
	}
	$clearTable2->close();
	
	$makeTable = $conn->prepare("INSERT INTO IPAddresses (username, publicIP, port) VALUES(?, ?, ?)");
	$makeTable->bind_param("sss", $username, $publicIP, $port);
	if ($makeTable->execute()){
		echo "Registered IP address pair successfully\n";
	}
	else{
		echo "Registration failed\n";
	}
	$makeTable->close();
	$conn->close();
}
?>