

document.querySelector("#upload").addEventListener("change", previewVideo);

function previewVideo() {
    console.log(this.files[0]);

    var video = document.createElement("video");
    video.setAttribute("style", "width:320px; height:240px; outline:none;");
    video.setAttribute("controls", "");
    video.src = URL.createObjectURL(this.files[0]);
    document.querySelector("[for='upload']").classList.add("hide");
    document.querySelector(".left-side").appendChild(video);
    document.querySelector(".video-title").innerText = `File Name : ${this.files[0].name}`;
    document.querySelector(".video-size").innerHTML = `File Size : ${parseInt(this.files[0].size)} <span class='text-danger'>KB</span>`;
    document.querySelector(".video-format").innerText = `File Fromat : ${this.files[0].type}`;
    document.querySelector(".video-dimention").innerText = `Video Dimention : ${video.videoHeight} x ${video.videoWidth}`;
}



function cancel() {
    what = confirm("Are you Sure?");
    if ( what ) {
        window.location = window.location.origin + "/dashboard";
    }
}



//
