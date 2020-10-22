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
var onSearchEvent = () => {};

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
		<div class="match-search-item shadow" onclick="onClick({img: 'img/tmp_team.jpeg', name: 'Team Onozze'})">
			<img src="img/tmp_team.jpeg">
			<p>Team Onozze</p>
		</div>
	`;
}

function selectPlayer(elem, team) {
	if (!teams[team]) {
		errorMessage("You must first select a team!");
		return;
	}
	doSearch(
		(e) => {
			elem.src = e.img;
		},
		() => {
			let inputText = document.querySelector(".match-search-overlay-content .text-input-field").value;

			document.querySelector(".match-search-overlay-content .match-search-results").innerHTML += `
				<div class="match-search-item shadow" onclick="onClick({img: 'img/default_profile_image.svg', name: 'xDragonSlayer72'})">
					<img src="img/default_profile_image.svg">
					<p>xDragonSlayer72</p>
				</div>
			`;
		}
	);
}

function selectTeam(elem, team) {
	doSearch(
		(e) => {
			elem.src = e.img;
			if (!teams[team]) {
				teams[team] = new Team();
			}
			teams[team].name = e.name;
		},
		() => {
			let inputText = document.querySelector(".match-search-overlay-content .text-input-field").value;

			document.querySelector(".match-search-overlay-content .match-search-results").innerHTML += `
				<div class="match-search-item shadow" onclick="onClick({img: 'img/tmp_team2.jpeg', name: 'Good Team'})">
					<img src="img/tmp_team2.jpeg">
					<p>Good Team</p>
				</div>
			`;
		}
	);
}

function doSearch(clickCallback, searchCallback) {
	toggleOverlay();
	onClickEvent = clickCallback;
	onSearchEvent = searchCallback;
}

function onClick(data) {
	toggleOverlay();
	onClickEvent(data);
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
