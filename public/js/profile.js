// grab the pic
let propic = document.querySelector(".propic");
let picshow = document.querySelector(".picshow");

propic.addEventListener("click",function(){
    picshow.classList.remove("hide");
    window.addEventListener("keydown",hidePic);
});

document.querySelector(".picshow > .fa-window-close").addEventListener("click",function(){
    picshow.classList.add("hide");
});


function hidePic(event) {
    console.log(event);
    
    if (window.event.key == "Escape") {
        picshow.classList.add("hide");
        window.removeEventListener("keydown", hidePic);
    }
}






//
