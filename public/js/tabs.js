function trigger_tab(tabbutton, tabname) {
    //Disable all tags
    //TODO: just fucking add ".active" to the query selector you dumbass
    document.querySelectorAll(".tablayout .tabcontents .tabcontent").forEach(function(content){
        content.classList.remove("active");
    });

    document.querySelectorAll(".tablayout .tabs .tab").forEach(function(content){
        content.classList.remove("active");
    });

    //Enable tabname
    document.querySelector(".tablayout .tabcontents .tabcontent#"+tabname).classList.add("active");
    tabbutton.classList.add("active");

    if (typeof update_shadows === "function") {
        update_shadows();
    }
}
