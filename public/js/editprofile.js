

document.querySelector("#profilepic").addEventListener("input", previewThumbnail);

function previewThumbnail() {
    if (!this.files[0]) return;
    if (oldimg = document.querySelector("img")) {
        oldimg.remove();
    }
    var img = document.createElement("img");
    img.setAttribute("style", "cursor:pointer;height:240px; outline:none;");
    img.setAttribute("title", "Click To Change");
    img.setAttribute("class", "w-100 rounded shadow");
    img.src = URL.createObjectURL(this.files[0]);
    img.addEventListener("click", function () {
        document.querySelector("#profilepic").click();
    });
    var thum = document.querySelector(".propic");
    thum.appendChild(img);
    document.querySelector(".finput").classList.add("hide");
}
