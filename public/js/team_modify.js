const defaultProfile = "/img/default_profile_image.svg";
var teamMembers = [];

//https://stackoverflow.com/a/4835406
function escapeHtml(text) {
 	var map = {
    	'&': '&amp;',
    	'<': '&lt;',
    	'>': '&gt;',
    	'"': '&quot;',
    	"'": '&#039;'
 	};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function selectPlayer(elem, team) {
    fetch("/ajax/get_team_members.php?" + new URLSearchParams({"team": team}))
        .then((response) => response.json())
        .then((json) => {
            teamMembers = [];
            json.forEach((member) => {
                teamMembers.push(member.user_id);
            });
            console.log(teamMembers);
        });

	doSearch(
        (selection) => {
            fetch("/ajax/team_add_member.php?" + new URLSearchParams({"team": team, "user_id": selection.user_id}))
                .then((response) => {
                    if (response.status == 200) {
                        elem.innerHTML += `
                            <div class="profile-box ui-box shadow">
                                <div class="profile">
                                    <div class="profilepic">
                                        <img src="`+ escapeHtml(selection.img) +`">
                                    </div>
                                </div>
                                <span class="label">`+ escapeHtml(selection.name) +`</span>
                                <div class="button button-deny" onclick="kickUser(this.parentElement, `+ selection.user_id +`, '`+ escapeHtml(team) +`');">
                                    Kick
                                </div>
                            </div>
                        `;
                    } else {
                        /* We should never get here! Team members are already filtered out. */
                        alert("Couldn't add the member to the team (Maybe they are already part of it?)");
                    }
                });
	    },
        (searchString) => {
            fetch("/ajax/search_user.php?" + new URLSearchParams({"q": searchString}))
                .then((response) => response.json())
                .then((json) => {
                    document.querySelector(".searchoverlay .results").innerHTML = "";
                    json.forEach((item) => {
                        if (!teamMembers.includes(item.user_id)) {
                            document.querySelector(".searchoverlay .results").innerHTML += `
                                <div class="profile-box ui-box shadow" onclick="onClick({name: '`+ escapeHtml(item.name) +`', user_id: '`+ escapeHtml(item.user_id) +`', img: '` +
                                    escapeHtml(!item.img_url ? defaultProfile : item.img_url)+`'});">
                                    <div class="profile">
                                        <div class="profilepic">
                                            <img src="`+ escapeHtml(!item.img_url ? defaultProfile : item.img_url) +`">
                                        </div>
                                    </div>
                                    <span class="label">`+ escapeHtml(item.name) +`</span>
                                </div>
                            `;
                        }
                    });
                });
        }
    );
}

function kickUser(elem, id, team) {
    fetch("/ajax/kick_team_member.php?" + new URLSearchParams({"team": team, "user_id":id}))
        .then((response) => {
            if (response.status == 200) {
                elem.remove();
            } else {
                /* Don't think it will be possible to get here unless something somewhere else has gone pretty wrong */
                alert("Couldn't kick user!");
            }
        });
}
