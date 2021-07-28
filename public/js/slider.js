let rightNavs = document.querySelectorAll(".right-nav");
let leftNavs = document.querySelectorAll(".left-nav");

rightNavs.forEach(rightNav => {
    rightNav.addEventListener("click", goRight);
});
leftNavs.forEach(leftNav => {
    leftNav.addEventListener("click", goLeft);
});

function setPosForItems(params) {
    [...document.querySelectorAll(".slider-container")].forEach(cont => {
        let items = [...cont.querySelectorAll(".item")];
        if (items.length > 4) {
            items.forEach((item, i) => {
                item.style.left = `${(i * 200) + (25 * (i + 1))}px`;
            });
        } else {
            items.forEach((item, i) => {
                item.style.position = `relative`;
            });
            cont.style.display = `flex`;
            cont.style.justifyContent = `space-around`;
            cont.querySelector(".right-nav").style.display = `none`;
            cont.querySelector(".left-nav").style.display = `none`;
        }
    });
}

window.onload = function () {
    setPosForItems();
}


function goRight(node) {
    let container = (this === window ? node : this).parentElement;
    console.log(this);
    let items = [...container.querySelectorAll(".item")];


    items.forEach((item, i) => {
        // let leftLen = item.dataset.left ? item.dataset.left : 0;
        item.style.left = `${parseInt(item.style.left) - item.clientWidth - 30}px`;
    });
    setTimeout(() => {
        let firstElement = items[0]; firstElement.remove();
        // console.log(firstElement.clientWidth);
        firstElement.style.left = `${parseInt(items[items.length - 1].style.left) + items[2].clientWidth + 30}px`;
        container.querySelector(".item-holder").append(firstElement);
    }, 500);

}

function goLeft(node) {
    let container = (this === window ? node : this).parentElement;
    let items = [...container.querySelectorAll(".item")];


    items.forEach((item, i) => {
        // let leftLen = item.dataset.left ? item.dataset.left : 0;
        item.style.left = `${parseInt(item.style.left) + item.clientWidth + 30}px`;
    });
    setTimeout(() => {
        let lastElement = items[items.length - 1]; lastElement.remove();
        // console.log(firstElement.clientWidth);
        lastElement.style.left = `${parseInt(items[0].style.left) - items[2].clientWidth - 30}px`;
        container.querySelector(".item-holder").prepend(lastElement);
    }, 500);
}
