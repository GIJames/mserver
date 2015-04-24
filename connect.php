<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
		<?php
			if(isset($_GET["xnkid"])){
				//database calls to generate a custom URI to be handled by the client program go here
				include 'config/db_credentials.php';
				$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
				
				if($conn->connect_error) {
					$err = "Database connection error.";
				}
				else{
					$query = $conn->prepare("SELECT Servers.name, Servers.players, Servers.maxPlayers, Servers.xnaddr, Servers.ipaddr, IPAddresses.publicIP, IPAddresses.port FROM (Servers LEFT JOIN IPAddresses ON Servers.name=IPAddresses.username) WHERE Servers.xnkid=?");
					$xnkid = $_GET["xnkid"];
					$query->bind_param("s", $xnkid);
					$query->execute();
					$result = $query->get_result();

					if($row = $result->fetch_assoc()){
						$uri = true;
					}
					else {
						$err = "server not found";
					}

					$query->close();
					$conn->close();
					if(isset($uri)){
						//header( 'Location: XXXX://' . $uri ) ;
					}
				}
			}
			function test_number($data) {
			  $data = intval($data);
			  return $data;
			}
		?>
	</head>
	<body>
		<?php
			$conn2 = new mysqli($dbhost, $dbuser, $dbpassword, 'radius');
				
				if($conn2->connect_error) {
					$err = "Database connection error.";
				}
				else{
					$query2 = $conn2->prepare("SELECT public FROM raduserpublic WHERE username=?");
					$name = $row["name"];
					$query2->bind_param("s", $name);
					$query2->execute();
					$result = $query2->get_result();

					if($row2 = $result->fetch_assoc()){
						$allowPublic = $row2['public'];
					}
					else
						$allowPublic = false;

					$query2->close();
					$conn2->close();
					if(isset($uri)){
						//header( 'Location: XXXX://' . $uri ) ;
					}
				}
			if(isset($err)){
				echo "Unable to connect to server: " . $err;
			}
			if(isset($qerr)){
				echo "Unable to execute query: " . $qerr;
			}
			if(isset($uri)){
				echo "Server found:";
				echo "<br>Host: " . $row["name"];
				echo "<br>players: " . $row["players"] . '/' . $row["maxPlayers"];
				echo "<br>Local IP: " . $row["ipaddr"];
				if($row["publicIP"] && $allowPublic){
					echo '<br>Direct connection available:';
					echo "<br>Public IP: " . $row["publicIP"];
					echo "<br>Port: " . $row["port"];
				}
				else{
					if(!$row["publicIP"]) echo "<br>Direct Connection information not available for this game.";
					else echo "<br>Direct Connection information is available for this game:";
					if(!$allowPublic) echo "<br>Host has not enabled Direct Connection.";
					else{
						
					}
				}
			}
		?>
		<br><a href="javascript:history.back()"><i class="fa fa-caret-square-o-left fa-3x"></i></a>
	</body>
</html>