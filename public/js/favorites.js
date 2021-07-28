
function remove(vid, video) {
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
    fetch("/favorite/remove", {
        "method": "POST",
        "body": fd
    })
    .then(r => r.text())
    .then(r => {
        console.log(r);
        video.remove();
    });
}


function removeAll( url ) {
    window.event.preventDefault();
    let makeSure = confirm("Are You Sure?");
    if (makeSure) {
        window.location = url;
    }
}


//
