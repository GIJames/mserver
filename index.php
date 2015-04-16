<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/servers.js"></script>
	</head>
	<body>
		NOTICE: THIS IS DUMMY DATA, NOT ACTUAL SERVER DATA
		<div id="topBar" class="fullWidth">
			<div class="refreshDiv"><a href="#" onmouseover="startSpin(this)" onmouseout="stopSpin(this)" onclick="refresh()"><i class="fa fa-refresh fa-3x"></i></a></div>
			<form id="filters">
			<span>name:</span><input onkeyup="reFilter()" type="text" name="name">
			<span>map:</span><select onchange="reFilter()" type="text" name="map" id="maps"></select>
			<span>mode:</span><select onchange="reFilter()" type="text" name="mode" id="mode"></select>
			<span>hide empty:</span><input onclick="reFilter()" type="checkbox" name="empty">
			<span>hide full:</span><input onclick="reFilter()" type="checkbox" name="full">
			<span>special:</span><input onkeyup="reFilter()" type="text" name="special">
			<span>max ping:</span><input onkeyup="reFilter()" type="text" name="maxPing">
			</form>
		</div>
		<div id="serverListDiv" class="fullWidth">
			<table id="serverList" class="serverTable">
				<tr><th><i class="fa fa-spinner fa-pulse fa-5x"></i></th></tr>
			</table>
		</div>
		<p>Server browser by GIJames - <a href="https://github.com/GIJames/mserver">https://github.com/GIJames/mserver</a><br>
		Font Awesome by Dave Gandy - <a href="http://fontawesome.io">http://fontawesome.io</a></p>
	</body>
</html>