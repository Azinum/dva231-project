//fetch som hämtar json med lista av allting som ska visas i home, end ska kunna inkrementeras
const defaultProfile = "/img/default_profile_image.svg";
let start = 0;
let length = 7;

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
var i = start +1;
var loading = false;

async function test() {
    if (!loading) {
        document.querySelector(".load-icon").style.display = "block";
        loading = true;
        fetch('/ajax/get_leaderboard.php/?s='+start).then((res) => res.json()) 
        .then(json => {
            //console.log(json);
            if (json) {
                json.forEach((item) => { //item ska bli skapelsen av ett item.... Gör en array av json värden, sedan skicka in dem i build leaderboard?
                    document.getElementById("back-box").innerHTML += `
                        <div class="flex-row"> 
                            <div class="profile-box ui-box shadow" onclick="click_team('`+esquot(item.disp_name)+`');">
                                <div class="profile">
                                    <div class="rank"> `+i+`. </div>
                                    <div class="profilepic profilepic-small"> <img src="`+ equot(!item.img_url ? defaultProfile : item.img_url) +`"> </div>
                                </div>
                                <span class="label">`+escapeHtml(item.disp_name)+`</span>
                                <div class="stats stats-short">
                                    <span> P:`+item.stats.part+` </span>
                                    <span> W:`+item.stats.won+` </span>
                                    <span> L:`+item.stats.lost+` </span>
                                    <span> E: `+ item.rank +`</span>
                                </div>
                            </div>
                        </div>
                    `;
                    i++;
                });
            }
            document.querySelector(".load-icon").style.display = "none";
            loading = false;
        });
        start += length;
    }
}

var isInLoadZone = false;
function scrollHandler(e) {
    if ((window.innerHeight + window.pageYOffset) >= document.getElementById("back-box").offsetHeight) {
    }
	let bottom = document.getElementById("back-box").getBoundingClientRect().bottom;
	let height = document.documentElement.clientHeight;
    //alert("btm:"+(bottom - height*0.15)+"\nhgt:"+height);

	if (bottom - height*0.15 < height) {
		if (!isInLoadZone) {
			test();
			isInLoadZone = true;
		}
	} else {
		isInLoadZone = false;
	}
}

//window.addEventListener("scroll", scrollHandler);
//document.addEventListener("touchend", scrollHandler);
