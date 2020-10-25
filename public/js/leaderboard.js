//fetch som hämtar json med lista av allting som ska visas i home, end ska kunna inkrementeras


function test() {

    fetch ('/ajax/get_leaderboard.php/?s=0&e=5').then((res)=> res.json()) 
    .then(json => console.log(json)).then('/ajax/build_leaderboard.php')
}

