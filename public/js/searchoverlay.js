var searchoverlay = false;

var onClickEvent = () => {};
var ajaxFetcher = () => {};

function selectPlayer(elem) {
	doSearch(
        (selection) => {
            elem.innerHTML += `
                <div class="profile-box ui-box shadow" onclick="teambox_selected(this, 'this is a member');">
                    <div class="profile">
                        <div class="profilepic">
                            <img src="`+selection.data.img+`">
                        </div>
                    </div>
                    <span class="label">`+selection.data.name+`</span>
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
                            <h3>`+item.name+`</h3>
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

function onClick(img, name) {
    searchoverlayToggle();
	onClickEvent({
		data: {
			img: img,
			name: name
		}
	});
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
