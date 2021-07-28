function perPage( count ) {
    console.log(window.location + "perPage=" + count.value);
    // return;
    window.location = window.location.origin + window.location.pathname + "?perPage=" + parseInt(count.value.match(/\d+/i)[0] );
}

window.addEventListener("load", function () {
    let page_links = [...document.querySelectorAll(".pagination > .page-item > .page-link")];
    page_links.forEach( a => {
        a.href = a.href + "&perPage=" + document.querySelector("#howManyPerPage").value;
    });
});



//
