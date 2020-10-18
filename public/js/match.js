/* match.js */

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
