document.getElementById("magnifier").addEventListener("click", function() {
    document.body.style.overflow = "hidden";
    document.getElementById("menu").style.filter = "blur(80px)";
    document.getElementById("main").style.filter = "blur(80px)";
    document.getElementById("search").style.visibility = 'visible';
    document.getElementById("search").style.pointerEvents = "auto";
    document.getElementById("main").style.pointerEvents = "none";
    document.getElementById("menu").style.pointerEvents = "none";
    document.getElementById("main").style.zIndex = "1";
    document.getElementById("search").style.zIndex = "15";
    document.getElementById("search_input").focus();
 });

 document.getElementById("search_x").addEventListener("click", function() {
    document.body.style.overflow = "";
    document.getElementById("menu").style.filter = "";
    document.getElementById("main").style.filter = "";
    document.getElementById("search").style.visibility = 'hidden';
    document.getElementById("main").style.pointerEvents = "auto";
    document.getElementById("menu").style.pointerEvents = "auto";
    document.getElementById("search").style.pointerEvents = "none";
    document.getElementById("search").style.zIndex = "1";
 });