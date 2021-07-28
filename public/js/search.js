function mark(params) {
    let searchKey = window.location.search.match(/(?<=q\=).+&/ig)[0].split("&")[0].toLowerCase();
    console.log(searchKey);
    Array.from(document.querySelectorAll(".card")).forEach(function (elem) {
        elem.querySelector("a").innerHTML = elem.querySelector("a").innerText.split(" ").map(function (elem) {
            console.log(elem.toLowerCase() == searchKey);
            if (elem.toLowerCase() == searchKey || elem.toLowerCase().includes(searchKey)) {
                if (elem.toLowerCase() == searchKey) {
                    console.log(elem);
                    return `<span style='background:yellow;'>${elem}</span>`;
                } else {
                    return markHelper(elem, searchKey);
                }
            }
            else
                return elem;

        }).join(" ");
    });

    function markHelper(text, word) {
        var acc = [];
        var arr = text.split(" ");
        arr.forEach((elem) => {
            if (elem.toLowerCase().includes(word)) {
                // 		acc.push(`<span style='background:yellow'>${elem}</span>`);
                var s = elem.toLowerCase().indexOf(word);
                var e = word.length;
                var butter = elem.substring(0, s) + `<span style='background:#ffc1079e;'>${word}</span>` + elem.substring(s + e);
                acc.push(butter);
            } else {
                acc.push(elem);
            }
        });
        return acc.join(" ");
    }
} mark();

function selectGenre() {
    // let genre = window.location.search.match(/(?<=type\=).+&?/ig)[0];
    // switch (genre) {
    //     case "title":
    //         document.querySelector("option[value='title']").selected = true;
    //         break;
    //     case "genre":
    //         document.querySelector("option[value='genre']").selected = true;
    //     case "any":
    //         document.querySelector("option[value='any']").selected = true;
    //     default:
    //         break;
    // }
}

window.onload = function(){
    this.selectGenre();
}


//
