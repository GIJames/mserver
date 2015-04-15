<!DOCTYPE html>
<html>
	<head>
		<?php
			if(isset($_GET["sid"]){
				//database calls to generate a custom URI to be handled by the client program go here
				//header( 'Location: XXXX://' . $uri ) ;
			}
		?>
		<link rel="stylesheet" href="css/main.css">
		<script src="js/servers.js"></script>
	</head>
	<body>
		<div id="topBar" class="fullWidth">
			<a onclick="refresh()">refresh server list</a>
			<form id="filters">
			<span>name:</span><input onkeyup="reFilter()" type="text" name="name">
			<span>map:</span><input onkeyup="reFilter()" type="text" name="map">
			<span>mode:</span><input onkeyup="reFilter()" type="text" name="mode">
			<span>hide empty:</span><input onclick="reFilter()" type="checkbox" name="empty">
			<span>hide full:</span><input onclick="reFilter()" type="checkbox" name="full">
			<span>special:</span><input onkeyup="reFilter()" type="text" name="special">
			<span>max ping:</span><input onkeyup="reFilter()" type="text" name="maxPing">
			</form>
		</div>
		<div id="serverListDiv" class="fullWidth">
			<table id="serverList" class="serverTable">
				<tr>
					<th onclick="order(BasisEnum.NAME)">name</th>
					<th onclick="order(BasisEnum.MAP)">map</th>
					<th onclick="order(BasisEnum.MODE)">mode</th>
					<th onclick="order(BasisEnum.PLAYERS)">players</th>
					<th onclick="order(BasisEnum.SPECIAL)">special</th>
					<th onclick="order(BasisEnum.PING)">ping</th>
				</tr>
				<tr>
					<td>name</td>
					<td>map</td>
					<td>mode</td>
					<td>players</td>
					<td>special</td>
					<td>ping</td>
				</tr>
				<tr>
					<td>name</td>
					<td>map</td>
					<td>mode</td>
					<td>players</td>
					<td>special</td>
					<td>ping</td>
				</tr>
			</table>
		</div>
	</body>
</html>