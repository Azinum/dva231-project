//fetch som hämtar json med lista av allting som ska visas i home, end ska kunna inkrementeras


function test() {
    let start = 0;
    let end = 5;
    fetch('/ajax/get_leaderboard.php/?s='+start+'&e='+end).then((res) => res.json()) 
    .then(json => {
        //console.log(json);
        json.forEach((item) => { //item ska bli skapelsen av ett item.... Gör en array av json värden, sedan skicka in dem i build leaderboard?
            console.log(item);
            document.getElementById("back-box").innerHTML += `
            <div class="profile-box ui-box shadow">
                <div class="profile">
                    <div class="rank"> `+item.rank+`. </div>
                    <div class="profilepic profilepic-small"> <img src="/img/teamimg/TeamName.png"> </div>
                </div>
                <span class="label">Tories</span>
                <div class="stats stats-short">
                    <span> P:4 </span>
                    <span> W:2 </span>
                    <span> L:1 </span>
                </div>
            </div>
            `;
        });
        
    });

    //.then('/ajax/build_leaderboard.php')
}
