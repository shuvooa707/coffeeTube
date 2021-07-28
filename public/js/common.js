
window.addEventListener("load",function () {
    setImageObservers();
    let node = document.querySelector(".loading-overlay");
    node.style.opacity = "0";
    node.classList.add("fadeOut");
    setTimeout(() => {
        node.classList.add("hide");
    }, 1500);


    aniTitle = setInterval(animateTitle, 400);
});



function scrollToTop(node) {
    node.classList.toggle("hide");
    window.scrollTo(0,0);
}

window.addEventListener("scroll", function () {
    if (  !(goToTopButton = document.querySelector("#goToTopButton"))) {
        return;
    }
    if (window.scrollY > 100 ) {
        document.querySelector("#goToTopButton").classList.remove("hide");
    } else {
        document.querySelector("#goToTopButton").classList.add("hide");
    }
});

function setImageObservers() {
    let images = [...document.images];
    images.forEach(img => {
        if (img.dataset.src) {
            let ino = new IntersectionObserver(loadImages);
            ino.observe(img);
        }
    });
}

function loadImages(interObj) {
    interObj = interObj[0];
    if (interObj.isIntersecting) {
        interObj.target.src = interObj.target.dataset.src;
    }
}

// window.addEventListener("load", animateTitle);

let title = document.head.querySelector("title");
let text = `${title.innerText}  `;
animateTitle = function () {
    if (title.innerText.length == text.length) {
        title.innerText = title.innerText[0];
        return;
    }
    let tmp = text.substr(0, title.innerText.length ? (title.innerText.length + 1) : 1);
    //     console.log(tmp);
    title.innerText = `${tmp}`;
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





//
