window.onload = function (){
    let comments = document.querySelectorAll(".comment-side");
    comments.forEach( c => {
        if ( c.innerText.length > 600 ) {
            c.dataset.content = c.innerText;
            c.innerHTML = c.innerText.substr(0, 550) + "<span style='cursor:pointer' class='text-primary' onclick='expandComment(this.parentElement)'>...More</span>";
        } else {

        }
    });
    highlightComment();
    // document.querySelector(".loading-overlay").classList.add("hide");

}


function expandComment(comment) {
    console.log(comment);
    comment.innerHTML = comment.dataset.content;
    comment.style.maxHeight = "unset";
}


function highlightComment() {
    let cid;
    if( cid = window.location.href.match(/(?<=cid\=)\d+/i)) {
        cid = cid[0];
    }
    else {
        return;
    }
    let comments = [...document.querySelectorAll(".comment")];
    comments.forEach(comment => {
        comment = comment.parentElement;
        var comment_id = comment.dataset.id ? comment.dataset.id : "";
        console.log(comment_id);

        if (cid == comment_id) {
            var toScroll = parseInt(document.querySelector(".comment-section").offsetTop + comment.offsetTop) - window.pageYOffset - 100;
            console.log(toScroll);
            window.scrollBy(0, toScroll);
            comment.classList.add("commenthighlightAnimation");
        }
    });
}


function shoot() {
    let commentBox = document.querySelector("#commentBox");
    let comment = commentBox.value;
    if ( !comment.length ) {
        return;
    }
    document.querySelector(".commentor-box").classList.add("commentor-box-overlay");
    let _token = document.querySelector("input[name='_token']").value;
    let video_id = document.querySelector("#my-video").dataset.id;
    let data = new FormData();
    data.append(
        "_token",
        _token
    );
    data.append(
        "content",
        comment
    );
    data.append(
        "video_id",
        video_id
    );
    fetch("/comment/create",{
        "method" : "POST",
        "body" : data
    })
    .then( r => r.text())
    .then( r => {
        let commentTemplate = `
                                <div class="card" data-id="">
                                    <div class="card-body p-2 py-4 rounded comment" style="font-size: 14px; line-height:17px;">
                                        <div class="row m-0 p-0">
                                            <div class="col-lg-9 border rounded m-0 p-2 shadow comment-side ">
                                                ${comment}
                                            </div>
                                            <div class="col-lg-3 m-0 p-0 text-center commentor-side">
                                                <img src="${document.querySelector(".profile-pic").src}" class="img img-round rounded shadow d-inline-block" alt="..." style="border-radius: 50%;width: 50px;height: 50px;">
                                                    <div class="caption w-100" style="max-height:20px;overflow:hidden">${document.querySelector(".profile-btn").innerText}</div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>`;


        let dp = new DOMParser();
        let node = dp.parseFromString(commentTemplate, "text/html").querySelector(".card");
        document.querySelector(".comment-list").prepend(node);
        commentBox.value = "";
        document.querySelector(".commentor-box").classList.remove("commentor-box-overlay");
        let commentCount = document.querySelector(".comment-count");
        commentCount.classList.add("commented");
        setTimeout(() => {
            commentCount.classList.remove("commented");
            commentCount.innerText = parseInt(commentCount.dataset.count) + 1;
            commentCount.dataset.count = parseInt(commentCount.dataset.count) + 1;
        }, 1500);
    })
}



function savevideo(vid, saveButton ) {
    // let saveButton = document.querySelector(".saveButton");
    let _token = document.querySelector("input[name='_token']").value;
    let fd = new FormData();
    fd.append(
        "_token",
        _token
    );
    fd.append(
        "vid",
        vid
    );

    // if it is already saved
    if ( saveButton.classList.contains("saved") ) {
        fetch("/favorite/remove", {
            "method": "POST",
            "body": fd
        })
        .then( r => r.text())
        .then( r => {
            saveButton.classList.remove("saved");
        });

        return;
    }

    // if not saved
    fetch("/favorite/save",{
        "method" : "POST",
        "body" : fd
    })
    .then( r => r.text())
    .then( r => {
        saveButton.classList.add("saved");
    });
}


function likeVideo(vid, likeButton) {
    document.querySelector(".like-box").classList.add("general-box");
    let url = `/play/like`;
    let _token = document.querySelector("input[name='_token']").value;
    let fd = new FormData();
    fd.append(
        "_token",
        _token
    );
    fd.append(
        "vid",
        vid
    );
    fetch(url,{
        "method" : "post",
        "body" : fd
    })
    .then( r=> r.text())
    .then( r=> {
        console.log(r);
        if (disliked = document.querySelector(".disliked")) {
            disliked.classList.remove("disliked");
        }
        if ( r == "unliked" ) {
            likeButton.classList.remove("liked");
        } else {
            likeButton.classList.add("liked");
        }
    });
}

function dislikeVideo(vid, dislikeButton) {
    document.querySelector(".like-box").classList.add("general-box");
    let url = `/play/dislike`;
    let _token = document.querySelector("input[name='_token']").value;
    let fd = new FormData();
    fd.append(
        "_token",
        _token
    );
    fd.append(
        "vid",
        vid
    );
    fetch(url, {
        "method": "post",
        "body": fd
    })
    .then(r => r.text())
    .then(r => {
        if (liked = document.querySelector(".liked")) {
            liked.classList.remove("liked");
        }
        if ( r == "undisliked" ) {
            dislikeButton.classList.remove("disliked");
        } else {
            dislikeButton.classList.add("disliked");
        }
    });
}



//

