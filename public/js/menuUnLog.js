  document.getElementById("log").addEventListener("click", function() {
     document.body.style.overflow = "hidden";
     document.getElementById("menu").style.filter = "blur(80px)";
     document.getElementById("main").style.filter = "blur(80px)";
     document.getElementById("zaloguj").style.visibility = 'visible';
     document.getElementById("zaloguj").style.pointerEvents = "auto";
     document.getElementById("main").style.pointerEvents = "none";
     document.getElementById("menu").style.pointerEvents = "none";
     document.getElementById("main").style.zIndex = "1";
     document.getElementById("zaloguj_center").style.zIndex = "15";
  });

  document.getElementById("zaloguj_x").addEventListener("click", function() {
     document.body.style.overflow = "";
     document.getElementById("menu").style.filter = "";
     document.getElementById("main").style.filter = "";
     document.getElementById("zaloguj").style.visibility = 'hidden';
     document.getElementById("main").style.pointerEvents = "auto";
     document.getElementById("menu").style.pointerEvents = "auto";
     document.getElementById("zaloguj").style.pointerEvents = "none";
     document.getElementById("zaloguj_center").style.zIndex = "1";
  });

   document.getElementById("sign").addEventListener("click", function() {
     document.body.style.overflow = "hidden";
     document.getElementById("menu").style.filter = "blur(80px)";
     document.getElementById("main").style.filter = "blur(80px)";
     document.getElementById("dolacz").style.visibility = 'visible';
     document.getElementById("dolacz").style.pointerEvents = "auto";
     document.getElementById("main").style.pointerEvents = "none";
     document.getElementById("menu").style.pointerEvents = "none";
     document.getElementById("main").style.zIndex = "1";
     document.getElementById("dolacz_center").style.zIndex = "15";
  });

  document.getElementById("dolacz_x").addEventListener("click", function() {
     document.body.style.overflow = "";
     document.getElementById("menu").style.filter = "";
     document.getElementById("main").style.filter = "";
     document.getElementById("dolacz").style.visibility = 'hidden';
     document.getElementById("main").style.pointerEvents = "auto";
     document.getElementById("menu").style.pointerEvents = "auto";
     document.getElementById("dolacz").style.pointerEvents = "none";
     document.getElementById("dolacz_center").style.zIndex = "1";
     document.getElementById("error").innerHTML = "";
  });




