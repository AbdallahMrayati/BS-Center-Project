// document.addEventListener("DOMContentLoaded", async function () {
//     // Assuming you have the tag variable available
//     // const tag = 'tag_name'; // Replace this with the actual tag you want to filter by
//     console.log("tag: ", tag);
//     // Fetch related blogs from the API
//     const response = await fetch(`/blogs/get-related-blogs/${tag}`);
//     const result = await response.json();

//     const data = result.blogs.map((blog) => ({
//         img: blog.image_url || "/assets/imgs/card-blog.png", // Fallback image if none is provided
//         title: blog.title,
//         desc: blog.description,
//         viewNum: blog.number_of_views,
//         link: `/blog/${blog.slug}`,
//     }));

//     // Create and append blog cards dynamically
//     data.forEach((item) => {
//         const card = document.createElement("div");
//         card.classList.add("card-blogs");

//         card.innerHTML = `
//         <img src="${item.img}" alt="${item.title}" class="card-blog-img">
//         <div class="card-blog-content">
//           <h3>${item.title}</h3>
//           <div class="card-blog-desc">
//             ${
//                 item.desc.length > 125
//                     ? `<p>${item.desc.substring(0, 125)}...</p>
//                   <a href='${item.link}'>more</a>`
//                     : `<p>${item.desc}</p>`
//             }
//           </div>
//           <div class="card-blog-footer">
//             <button><a href='${item.link}'>Read more</a></button>
//             <div class="card-blog-views">
//               <img src="/assets/icons/view.svg" alt="Views icon">
//               <span>${item.viewNum}</span>
//             </div>
//           </div>
//         </div>
//       `;

//         document.querySelector(".card-container-blog").appendChild(card);
//     });
// });
