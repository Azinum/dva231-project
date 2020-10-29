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

equot  = (str) => str.replace(/"/g, '\\"');
esquot = (str) => str.replace(/'/g, "\\'");

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
                                        <img src="`+ equot(selection.img) +`">
                                    </div>
                                </div>
                                <span class="label">`+ escapeHtml(selection.name) +`</span>
                                <div class="button button-accept" onclick="makeLeader(this.parentElement, `+ selection.user_id +`, '`+ esquot(team) +`');">
                                    Make Leader
                                </div>
                                <div class="button button-deny" onclick="kickUser(this.parentElement, `+ selection.user_id +`, '`+ esquot(team) +`');">
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
                                <div class="profile-box ui-box shadow" onclick="onClick({name: '`+ esquot(item.name) +`', user_id: '`+ escapeHtml(item.user_id) +`', img: '` +
                                    esquot(!item.img_url ? defaultProfile : item.img_url)+`'});">
                                    <div class="profile">
                                        <div class="profilepic">
                                            <img src="`+ equot(!item.img_url ? defaultProfile : item.img_url) +`">
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
                        <div class="button button-accept" onclick="makeLeader(this.parentElement, `+ leaderElem.dataset.userId +`, '`+ esquot(team) +`');">Make Leader</div>
                        <div class="button button-deny" onclick="kickUser(this.parentElement, `+ leaderElem.dataset.userId + `, '`+ esquot(team) +`');">Kick</div>
                    `;
                    leaderElem.classList.remove("leader");
                    elem.classList.add("leader");
                    elem.querySelectorAll(".button").forEach((elem) => {elem.remove()});
                    window.location.replace("/team_public.php?team="+team);
                    // NOTE (linus): Will redirect you, even if you are admin... This redirect should prob. be to a second page where we, on the server-side
                    // can check if you are Admin, and in that case redirect you back, and otherwise to team_public. OR, better yet, an ajax req. w/ the session
                    // cookie that returns whether we can stay or not. Not a prio. atm.
                    // Also, even if this redirect is ignored, none of the ajax req. on the page will go thru since we are not leader, so no harm done, you will
                    // just have a broken page
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

// TODO: kinda ugly
// Returns: [ <bool: if img was uploaded>, <bool: if the function exited without error> ]
function submitTeamImage(input, team) {
    if (input.files && input.files[0]) {
        if (input.files[0].size/1024/1024 < 3) {
            let data = new FormData();
            data.append('image', input.files[0]);
            data.append('team', team);
            return fetch("/ajax/team_set_img.php", {
                method: "POST",
                body: data
            }).then((response) => {
                return [true, (response.status == 200)];
            });
        } else {
            alert("Image size is too large! (Max. 3MB)");
            return [false, false];
        }
    } else {
        return [false, true];    // No failure, since we didn't even have to upload.
    }
}

async function submitTeamInfo(form, team) {
    let result = await submitTeamImage(form.querySelector("#profile-pic"), team);
    if (result[1]) {
        if (result[0]) {
            form.querySelector(".profilepic img").src = form.querySelector("#profile-pic-preview").src;
            form.querySelector("#profile-pic-preview").src = "#";
        }
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
                    window.history.pushState("","","/team_modify.php?team="+form.querySelector("#display-name").value);
                    alert("Updated team info");
                } else {
                    response.json().then((json) => {
                        if (json.status == "name in use") {
                            alert("The name \""+form.querySelector("#display-name").value+"\" is already in use!");
                        } else {
                            /*Shouldn't happen unless you have lost the leadership role (which could only happen thru admin intervention) while still on the page*/
                            alert("An unexpected error occured! Please try again later.");
                        }
                    });
                }
            });
        }
    } else {
        //TODO: ret. error messages from team_set_image and parse them here. not a prio atm
        alert("An unexpected error occured when uploading the image!\nDid you upload a corrupted image?");
    }
}
