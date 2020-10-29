const defaultProfile = "/img/default_profile_image.svg";

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

function kickUser(elem, id, team) {
    if (confirm("Are you sure you want to leave this team?")) {
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
function submitUserImage(input, id) {
    if (input.files && input.files[0]) {
        if (input.files[0].size/1024/1024 < 3) {
            let data = new FormData();
            data.append('image', input.files[0]);
            data.append('id', id);
            return fetch("/ajax/user_set_img.php", {
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

async function submitUserInfo(form, id) {
    let result = await submitUserImage(form.querySelector("#profile-pic"), id);
    if (result[1]) {
        if (result[0]) {
            form.querySelector(".profilepic img").src = form.querySelector("#profile-pic-preview").src;
            form.querySelector("#profile-pic-preview").src = "#";
        }
        if (form.querySelector("#display-name").value.length < 3) {
            form.querySelector("#display-name").classList.add("error");
        } else {
            form.querySelector("#display-name").classList.remove("error");
            fetch("/ajax/modify_user_profile.php?" + new URLSearchParams({
                "id": id,
                "name": form.querySelector("#display-name").value,
                "bio": form.querySelector("#bio").value
            })).then((response) => {
                if (response.status == 200) {
                    alert("Updated profile");
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
    } else {
        //TODO: ret. error messages from team_set_image and parse them here. not a prio atm
        alert("An unexpected error occured when uploading the image!\nDid you upload a corrupted image?");
    }
}

// again, TODO: ugly af
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
            return [false, false];
        }
    } else {
        return [false, true];    // No failure, since we didn't even have to upload.
    }
}

function addTeam(form) {
    if (form.querySelector("#newteam-name").value.length < 3) {
        form.querySelector("#newteam-name").classList.add("error");
    } else {
        form.querySelector("#newteam-name").classList.remove("error");
        fetch("/ajax/register_team.php?" + new URLSearchParams({
            "name": form.querySelector("#newteam-name").value,
            "bio": form.querySelector("#newteam-bio").value
        })).then(async (response) => {
            if (response.status == 200) {
                let result = await submitTeamImage(form.querySelector("#newteam-img"), form.querySelector("#newteam-name").value);
                if (!result[1]) {
                    alert("Team added, but image upload failed!");
                } else {
                    alert("Added team");
                }
            } else {
                response.json().then((json) => {
                    if (json.status == "name in use") {
                        alert("The name \""+form.querySelector("#newteam-name").value+"\" is already in use!");
                    } else {
                        alert("An unexpected error occured! Please try again later.");
                    }
                });
            }
        });
    }
}
