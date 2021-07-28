document.querySelector("#public").onchange = function () {
    if (this.checked) {
        document.querySelector("label[for='public']").innerHTML = `<span class="text-success p-p">Public</span>`;
    } else {
        document.querySelector("label[for='public']").innerHTML = `<span class="text-danger p-p">Private</span>`;
    }
}


document.querySelector(".cancel-button")
                .addEventListener("click",function(){
                    var conf = confirm("Are You Sure?");
                    if (conf) {
                        window.location = "/dashboard";
                    } else {

                    }
                });



document.querySelector("#upload").addEventListener("change", previewVideo);
document.querySelector("#thumbnail").addEventListener("input", previewThumbnail);

function previewVideo() {
    if (this.files[0].type.split("/")[0] != "video"){
        alert("!! Please Enter Correct Video File !!");
        return;
    }

    var video = document.createElement("video");
    video.setAttribute("style","width:320px; height:240px; outline:none;");
    video.setAttribute("controls","");
    video.src = URL.createObjectURL(this.files[0]);
    document.querySelector("[for='upload']").classList.add("hide");
    document.querySelector(".left-side").appendChild(video);
    document.querySelector(".video-title").innerText = `File Name : ${this.files[0].name}`;
    document.querySelector(".video-size").innerHTML = `File Size : ${parseInt(this.files[0].size)} <span class='text-danger'>KB</span>`;
    document.querySelector(".video-format").innerText = `File Fromat : ${this.files[0].type}`;
    document.querySelector(".video-dimention").innerText = `Video Dimention : ${video.videoHeight} x ${video.videoWidth}`;
}


function previewThumbnail() {
    if (!this.files[0]) return;
    if( oldimg = document.querySelector("img") ) {
        oldimg.remove();
    }
    var img = document.createElement("img");
    img.setAttribute("style", "cursor:pointer;width:320px; height:240px; outline:none;");
    img.setAttribute("title", "Click To Change");
    img.src = URL.createObjectURL(this.files[0]);
    img.addEventListener("click", function() {
        document.querySelector("#thumbnail").click();
    });
    var thum = document.querySelector(".thum");
    thum.appendChild(img);
    document.querySelector(".finput").classList.add("hide");
}
