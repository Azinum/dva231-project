function trigger_tab(tabbutton, tabname) {
    //Disable all tags
    document.querySelector(".tablayout .tabcontents .tabcontent.active").classList.remove("active");
    document.querySelector(".tablayout .tabs .tab.active").classList.remove("active");

    //Enable tabname
    document.querySelector(".tablayout .tabcontents .tabcontent#"+tabname).classList.add("active");
    tabbutton.classList.add("active");

    if (typeof update_shadows === "function") {
        update_shadows();
    }
}
