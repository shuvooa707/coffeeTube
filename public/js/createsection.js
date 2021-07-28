const searchresultpane = document.querySelector(".search-result");
const selectedVideos = document.querySelector(".seleted-video-list");
const searchField = document.querySelector(".search-field");
let selectedVideosObject = [];




function find( key ) {
    if ( key.trim().length < 1 ) {
        searchresultpane.classList.add("hide");
        searchresultpane.innerHTML = "";
        return;
    }
    const token = document.querySelector("input[name='_token']").value;
    const ajax = new XMLHttpRequest();
    const have = [...document.querySelectorAll(".selected")].map( e => {
        return e.dataset.id;
    });
    ajax.open("GET",`/findvideoajax?key=${key}&_token=${token}&have=${JSON.stringify(have)}`);

    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            const videos = JSON.parse(ajax.responseText);
            console.log(videos);
            searchresultpane.innerHTML = videos.reduce((acc, v) => {
                return acc + `<div class='found-video' onclick="select(this)" data-id="${v.id}" data-genre="${v.genre}" data-director="${v.director}" data-rating="${v.rating}">
                            ${v.title}
                      </div>`;
            }, "");
            searchresultpane.classList.remove("hide");
        }
    }
    ajax.send();
}

function select( video ) {
    console.log("comes here");
    let videos = document.querySelector("input[name='videos']");
    newVideos = JSON.parse(videos.value);
    newVideos.push(video.dataset.id);
    console.log(newVideos);

    videos.value = JSON.stringify(newVideos);
    var v = `<div class='selected' data-id="${video.dataset.id}">
                <div class="row m-0 p-0">
                    <div class="col-lg-1 px-0">
                        <span class="badge badge-secondary text-white">${selectedVideosObject.length + 1}</span>
                    </div>
                    <div class="col-lg-3  pl-0">
                        ${video.innerText}
                    </div>

                    <div class="col-lg-2  px-0">
                        ${video.dataset.genre}
                    </div>

                    <div class="col-lg-2  px-0">
                        ${video.dataset.length}
                    </div>

                    <div class="col-lg-2  px-0">
                        ${video.dataset.producer}
                    </div>

                    <div class="col-lg-1  px-0">
                        ${video.dataset.rating}
                    </div>
                    <div class="col-lg-1  px-0">
                        <a href="${document.location.origin +"/dashboard/edit/"+ video.dataset.id}" targer="_blank">
                            <i class='fas fa-pen text-dark' style='posistion:absolute;right:15px;'></i>
                        </a>
                        <i class='fas fa-trash mx-3 text-danger' style='posistion:absolute;right:15px;' onclick="unselect(this.parentElement.parentElement.parentElement, ${video.dataset.id})"></i>
                    </div>
                </div>
            </div>`;
    var dp = (new DOMParser()).parseFromString(v, "text/html").querySelector(".selected");
    console.log(dp);

    searchField.value = "";
    searchresultpane.classList.add("hide");
    searchresultpane.innerHTML = "";
    selectedVideos.appendChild(dp);

    selectedVideosObject.push(dp);
}


function unselect(video, id) {
    var v = selectedVideosObject.findIndex(function(e,i){
        if (e.dataset.id == id) {
            return true;
        }
    });
    delete selectedVideosObject[v];
    selectedVideosObject = selectedVideosObject.filter(e=>{
        return e? true : false;
    });
    video.remove();
}


// searchField.addEventListener("blur",function(e){
//     searchField.value = "";
//     searchresultpane.classList.add("hide");
// });


//
