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

const participantCount = 5;

var Users = () => {
	return [];
}

var MatchData = function() {
	this.id = 0;
	this.match = {
		id : 0,
		is_verified : false,
		team2_should_verify : false,
		teams : [undefined, undefined]
	};
	this.team_participants = [
		[],
		[]
	];
}

var Team = function() {
	this.name = "";
	this.display_name = "";
	this.participants = Users();
}

var teams = [];

function imageExists(src) {
	let image = new Image();
	image.src = src;
	return image.height != 0;
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

function selectPlayer(elem, team, index) {
	if (!teams[team]) {
		errorMessage("You must first select a team!");
		return;
	}
	let inputField = document.querySelector(".match-search-overlay-content .text-input-field");
	let results = document.querySelector(".match-search-overlay .match-search-results");

	doSearch(
		(e) => {
			elem.src = e.img;
			teams[team].participants[index] = {
				name: e.name,
				id: e.user_id
			}
		},
		() => {
			let inputText = inputField.value;
			results.innerHTML = "";
			let t = teams[team];
			let teamName = t.name;
			fetch("/ajax/search_users_in_team.php?" + new URLSearchParams({"team": teamName, "q": inputText}))
				.then((res) => res.json())
				.then((json) => {
					results.innerHTML = "";
					json.filter((item) => {
						let currentTeam = teams[team];
						if (!currentTeam) {
							return true;
						}
						for (let i in currentTeam.participants) {
							let participant = currentTeam.participants[i];
							if (!participant)
								continue;
							if (participant.name == item.name) {
								return false;
							}
						}
						return true;
					}).forEach((item) => {
						let img = item.img_url ? item.img_url : 'img/default_profile_image.svg';
						results.innerHTML += `
							<div class="match-search-item shadow" onclick="onClick({img: '` + img + `', name: '` + item.name + `', user_id: ` + item.user_id + `})">
								<img src="` + img + `">
								<p>` + item.name + `</p>
							</div>
						`;
					});
				});
		}
	);
	onSearchEvent();
}

function selectTeam(elem, team) {
	let inputField = document.querySelector(".match-search-overlay-content .text-input-field");
	let results = document.querySelector(".match-search-overlay .match-search-results");
	doSearch(
		(e) => {
			elem.src = e.img;
			if (!teams[team]) {
				teams[team] = new Team();
			}
			if (e.name != teams[team].name) {
				let el = document.querySelector(".match-participants" + (team == Teams.TEAM1 ? ".team1" : ".team2"));
				el.childNodes.forEach((item) => {
					item.src = "img/default_profile_image.svg";
				});
				teams[team].participants = Users();
			}
			teams[team].name = e.name;
			teams[team].display_name = e.display_name;
			let displayNameElement = document.querySelector((team == Teams.TEAM1 ? ".team1" : ".team2") + " h2");
			displayNameElement.innerText = e.display_name;
		},
		() => {
			let inputText = inputField.value;
			results.innerHTML = "";
			fetch("/ajax/search_team.php?" + new URLSearchParams({"q": inputText}))
				.then((res) => res.json())
				.then((json) => {
					results.innerHTML = "";
					json.filter((item) => {
						if (!teams[team]) {
							return true;
						}
						return item.display_name !== teams[team].display_name;
					}).forEach((item) => {
						let img = item.img_url ? item.img_url : 'img/default_profile_image.svg';
						results.innerHTML += `
							<div class="match-search-item shadow" onclick="onClick({img: '` + img + `', name: '` + item.name + `', display_name: '` + item.display_name + `'})">
								<img src="` + img + `">
								<p>` + item.display_name + `</p>
							</div>
						`;
					});
				});
		}
	);
	onSearchEvent();
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

function evaluateErrors(conditions) {
	let message = "";
	let error = false;
	conditions.forEach((cond) => {
		if (!cond[1]()) {
			message += cond[0] + '\n';
			error = true;
		}
	});
	if (error) {
		errorMessage(message);
	}
	return error;
}

function submitMatch() {
	let error = evaluateErrors([
		["Please select team 1", () => { return teams[Teams.TEAM1]; }],
		["Please select team 2", () => { return teams[Teams.TEAM2]; }],
		["Missing participants in team 1", () => {
			let team = teams[Teams.TEAM1];
			if (!team) {
				return false;
			}
			let participants = teams[Teams.TEAM1].participants;
			if (!participants) {
				return false;
			}
			for (let i = 0; i < participantCount; ++i) {
				let participant = participants[i];
				if (!participant) {
					return false;
				}
			}
			return true;
		}],
		["Missing participants in team 2", () => {
			let team = teams[Teams.TEAM2];
			if (!team)
				return false;
			let participants = teams[Teams.TEAM2].participants;
			if (!participants)
				return false;
			for (let i = 0; i < participantCount; ++i) {
				let participant = participants[i];
				if (!participant) {
					return false;
				}
			}
			return true;
		}]
	]);
	if (error) {
		return;
	}
}

((func) => {
	if (document.readyState === "complete" || document.readyState === "interactive") {
		setTimeout(func, 1);
	}
	else {
		document.addEventListener("DOMContentLoaded", func);
	}
})(() => {
	// NOTE(lucas): This is from layout/match.php:match_get_info()
	if (!matchData) {
		matchData = new MatchData();
	}
})
