var searchoverlay = false;

const TargetType = {
	TARGET_PLAYER : 0,
	TARGET_TEAM : 1
}

var onClickEvent = () => {};

function selectPlayer(elem) {
	doSearch(TargetType.TARGET_PLAYER, (e) => {
        elem.innerHTML += `
            <div class="profile-box ui-box shadow" onclick="teambox_selected(this, 'this is a member');">
                <div class="profile">
                    <div class="profilepic">
                        <img src="`+e.data.img+`">
                    </div>
                </div>
                <span class="label">`+e.data.name+`</span>
                <div class="button button-deny">
                    Kick
                </div>
            </div>
        `;
	});
}

function doSearch(target, callback) {
    searchoverlayToggle();
	if (target == TargetType.TARGET_PLAYER) {
		onClickEvent = callback;
	} else if (target == TargetType.TARGET_TEAM) {
		onClickEvent = callback;
	}
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

function searchoverlayUpdate() {   // just smack in some test results for now
    document.querySelector(".searchoverlay .results").innerHTML += `
        <div class="profile-box ui-box shadow" onclick="onClick('/img/tmp_profile.jpg', 'Good Team');">
            <div class="profile">
                <div class="profilepic">
                    <img src="/img/tmp_profile.jpg">
                </div>
            </div>
            <span class="label">Good Team</span>
        </div>
    `;
}
