var searchoverlay = false;
const topics = {
    player: 0,
    team: 1
};

var teams = {
    {},
    {}
};

function select_player(elem) {
    do_search(topics.player, (e) => {
        elem.innerHTML = e.detail.name + "<img src="+e.detail.img_url+">";
        //Pseudo team-add tjofräs
        //teams[team_index] += {e.detail.name, e.detail.img_url};
    });
}

function do_search(topic, callback) {
    if (topic == topics.player) {
        searchoverlay_toggle();
        document.addEventListener("search_done", callback);
    } else if (topic == topics.team) {
    }
}

function result_click(img_url, name) {
    searchoverlay_toggle();
    document.dispatchEvent(
        new CustomEvent(
            "search_done",
            {
                bubbles: true,
                detail: {
                    img_url: img_url,
                    name: name
                }
            }
        )
    );
}

function searchoverlay_toggle() {
    searchoverlay = !searchoverlay;

    if (searchoverlay) {
        document.querySelector(".searchoverlay").classList.add("active");
    } else {
        document.querySelector(".searchoverlay").classList.remove("active");
    }
}

function searchoverlay_update() {   // just smack in some test results for now
    document.querySelector(".searchoverlay .results").innerHTML += `
        <div class="profile-box ui-box shadow" onclick="result_click('/img/tmp_profile.jpg', 'Good Team');">
            <div class="profile">
                <div class="profilepic">
                    <img src="/img/tmp_profile.jpg">
                </div>
            </div>
            <span class="label">Good Team</span>
        </div>
    `;
}
