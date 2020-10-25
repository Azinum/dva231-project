//fetch som hämtar json med lista av allting som ska visas i home, end ska kunna inkrementeras


function test() {
    let start = 0;
    let end = 5;
    fetch('/ajax/get_leaderboard.php/?s='+start+'&e='+end).then((res) => res.json()) 
    .then(json => {
        console.log(json);
        json.forEach((item) => {
            document.getElementById("back-box").innerHTML += item;
        });
    });

    //.then('/ajax/build_leaderboard.php')
}
