<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/main.css">
		<script src="js/servers.js"></script>
	</head>
	<body>
		<div id="topBar" class="fullWidth">
			<a onclick="refresh()">refresh server list</a>
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