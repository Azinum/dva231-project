function smite_victim_team(victim) {
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
