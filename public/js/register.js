
document.querySelector("#profileThum").addEventListener("input", previewThumbnail);

function previewThumbnail() {
    if (!this.files[0]) return;
    if (oldimg = document.querySelector("img")) {
        oldimg.remove();
    }
    var img = document.createElement("img");
    img.setAttribute("style", "cursor:pointer;width:320px; height:240px; outline:none;");
    img.setAttribute("title", "Click To Change");
    img.src = URL.createObjectURL(this.files[0]);
    img.addEventListener("click", function () {
        document.querySelector("#profileThum").click();
    });
    if( thum = document.querySelector("[for='profileThum']")) {
        thum.replaceWith(img);
    } else {
        document.querySelector(".thumc").appendChild(img);
    }
}
