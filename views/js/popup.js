var popup = document.getElementsByClassName("popup")[0];
var main = document.getElementsByTagName("main")[0];
var btn = document.getElementById("closeButton");
var body = document.getElementsByTagName("body")[0];

btn.addEventListener('click', function(){
    popup.style.display = "none";
    main.style.filter = "none";
    main.style.pointerEvents = "auto";
    body.style.overflow = "scroll";
});

window.addEventListener('load', function(){
    document.getElementsByTagName("form")[0].action = "";
});

