function update_shadows() {
    document.querySelectorAll(".shadowbox").forEach(function(shadowbox) {
        let target = shadowbox.querySelector(":not(.shadow)");
        let shadow = shadowbox.querySelector(".shadow");
        let size = target.getBoundingClientRect();

        shadow.style.width = size.width + "px";
        shadow.style.marginLeft = window.getComputedStyle(target).getPropertyValue("margin-left");
    });
}

window.addEventListener("load", update_shadows);
window.addEventListener("resize", update_shadows);
