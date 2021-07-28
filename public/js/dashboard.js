// [...document.querySelectorAll(".dashboard-menu ul li")].forEach( li => {
//     li.addEventListener("click",function(e){
//         var tabName = e.target.dataset.tabname;
//         document.querySelector(".dactive").classList.remove("dactive");
//         this.classList.add("dactive");

//         var showing = document.querySelector("main .show");
//         showing.classList.remove("show");
//         showing.classList.forEach( e => {
//             if(e.includes("ani")) {
//                 showing.classList.remove(e);
//             }
//         });
//         var toSelect = document.querySelector(`.${tabName}`);
//         toSelect.classList.add(`ani-3`);
//         toSelect.classList.add("show");
//     });
// });




// window.onload = function () {
//     document.querySelectorAll(".menu-container").forEach( e=>{
//         var icons = e.querySelectorAll(".icon");
//         icons.forEach((icon, i) => {
//             icon.style.transform = `rotate(${i * 45}deg)`;
//             icon.querySelector(".inside").style.transform = `rotate(-${i * 45}deg)`;
//         });
//     });

// }

// document.querySelectorAll(".tool-ham-icon").forEach( e => e.addEventListener("click", function () {
//         console.log(window.event.target);
//         this.nextElementSibling.style.display = "block";
//         document.querySelectorAll(".tool-ham-icon").forEach(e => {
//             e.classList.toggle("dNone");
//         });
//     })
// );
// //

// document.querySelectorAll(".tool-circle-close-icon").forEach(e => e.addEventListener("click", function () {
//     this.parentElement.style.display = "none";
//     document.querySelectorAll(".tool-ham-icon").forEach(e => {
//         e.classList.toggle("dNone");
//     });
// }));

// function deleteVideo( where ) {
//     window.location = `${where}`;
// }
