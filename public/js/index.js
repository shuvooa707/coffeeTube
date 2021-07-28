

$(document).ready(function () {
    $('.tv-channels-slider').slick({
        // autoplay:true,
        // autoplaySpeed:2000,
        // arrows:true,
        // dots: true,
        infinite: true,
        slidesToShow: 8,
        slidesToScroll: 3,
        prevArrow: $(".prev"),
        nextArrow: $(".next"),
    });

    $('.top-trending-slider').slick({
        // autoplay:true,
        // autoplaySpeed:2000,
        // arrows:true,
        // dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        prevArrow: $(".top-trending-slider-prev"),
        nextArrow: $(".top-trending-slider-next"),
    });

    $('.most-popular-slider').slick({
        // autoplay:true,
        // autoplaySpeed:2000,
        // arrows:true,
        // dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        prevArrow: $(".slider-prev"),
        nextArrow: $(".slider-next"),
    });

    $('.slider12-slider').slick({
        // autoplay:true,
        // autoplaySpeed:2000,
        // arrows:true,
        // dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        prevArrow: $(".most-popular-slider-prev"),
        nextArrow: $(".most-popular-slider-next"),
    });


    $("#carouselExampleIndicators").carousel({
        loop : false,
        autoplay: true,
        interval: 3000
    });
});



let IntersectionObservers = [];

attachInoOnLastSection();

function attachInoOnLastSection() {
    let sections = document.querySelectorAll("section");
    let lastSection = sections[sections.length - 1];
    let lastSectionIno = new IntersectionObserver(loadMoreSection);
    IntersectionObservers.push(
        {
            "node" : lastSection,
            "inoObj" : lastSectionIno
        }
    );
    lastSectionIno.observe(lastSection);
}

function loadMoreSection(interObj) {
    if (interObj[0].isIntersecting) {
        IntersectionObservers[0].inoObj.unobserve(IntersectionObservers[0].node);
        console.log(IntersectionObservers.shift());
    } else {
        return;
    }
    document.querySelector(".load-more-section-spinner").classList.remove("hide");
    lastSection = null;
    let ids = [...document.querySelectorAll("section")];
    ids = ids.map( sec => {
        return sec.dataset.sectionId;
    });
    ids = JSON.stringify(ids);
    console.log(ids);

    // load more sections
    fetch(`/dashboard/sections/getmoresections?ids=${ids}&offset=${5}`)
    .then( r => r.json())
    .then( r => {
        console.log(r);
        renderMoreSections(r);
    });
}


function renderMoreSections(sections) {
    document.querySelector(".load-more-section-spinner").classList.add("hide");
    let final = sections.reduce( (acc, section) => {
        let sectionTemplate = `
            <section class="section mt-3" data-section-id="${section.id}">
                <div class="slider-container">
                    <div class="left-nav" onclick="goLeft(this)">
                        <i class="fas fa-angle-left" style=""></i>
                    </div> <div class="item-holder">
                        ${renderVideos(section.videos)}
                    </div>
                    <div class="right-nav" onclick="goRight(this)">
                        <i class="fas fa-angle-right" style=""></i>
                    </div>
                </div>
            </section>
        `;
        if (section.videos.length) {
            return acc + sectionTemplate;
        } else {
            return acc;
        }
    },"");
    function canEdit(sectionId) {
        return `<a href="/dashboard/sections/section/edit/${sectionId}" class="btn p-0" style="position: absolute;right:3px; top:3px;">
            <i class="fas fa-edit"></i>
        </a>`;
    }
    function renderVideos(videos) {
        if(!videos.length) return;
        return videos.reduce( (acc, video, i) => {
            let videosTemplate = `
                <a href="/play/${video.slug}" class="item" style="left:${(i * 200) + (25 * (i + 1))}px">
                    <img src="${video.thumbnail}" width="100%" height="100%" alt="">
                    <div class="item-overlay">
                        <strong class="video-title">${video.title}</strong>
                        <small class="badge border border-success">
                            ${video.genre}
                        </small>
                        <br>
                        <small class="badge border border-danger">
                            ${video.rating}
                            <i class="fas fa-star text-warning"></i>
                        </small>
                        <br>
                        <small class="badge border border-info">
                            ${video.view}
                            <i class="fas fa-eye"></i>
                        </small>
                    </div>
                </a>
            `;
            return acc + videosTemplate;
        },"");
    }

    let dp = new DOMParser();
    let newSections = dp.parseFromString(final, "text/html").querySelectorAll("section");

    newSections.forEach( newSection => {
        document.querySelector(".home-body").appendChild(newSection);
    });

    let lastSection = newSections[newSections.length - 1];
    let lastSectionIno = new IntersectionObserver(loadMoreSection);
    IntersectionObservers.push(
        {
            "node": lastSection,
            "inoObj": lastSectionIno
        }
    );
    lastSectionIno.observe(lastSection);

    console.log(IntersectionObservers[0]);

}


//
