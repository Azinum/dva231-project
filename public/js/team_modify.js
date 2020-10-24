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
                            <div class="profile-box ui-box shadow" data-user-id="`+ selection.user_id +`">
                                <div class="profile">
                                    <div class="profilepic">
                                        <img src="`+ escapeHtml(selection.img) +`">
                                    </div>
                                </div>
                                <span class="label">`+ escapeHtml(selection.name) +`</span>
                                <div class="button button-accept" onclick="makeLeader(this.parentElement, `+ selection.user_id +`, '`+ escapeHtml(team) +`');">
                                    Make Leader
                                </div>
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
    if (confirm("Are you sure you want to kick this person?")) {
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
}

function makeLeader(elem, id, team) {
    if (confirm("Are you sure you want to make this person the team leader?\nYou will be redirected to the team page and lose access to this page!")) {
        fetch("/ajax/set_team_leader.php?" +  new URLSearchParams({"team": team, "user_id":id}))
            .then((response) => {
                if (response.status == 200) {
                    let leaderElem = document.querySelector(".leader");
                    leaderElem.innerHTML += `
                        <div class="button button-accept" onclick="makeLeader(this.parentElement, `+ leaderElem.dataset.userId +`, '`+ team +`');">Make Leader</div>
                        <div class="button button-deny" onclick="kickUser(this.parentElement, `+ leaderElem.dataset.userId + `, '`+ team +`');">Kick</div>
                    `;
                    leaderElem.classList.remove("leader");
                    elem.classList.add("leader");
                    elem.querySelectorAll(".button").forEach((elem) => {elem.remove()});
                } else {
                    // Again, shouldn't be possible to get here unless an error occured somewhere else
                    alert("Couldn't set user as leader!");
                }
            });
    }
}

function previewImage(input, img) {
    if (input.files && input.files[0]) {
        if (input.files[0].size/1024/1024 > 3) {
            img.src="";
            img.alt="Selected image exceeds max size (3MB)";
        } else {
            let reader = new FileReader();
            reader.addEventListener("load", (e) => {
                img.src = e.target.result;
            });
            reader.readAsDataURL(input.files[0]);
        }
    }
}

function submitTeamImage(input, team) {
    if (input.files && input.files[0]) {
        if (input.files[0].size/1024/1024 < 3) {
            let data = new FormData();
            data.append('image', input.files[0]);
            data.append('team', team);
            fetch("/ajax/team_set_img.php", {
                method: "POST",
                body: data
            }).then((response) => {
                console.log(response);
            });
        } else {
            alert("Image size is too large! (Max. 3MB)");
        }
    }
}

function submitTeamInfo(form, team) {
    if (form.querySelector("#display-name").value.length < 3) {
        form.querySelector("#display-name").classList.add("error");
    } else {
        form.querySelector("#display-name").classList.remove("error");
        fetch("/ajax/modify_team_profile.php?" + new URLSearchParams({
            "team": team,
            "name": form.querySelector("#display-name").value,
            "bio": form.querySelector("#bio").value
        })).then((response) => {
            if (response.status == 200) {
                alert("Updated team info");
            } else {
                response.json().then((json) => {
                    if (json.status == "name in use") {
                        alert("The name \""+form.querySelector("#display-name").value+"\" is already in use!");
                    } else {
                        alert("An unexpected error occured! Please try again later.");
                    }
                });
            }
        });
    }
}
