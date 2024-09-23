// document.addEventListener("DOMContentLoaded", function () {
//     const categoriesData = document
//         .getElementById("category-data")
//         .getAttribute("data-categories");
//     const categories = JSON.parse(categoriesData);

//     categories.forEach((item) => {
//         if (item.description) {
//             description = item.description;
//         } else {
//             description = "";
//         }
//         document.querySelector(".categories-cards").innerHTML += `
//             <a class="category-card" href='/courses/${item.slug}'>
//                 <img src="${item.media_url}" alt="${item.image_alt}">
//                 <div class="card-overlay">
//                     <h3>${item.title}</h3>
//                     <p>${description}</p>
//                     <span class="line-card"></span>
//                     <span class="category-card-arrow"><img src="../assets/icons/arrow.svg" alt=""></span>
//                 </div>
//             </a>
//         `;
//     });
// });
