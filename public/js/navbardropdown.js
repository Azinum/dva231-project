var show = false;
function toggleDropDown(){
	var dropdown = document.getElementById("dropdowncontentid");
    if (show) {
        dropdown.classList.remove("active");
    } else {
        dropdown.classList.add("active");
    }
    show = !show;
}

var showNav = false;
function toggleMobileNavbar(){
	var navbar = document.querySelector(".navbar");
    if (show) {
        navbar.classList.remove("active");
    } else {
        navbar.classList.add("active");
    }
    show = !show;
}
