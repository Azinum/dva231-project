//fetch som hämtar json med lista av allting som ska visas i home, end ska kunna inkrementeras
const defaultProfile = "/img/default_profile_image.svg";
let start = 0;
let length = 5;

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

function test() {

    fetch('/ajax/get_leaderboard.php/?s='+start).then((res) => res.json()) 
    .then(json => {
        //console.log(json);
        json.forEach((item) => { //item ska bli skapelsen av ett item.... Gör en array av json värden, sedan skicka in dem i build leaderboard?
            console.log(item);
            document.getElementById("back-box").innerHTML += `
            <div  class="flex-row">
                <div class="profile-box ui-box shadow">
                    <div class="profile">
                        <div class="rank"> `+item.rank+`. </div>
                        <div class="profilepic profilepic-small"> <img src="`+ escapeHtml(!item.img_url ? defaultProfile : item.img_url) +`"> </div>
                    </div>
                    <span class="label">`+escapeHtml(item.disp_name)+`</span>
                    <div class="stats stats-short">
                        <span> P:`+item.stats.part+` </span>
                        <span> W:`+item.stats.won+` </span>
                        <span> L:`+item.stats.lost+` </span>
                    </div>
                </div>
            </div>
                `;
        });
        
    });
    start += length+1;

    //.then('/ajax/build_leaderboard.php')
}
