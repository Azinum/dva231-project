/* match.js */

var searchOverlay = false;
var popupOverlay = false;

const TargetType = {
	TARGET_PLAYER : 0,
	TARGET_TEAM : 1
};

const Teams = {
	TEAM1 : 0,
	TEAM2 : 1
};

var Team = function() {
	this.name = "";
	this.participants = [];
}

var teams = [

];

function toggleOverlay() {
	searchOverlay = !searchOverlay;

	let elem = document.querySelector(".match-search-overlay");

	if (searchOverlay) {
		elem.classList.add("active");
	}
	else {
		elem.classList.remove("active");
	}

	if (popupOverlay) {
		elem.querySelector(".overlay-popup").classList.remove("hidden");
		elem.querySelector(".match-search").classList.add("hidden");
	}
	else {
		elem.querySelector(".overlay-popup").classList.add("hidden");
		elem.querySelector(".match-search").classList.remove("hidden");
	}
}

var onClickEvent = () => {};

function errorMessage(message) {
	popupOverlay = true;
	toggleOverlay();
	popupOverlay = false;
	let elem = document.querySelector(".overlay-popup");
	elem.innerText = message;
}

function searchOverlayUpdate() {
	let inputText = document.querySelector(".match-search-overlay-content .text-input-field").value;

	document.querySelector(".match-search-overlay-content .match-search-results").innerHTML += `
		<div class="match-search-item shadow" onclick="onClick('img/tmp_team.jpeg', 'Team Onozze')">
			<img src="img/tmp_team.jpeg">
			<p>Team Onozze</p>
		</div>
	`;
}

function selectPlayer(elem, team) {
	console.log(teams);
	if (!teams[team]) {
		errorMessage("You must first select a team!");
		return;
	}
	doSearch(TargetType.TARGET_PLAYER, team, (e) => {
		elem.src = e.data.img;
	});
}

function selectTeam(elem, team) {
	doSearch(TargetType.TARGET_TEAM, team, (e) => {
		elem.src = e.data.img;
		if (!teams[team]) {
			teams[team] = new Team();
		}
		teams[team].name = e.data.name;
		console.log(teams);
	});
}

function doSearch(target, team, callback) {
	toggleOverlay();
	if (target == TargetType.TARGET_PLAYER) {
		onClickEvent = callback;
	}
	else if (target == TargetType.TARGET_TEAM) {
		onClickEvent = callback;
	}
}

function onClick(img, name) {
	toggleOverlay();
	onClickEvent({
		data: {
			img: img,
			name: name
		}
	});
}

((func) => {
	if (document.readyState === "complete" || document.readyState === "interactive") {
		setTimeout(func, 1);
	}
	else {
		document.addEventListener("DOMContentLoaded", func);
	}
})(() => {

});
