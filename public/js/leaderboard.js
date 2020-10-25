//fetch som hämtar json med lista av allting som ska visas i home, end ska kunna inkrementeras


function test() {
    let start = 0;
    let end = 5;
    fetch('/ajax/get_leaderboard.php/?s='+start+'&e='+end).then((res) => res.json()) 
    .then(json => {
        console.log(json);
        var arr = [];
        var it = 0;
        json.forEach((item) => { //item ska bli skapelsen av ett item.... Gör en array av json värden, sedan skicka in dem i build leaderboard?
             arr[it] = item;
             it++;
        });
        JSON.stringify(arr);
        document.getElementById("back-box").innerHTML += '<?php $array=json_decode($_POST["jsondata"]);  build_leaderboard($link,$array); ?>';
    });

    //.then('/ajax/build_leaderboard.php')
}
