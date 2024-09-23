// function createCategoriesGrid() {
//   const cardData = [
//     {
//       imgSrc: "/assets/imgs/categories/1.png",
//       title: "Sales and Marketing",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/2.png",
//       title: "Quality and Productivity",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/3.png",
//       title: "Leadership",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/5.png",
//       title: "Oil & Gas and Petroleum",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/6.png",
//       title: "Healthcare Management",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/6.png",
//       title: "Project Management",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/1.png",
//       title: "Sales And Marketing",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/2.png",
//       title: "Quality and Productivity",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//     {
//       imgSrc: "/assets/imgs/categories/3.png",
//       title: "Leadership",
//       description:
//         "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing ",
//       link: "/pages/courses.html",
//     },
//   ];

//   const cardContainer2 = document.querySelector(".wrap");

//   cardData.forEach((data) => {
//     const card = document.createElement("div");
//     card.classList.add("swiper-slide");
//     if(data.description){
//         description = data.description
//     }
//     else{
//         description = ""
//     }
//     card.innerHTML = `
//             <div class=".category-card">
//             <a href='${data.link}' >
//                 <img src="${data.imgSrc}" alt="${data.title}">
//                 <div class="card-overlay">
//                     <div class="card-title2">${data.title}</div>
//                     <div class="card-description2">${description}</div>
//                     <span class="line-card"></span>
//                     <span class="button-search-forth-section card-button2">
//                     <img class="card-button-img" src="../assets/imgs/Vector 9.svg" alt="">
//                     <span>
//                 </div>
//                 </a>
//                 </div>
//         `;

//     cardContainer2.appendChild(card);
//   });
// }
