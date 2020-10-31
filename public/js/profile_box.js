function click_member(id) {
    window.location.href = "/profile_public.php?id="+encodeURIComponent(id);
}

function click_team(name) {
    window.location.href = "/team_public.php?team="+encodeURIComponent(name);
}

function click_match(id) {
    window.location.href = "/match.php?view="+encodeURIComponent(id);
}
