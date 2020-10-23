var searchoverlay = false;

var onClickEvent = () => {};
var ajaxFetcher = () => {};

function doSearch(clickCallback, ajaxCallback) {
    searchoverlayToggle();
    document.querySelector(".searchoverlay form input").value = "";
    document.querySelector(".searchoverlay .results").innerHTML = "";
    onClickEvent = clickCallback;
    ajaxFetcher = ajaxCallback;
}

function onClick(data) {
    searchoverlayToggle();
	onClickEvent(data);
}

function searchoverlayToggle() {
    searchoverlay = !searchoverlay;

    if (searchoverlay) {
        document.querySelector(".searchoverlay").classList.add("active");
    } else {
        document.querySelector(".searchoverlay").classList.remove("active");
    }
}

function searchoverlayUpdate(elem) {
    if (elem.value.length >=3 ) {
        ajaxFetcher(elem.value);
    } else {
        document.querySelector(".searchoverlay .results").innerHTML = "";
    }
}
