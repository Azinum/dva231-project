/* match.js */

var searchOverlay = false;

/*
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
	this.teamMembers = [];
}

var TeamMember = function(name) {
	this.name = name;
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

function setTarget(elem) {
	if (!target) {
		return;
	}
	let img = elem.querySelector("img");
	let name = elem.querySelector("p");
	target.elem.src = img.src;

	if (target.targetType == TargetType.SELECT_TEAM) {
		target.team.teamName = name.innerText;
	}
	else if (target.targetType == TargetType.SELECT_PLAYER) {
		// target.team.teamName = name.innerText;
	}
}

function searchResultsUpdate() {

}

*/

const TargetType = {
	TARGET_PLAYER : 0,
	TARGET_TEAM : 1
}

var teams = [
	{},
	{}
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
}

function searchOverlayUpdate() {

}

function selectPlayer(elem) {
	doSearch(TargetType.TARGET_PLAYER, (e) => {
		elem.src = e.detail.img;
	});
}

function selectTeam(elem) {
	doSearch(TargetType.TARGET_TEAM, (e) => {
		elem.src = e.detail.img;
	});
}

function doSearch(target, callback) {
	toggleOverlay();
	if (target == TargetType.TARGET_PLAYER) {
		document.addEventListener("searchDone", callback);
	}
	else if (target == TargetType.TARGET_TEAM) {
		document.addEventListener("searchDone", callback);
	}
}

function onClick(img, name) {
	toggleOverlay();
	document.dispatchEvent(
		new CustomEvent(
			"searchDone",
			{
				detail: {
					img: img,
					name: name
				}
			}
		)
	);
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
