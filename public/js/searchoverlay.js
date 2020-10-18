var searchoverlay = false;

function searchoverlay_toggle() {
    searchoverlay = !searchoverlay;

    if (searchoverlay) {
        document.querySelector(".searchoverlay").classList.add("active");
        window.setTimeout(function() {
            document.querySelector(".searchoverlay").classList.add("shown");
        }, 5);
        update_shadows();
    } else {
        document.querySelector(".searchoverlay").classList.remove("shown");
        window.setTimeout(function() {
            document.querySelector(".searchoverlay").classList.remove("active");
        }, 5);
    }
}

function searchoverlay_update() {   // just smack in some test results for now
    document.querySelector(".searchoverlay .results").innerHTML += `
        <dir class="shadowbox">
            <div class="teambox shadowparent" onclick="teambox_selected(this, 'Good Team');">
				<div class="profile">
					<div class="profilepic">
						<img src="/img/tmp_profile.jpg">
					</div>
					<span class="label">Good Team</span>
				</div>
			</div>
			<div class="shadow"></div>
        </div>
    `;
}
