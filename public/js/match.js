/* match.js */

var searchOverlay = false;

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

var onClickEvent = () => {};

function searchOverlayUpdate() {

}

function selectPlayer(elem) {
	doSearch(TargetType.TARGET_PLAYER, (e) => {
		elem.src = e.data.img;
	});
}

function selectTeam(elem) {
	doSearch(TargetType.TARGET_TEAM, (e) => {
		elem.src = e.data.img;
	});
}

function doSearch(target, callback) {
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
