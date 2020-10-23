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
	this.participants = [
		undefined,
		undefined,
		undefined,
		undefined,
		undefined
	];
}

var teams = [];

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

function selectPlayer(elem, team, index) {
	if (!teams[team]) {
		errorMessage("You must first select a team!");
		return;
	}
	doSearch(
		(e) => {
			elem.src = e.img;
			teams[team].participants[index] = {
				name: e.name
			}
		},
		() => {
			let inputText = document.querySelector(".match-search-overlay-content .text-input-field").value;
			let results = document.querySelector(".match-search-overlay-content .match-search-results");
			results.innerHTML = "";
			let teamName = teams[team].name;
			fetch("/ajax/search_users_in_team.php?" + new URLSearchParams({"team": teamName, "q": inputText}))
				.then((res) => res.json())
				.then((json) => {
					results.innerHTML = "";
					json.forEach((item) => {
						results.innerHTML += `
							<div class="match-search-item shadow" onclick="onClick({img: '` + item.img_url + `', name: '` + item.name + `'})">
								<img src="` + item.img_url + `">
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
			let results = document.querySelector(".match-search-overlay-content .match-search-results");
			results.innerHTML = "";
			// .includes
			fetch("/ajax/search_team.php?" + new URLSearchParams({"q": inputText}))
				.then((res) => res.json())
				.then((json) => {
					results.innerHTML = "";
					json.forEach((item) => {
						results.innerHTML += `
							<div class="match-search-item shadow" onclick="onClick({img: '` + item.img_url + `', name: '` + item.name + `'})">
								<img src="` + item.img_url + `">
								<p>` + item.name + `</p>
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
			/* participants.forEach((participant) => {
				if (!participant) {
					console.log("C");
					return false;
				}
			}); */
			for (let i in participants) {
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
			// participants.forEach((participant) => {
			// 	if (!participant) {
			// 		return false;
			// 	}
			// });
			for (let i in participants) {
				let participant = participants[i];
				if (!participant) {
					return false;
				}
			}
			return true;
		}]
	]);
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
