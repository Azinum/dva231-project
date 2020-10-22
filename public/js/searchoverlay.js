var searchoverlay = false;

var onClickEvent = () => {};
var ajaxFetcher = () => {};

function selectPlayer(elem, team) {
	doSearch(
        (selection) => {
            elem.innerHTML += `
                <div class="profile-box ui-box shadow">
                    <div class="profile">
                        <div class="profilepic">
                            <img src="`+selection.img+`">
                        </div>
                    </div>
                    <span class="label">`+selection.name+`</span>
                    <div class="button button-deny">
                        Kick
                    </div>
                </div>
            `;
	    },
        (searchString) => {
            fetch("/search_user.php?" + new URLSearchParams({"q":searchString}))
                .then((response) => response.json())
                .then((json) => {
                    document.querySelector(".searchoverlay .results").innerHTML = "";
                    json.forEach((item) => {
                        document.querySelector(".searchoverlay .results").innerHTML += `
                            <div class="profile-box ui-box shadow" onclick="onClick({name: '`+item.name+`', id: '`+item.id+`', img: '`+item.img_url+`'});">
                                <div class="profile">
                                    <div class="profilepic">
                                        <img src="`+item.img_url+`">
                                    </div>
                                </div>
                                <span class="label">`+item.name+`</span>
                            </div>
                        `;
                    });
                });
        }
    );
}

function doSearch(clickCallback, ajaxCallback) {
    searchoverlayToggle();
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
        /*document.querySelector(".searchoverlay .results").innerHTML += `
            <div class="profile-box ui-box shadow" onclick="onClick('/img/tmp_profile.jpg', 'Good Team');">
                <div class="profile">
                    <div class="profilepic">
                        <img src="/img/tmp_profile.jpg">
                    </div>
                </div>
                <span class="label">Good Team</span>
            </div>
        `;*/
    }
}
