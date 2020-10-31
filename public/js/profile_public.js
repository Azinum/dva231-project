function smite_victim_team(victim) {
    if (confirm("Squash "+victim+" with banhammer?")) {
        fetch("/ajax/set_ban_team.php?" + new URLSearchParams({
            "team": victim
        })).then((response) => {
            if (response.status == 200) {
                alert("Team smacked with heavy banhammer");
                window.location.replace("/home.php");
            } else {
                alert("Evaded!");
            }
        });
    }
}

function smite_victim_user(victim) {
    fetch("/ajax/set_ban_user.php?" + new URLSearchParams({
        "id": victim
    })).then((response) => {
        if (response.status == 200) {
            alert("User smacked with heavy banhammer");
            window.location.replace("/home.php");
        } else {
            alert("User evades nimbly!");
        }
    });
}
