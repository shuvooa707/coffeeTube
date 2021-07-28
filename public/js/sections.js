String.prototype.todom = function () {
    let dp = new DOMParser();
    dp = dp.parseFromString(this, "text/html");
    return dp.querySelector("body").querySelector("*");
};

function lock( sid, locked, node ) {

    let ajax = new XMLHttpRequest();
    ajax.open("GET",`sections/locksection/${sid}`, false);
    ajax.send();

    if ( ajax.responseText == "locked" ) {
            node.querySelector("i").classList.remove("fa-eye-slash");
            node.querySelector("i").classList.add("fa-eye");
            node.dataset.locked = 1;
            node.classList.add("border-success");
            node.classList.remove("border-danger");
    } else {
        node.querySelector("i").classList.remove("fa-eye");
        node.querySelector("i").classList.add("fa-eye-slash");
        node.dataset.locked = 0;
        node.classList.remove("border-success");
    }

}



function deleteMarked(){
    let sections = [...document.querySelectorAll(".marker")]
                   .slice(1)
                   .filter(s => s.children[0].checked )
                   .map(s => parseInt(s.parentElement.dataset.id) )

    sections = JSON.stringify(sections);
    sections = sections.split("").slice(1);
    sections.pop();
    sections = "(" + sections.join("") + ")"
    let data = new FormData();
    data.append(
        "_token",
        document.querySelector("input[name='_token']").value
    );
    data.append(
        "sections",
        sections
    );
    fetch("/section/delete/multiple", {
        "method" : "POST",
        "body" : data
    })
    .then( r => r.text() )
    .then( r => console.log(r) )

}

function showMarker() {
    document.querySelectorAll(".marker").forEach( e => e.style.display = "unset");
}


function selectAll(node) {
    console.log(node.checked);
    if(node.checked){
        document.querySelectorAll(".marker").forEach(e => e.children[0].checked = true );
        document.querySelector(".delete-button").classList.remove("hide");
    }
    else{
        document.querySelectorAll(".marker").forEach(e => e.children[0].checked = false );
        document.querySelector(".delete-button").classList.add("hide");
    }


}

document.querySelector(".videos-tag").addEventListener("click",sortBy);

// document.querySelector(".position-tag").addEventListener("click", sortBy, ".position");

function sortBy() {
    if ( !window.trs ) {
        window.trs = [...document.querySelectorAll("table tbody tr")];
        trs.sort((a, b) => {
            a = a.querySelector(".video-count").dataset.id;
            b = b.querySelector(".video-count").dataset.id;
            return b - a;
        });
    }

    let tbody = document.querySelector("table tbody");
    tbody.innerHTML = "";
    trs.reverse().forEach(tr => {
        tbody.appendChild(tr);
    });

}

function changeOrder(node, sid) {
    node.querySelector(".section-order").classList.add("hide");
    node.querySelector(".change-order").classList.remove("hide");
    node.querySelector(".change-order-save").classList.remove("hide");
}
function changeOrderSave(node, sid) {
    let data = new FormData();
    let newOrder = node.querySelector(".change-order").value;
    let _token = document.querySelector("input[name='_token']").value
    // let sid = document.querySelector("input[name='_token']").dataset.sid;
    let newpos = node.querySelector(".change-order").value;
    data.append(
        "_token",
        _token
    );
    data.append(
        "sid",
        sid
    );
    data.append(
        "newpos",
        newpos
    );
    fetch(window.location.origin + "/dashboard/sections/order",{
        "method" : "post",
        "body" : data
    })
    .then( r => r.text() )
    .then( r => {
        console.log(r);
    })
}



//
