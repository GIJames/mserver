<!DOCTYPE html>
<html>
	<head>
		<?php
			if(isset($_GET["sid"])){
				//database calls to generate a custom URI to be handled by the client program go here
				$servername = "localhost";
				//make sure credentials file is hidden in .gitignore .htaccess
				$credentials = fopen("config/db_credentials.txt", "r");
				$username = trim(fgets($credentials));
				$password = trim(fgets($credentials));
				fclose($credentials);
				$conn = new mysqli($servername, $username, $password);
				
				if($conn->connect_error) {
					$err = "Database connection error.";
				}
				else{
					$query = "SELECT players, maxPlayers, uri FROM Servers WHERE id=" . $_GET["sid"];
					$result = $conn->query($query);
					if($row = $result->fetch_assoc()){
						if($row["players"] < $row["maxPlayers"]){
							$uri = $row["uri"];
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
				echo $err;
			}
		?>
	</body>
</html>