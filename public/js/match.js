/* match.js */

var searchOverlay = false;

const TargetType = {
	SELECT_TEAM : 0,
	SELECT_PLAYER : 1,
};

const Teams = {
	TEAM1 : 0,	// NOTE(lucas): Team 1 is always your team when modifying match results.
	TEAM2 : 1,
};

var Team = function(teamName) {
	this.teamName = teamName;
	this.img = "img/tmp_team.jpeg";
	this.teamMembers = [];
}

var TeamMember = function(name) {
	this.name = name;
	this.img = "img/tmp_profile.jpg";
}

var teams = [
	new Team("Team 1"),
	new Team("Team 2")
];

var target = {
	elem : null,
	team : null,
	targetType : -1,
}

function selectTarget(elem, team, targetType) {
	target.elem = elem;
	target.team = team;
	target.targetType = targetType;	// NOTE(lucas): Are we selecting a team or team player?
}

function setTarget(imageSource) {
	if (!target)
		return;
	target.team.img = imageSource;
	let e = target.elem.src = imageSource;
}

function toggleOverlay() {
	searchOverlay = !searchOverlay;

	let elem = document.querySelector(".match-search-overlay");

	if (searchOverlay) {
		elem.classList.add("active");
	}
	else {
		elem.classList.remove("active");
	}
}

function searchOverlayUpdate() {

}

function start() {
}

((func) => {
	if (document.readyState === "complete" || document.readyState === "interactive") {
		setTimeout(func, 1);
	}
	else {
		document.addEventListener("DOMContentLoaded", func);
	}
})(start);
