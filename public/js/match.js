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

var Participants = () => {
	return [];
}

var Team = function() {
	this.name = "";
	this.display_name = "";
	this.image = "img/default_profile_image.svg";
}

var Match = function() {
	this.id = -1;
	this.is_verified = 0;
	this.result = "Team1Win";
	this.team2_should_verify = true;
	this.teams = [new Team(), new Team()]
}

var MatchData = function() {
	this.id = 0;
	this.match = new Match();
	this.team_participants = [
		new Participants(),
		new Participants()
	];
}

function imageExists(src) {
	let image = new Image();
	image.src = src;
	return image.height != 0;
}

function toggleOverlay() {
	searchOverlay = !searchOverlay;

	let elem = document.querySelector(".match-search-overlay");
	document.querySelector(".match-search-overlay-content .text-input-field").value = "";

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
	if (!matchData.match.teams[team].name) {
		errorMessage("You must first select a team!");
		return;
	}
	let inputField = document.querySelector(".match-search-overlay-content .text-input-field");
	let results = document.querySelector(".match-search-overlay .match-search-results");

	doSearch(
		(e) => {
			elem.querySelector("img").src = e.img;
			elem.querySelector("p").innerText = e.name;
			matchData.team_participants[team][index] = {
				name: e.name,
				id: e.user_id
			}
			inputField.value = "";
		},
		() => {
			let inputText = inputField.value;
			results.innerHTML = "";
			let t = matchData.match.teams[team];
			let teamName = t.name;
			// Figure out which team you are a leader of to do a correct filtering action
			fetch("/ajax/search_users_in_team.php?" + new URLSearchParams({"team": teamName, "q": inputText}))
				.then((res) => res.json())
				.then((json) => {
					results.innerHTML = "";
					json.filter((item) => {
						let participants = matchData.team_participants[team];
						if (!participants) {
							return true;
						}
						for (let i in participants) {
							let participant = participants[i];
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
			if (!matchData.match.teams) {
				matchData.match.teams = [new Team(), new Team()];
			}
			if (e.name != matchData.match.teams[team].name) {
				let el = document.querySelector(".match-participants" + (team == Teams.TEAM1 ? ".team1" : ".team2")).querySelectorAll(".match-player-img");
				for (let i = 0; i < el.length; ++i) {
					el[i].querySelector("img").src = "img/default_profile_image.svg";
					el[i].querySelector("p").innerText = "";
				}
				matchData.team_participants[team] = [];
			}
			matchData.match.teams[team].name = e.name;
			matchData.match.teams[team].display_name = e.display_name;
			let displayNameElement = document.querySelector((team == Teams.TEAM1 ? ".team1" : ".team2") + " h2");
			displayNameElement.innerText = e.display_name;
			inputField.value = "";
		},
		() => {
			let inputText = inputField.value;
			results.innerHTML = "";
			let params = {
				"q": inputText
			};
			// Team 1 is the creator of the match
			if (team == Teams.TEAM1) {
				params["user_id"] = matchData["uid"];
			}
			// TODO(lucas): Auth check to access these ajax request sql query calls
			fetch("/ajax/search_teams.php?" + new URLSearchParams(params))
				.then((res) => res.json())
				.then((json) => {
					results.innerHTML = "";
					json.filter((item) => {
						let matchTeams = matchData.match.teams;
						if (!matchTeams) {
							return true;
						}
						return (item.display_name != matchTeams[Teams.TEAM1].display_name) && (item.display_name != matchTeams[Teams.TEAM2].display_name);
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

function checkForErrors() {
	return evaluateErrors([
		["Please select team 1", () => {
			if (!matchData.match.teams)
				return false;
			return matchData.match.teams[Teams.TEAM1].name;
		}],
		["Please select team 2", () => {
			if (!matchData.match.teams)
				return false;
			return matchData.match.teams[Teams.TEAM2].name;
		}],
		["Missing participants in team 1", () => {
			if (!matchData.match.teams)
				return false;
			let team = matchData.match.teams[Teams.TEAM1];
			if (!team)
				return false;
			let participants = matchData.team_participants[Teams.TEAM1];
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
			if (!matchData.match.teams)
				return false;
			let team = matchData.match.teams[Teams.TEAM2];
			if (!team)
				return false;
			let participants = matchData.team_participants[Teams.TEAM2];
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
}

function submitMatch() {
	if (checkForErrors()) {
		return;
	}
}

function submitMatchChanges() {
	if (checkForErrors()) {
		return;
	}
}

function declineMatch() {

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
		console.log("We shouldn't get here, right? riiiight?");
		matchData = new MatchData();
	}
})
