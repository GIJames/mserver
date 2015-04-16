<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
		<?php
			if(isset($_GET["sid"])){
				//database calls to generate a custom URI to be handled by the client program go here
				//make sure credentials file is hidden in .gitignore .htaccess
				$credentials = fopen("config/db_credentials.txt", "r");
				$servername = trim(fgets($credentials));
				$username = trim(fgets($credentials));
				$password = trim(fgets($credentials));
				$dbname = trim(fgets($credentials));
				fclose($credentials);
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				if($conn->connect_error) {
					$err = "Database connection error.";
				}
				else{
					$query = "SELECT players, maxPlayers, ipaddr, xnaddr, xnid FROM Servers WHERE id=" . $_GET["sid"];
					$result = $conn->query($query);
					if($row = $result->fetch_assoc()){
						if($row["players"] < $row["maxPlayers"]){
							$uri = "ipaddr=" . $row["ipaddr"] . "&xnaddr=" . $row["xnaddr"] . "&xnid=" . $row["xnid"];
						}
						else{
							$err = "maxPlayers reached";
						}
					}
					else {
						$err = "server not found";
					}
					$conn->close();
					if(isset($uri)){
						//header( 'Location: XXXX://' . $uri ) ;
					}
				}
			}
		?>
	</head>
	<body>
		<?php
			if(isset($err)){
				echo "Unable to connect to server: " . $err;
			}
			if(isset($uri)){
				echo "connection \"successful\"; commence dummy data gibberish:<br>";
				echo $uri;
			}
		?>
		<br><a href="javascript:history.back()"><i class="fa fa-caret-square-o-left fa-3x"></i></a>
	</body>
</html>