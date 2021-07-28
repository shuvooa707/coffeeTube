

function markAsRead( tr, markButton) {
    let cid = tr.dataset.id;
    fetch(`/dashboard/comments/markCommentAsRead?cid=${cid}`)
    .then( r => r.json())
    .then( r => {
        if ( r.status == "done") {
            tr.classList.remove("unread");
            markButton.classList.add("suckin");
            tr.addEventListener("transitionend", function () {
                markButton.remove();
            });
        } else {
            alert("Something Went Worng Please Try Again");
        }
        });
}

function deleteComment(tr) {
    document.querySelector(".card-body").classList.add("overlay");
    let commentContainer = tr.parentElement;
    let cid = tr.dataset.id;
    let have = [...document.querySelectorAll("tr")].map( tr => tr.dataset.id ).filter( tr => parseInt(tr) && tr != cid);
    fetch(`/dashboard/comments/deleteComment?cid=${cid}&have=[${have}]`)
        .then(r => r.json())
        .then(r => {
            console.log(r);
            if ( r.comment.__proto__ == Array.prototype ) {
                r.comment = r.comment[0];
            }
            if (r.status == "done") {
                tr.classList.add("tilt");
                tr.addEventListener("transitionend", function () {
                    tr.remove();
                });
                setTimeout(() => {
                    let dp = new DOMParser();
                    dp = dp.parseFromString(`
                    <table>
                        <tr class="comment-row ${r.comment.read == "unread" ? "unread" : ""}" data-id="${r.comment.id}">
                            <td>${r.comment.id}</td>
                            <td style="width: 391px!important;">${r.comment.content}</td>
                            <td>
                                ${r.comment.user.name}
                            </td>
                            <td>
                                ${r.comment.created_at}
                            </td>
                            <td>
                                <a href="">
                                    ${r.comment.user.name}
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-sm border-danger rounded" title="Delete the Comment..." onclick="deleteComment(this.parentElement.parentElement, this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="btn btn-sm border-success rounded markAsReadButton ${r.comment.read == "unread" ? "" : "hide"}" title="Mark As Read..." onclick="markAsRead(this.parentElement.parentElement, this)">
                                    <i class="fas fa-check"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                `, 'text/html');
                    console.log(dp.querySelector("tr"));
                    // return;
                    document.querySelector(".card-body").classList.remove("overlay");
                    commentContainer.appendChild(dp.querySelector("tr"));

                }, 0);
            } else {
                alert("Something Went Worng Please Try Again");
            }
        });
}

window.onload = function (params) {
    let tr = [...document.querySelectorAll("tr")].map( tr => tr.dataset.id );
    window.comments = [...tr];
    // document.querySelector(".loading-overlay").classList.add("hide");

}

//
