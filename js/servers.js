//server list
var servers = [];
//order for sorting and sorting basis
var reverse = false;
var BasisEnum = {
	NAME: 0,
	MAP: 1,
	MODE: 2,
	PLAYERS: 3,
	SPECIAL: 4,
	PING: 5
}
var basis = BasisEnum.PING;

function serverSort(a,b){
	var result = 0;
	switch(basis){
		case BasisEnum.NAME:
			result = a.name.localeCompare(b.name);
		break;
		case BasisEnum.MAP:
			result = a.map.localeCompare(b.map);
		break;
		case BasisEnum.MODE:
			result = a.mode.localeCompare(b.mode);
		break;
		case BasisEnum.PLAYERS:
			result = a.players - b.players;
		break;
		case BasisEnum.SPECIAL:
			result = a.special.localeCompare(b.special);
		break;
		case BasisEnum.PING:
			result = b.ping - a.ping;
		break;
		default:
		
	}
	return (reverse ? result : -1 * result);
}

var filters = {
	name: "",
	map: "",
	mode: "",
	excludeEmpty: false,
	excludeFull: false,
	special: "",
	maxPing: 1000
}

function filtered(server){
	if(server.name.toLowerCase().search(filters.name.toLowerCase()) == -1){
		return true;
	}
	if(server.map.toLowerCase().search(filters.map.toLowerCase()) == -1){
		return true;
	}
	if(server.mode.toLowerCase().search(filters.mode.toLowerCase()) == -1){
		return true;
	}
	if(filters.excludeEmpty && server.players == 0){
		return true;
	}
	if(filters.excludeFull && server.players == server.maxPlayers){
		return true;
	}
	if(server.special.toLowerCase().search(filters.special.toLowerCase()) == -1){
		return true;
	}
	if(server.ping > filters.maxPing){
		return true;
	}
	return false;
}

function connect(id){
	alert(id);
}

function continueRefresh(response){
	var jsonResponse = JSON.parse(response);
	servers = jsonResponse.servers;
	finishRefresh();
}


function finishRefresh(){
	servers.sort(function(a,b){return serverSort(a,b);});
	var contentsString = "<tr><th onclick=\"order(BasisEnum.NAME)\">name</th><th onclick=\"order(BasisEnum.MAP)\">map</th><th onclick=\"order(BasisEnum.MODE)\">mode</th><th onclick=\"order(BasisEnum.PLAYERS)\">players</th><th onclick=\"order(BasisEnum.SPECIAL)\">special</th><th onclick=\"order(BasisEnum.PING)\">ping</th></tr>";
	for(server in servers){
		if(!filtered(servers[server])){
			console.log(contentsString);
			contentsString = contentsString + "<tr><td><a href=\"?sid=" + servers[server].id + "\">" + servers[server].name + "</a></td><td>" + servers[server].map + "</td><td>" + servers[server].mode + "</td><td>" + servers[server].players + "/" + servers[server].maxPlayers + "</td><td>" + servers[server].special + "</td><td>" + servers[server].ping + "</td></tr>";
		}
	}
	document.getElementById("serverList").innerHTML = contentsString;
}

function reFilter(){
	finishRefresh();
}

function order(b){
	reverse = ((basis == b) ? !reverse : false);
	basis = b;
	finishRefresh();
}

function requestServers(){
	var request = new XMLHttpRequest();
	var url = "ajax/serverlist.json.php";
	
	request.onreadystatechange=function() {
		if (request.readyState == 4 && request.status == 200){
			continueRefresh(request.responseText);
		}
	}
	request.open("GET" , url, true);
	request.send();
	
}

function refresh(){
	document.getElementById("serverList").innerHTML = "";
	requestServers();
}

window.onload = function() {
	refresh();
}