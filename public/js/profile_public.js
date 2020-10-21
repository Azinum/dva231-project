function teambox_selected(element, teamname) {
    document.querySelectorAll(".profile-box.active").forEach(function(teambox) {
        teambox.classList.remove("active");
    });
    if (element !== null) {
        element.classList.add("active");
    }
}

function team_dropdown(elem) {
    if (elem.selectedOptions[0].innerHTML == "All") {
        teambox_selected(null, "");
    }
}
