function click_member(id) {
    window.location.href = "/profile_public.php";
}

function click_team(name) {
    window.location.href = "/team_public.php?team="+encodeURIComponent(name);
}
