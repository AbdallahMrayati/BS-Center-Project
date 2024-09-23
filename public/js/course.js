document.addEventListener("DOMContentLoaded", function () {
    //     const tableContainer = document.querySelector(".table-container");
    //     const slug = tableContainer.getAttribute("data-slug");

    //     // Fetch data from the API
    //     fetch(`/${slug}/all-timings`)
    //         .then((response) => response.json()) // Parse JSON response
    //         .then((data) => {
    //             console.log("API Response:", data); // Log the response to inspect it

    //             // Assuming 'timings' is the key holding the array
    //             const tableData = data.timings;

    //             if (!Array.isArray(tableData)) {
    //                 console.error("Expected an array but received:", tableData);
    //                 return;
    //             }

    //             const table = document.getElementById("row-table");

    //             // Populate the table with the data
    //             tableData.forEach((item) => {
    //                 const row = table.insertRow();
    //                 row.insertCell().textContent = item.city.title;
    //                 row.insertCell().textContent = item.date_from;
    //                 row.insertCell().textContent = item.date_to;
    //                 row.insertCell().textContent = item.price;

    //                 // Create and add the Register button
    //                 const registerBtn = document.createElement("a");
    //                 registerBtn.textContent = "Register";
    //                 registerBtn.href = `/register/${item.id}`;
    //                 registerBtn.classList.add("table-btn");
    //                 row.insertCell().appendChild(registerBtn);

    //                 // Create and add the Enquire button
    //                 const enquireBtn = document.createElement("a");
    //                 enquireBtn.textContent = "Enquire";
    //                 enquireBtn.href = `/enquire/${item.course.slug}`;
    //                 enquireBtn.classList.add("table-btn");
    //                 row.insertCell().appendChild(enquireBtn);

    //                 // Create and add the Download/Print button
    //                 const tableBtn = document.createElement("a");
    //                 tableBtn.textContent = "Download/Print";
    //                 tableBtn.style.cursor = "pointer";
    //                 tableBtn.classList.add("table-btn");
    //                 tableBtn.addEventListener("click", showPopup);
    //                 const registerImg = document.createElement("img");
    //                 registerImg.src = "/assets/icons/download.svg";
    //                 registerImg.className = "downloadIcon";
    //                 tableBtn.appendChild(registerImg);
    //                 row.insertCell().appendChild(tableBtn);
    //             });
    //         })
    //         .catch((error) => {
    //             console.error("Error fetching timings data:", error);
    //         });
    // });

    function showPopup() {
        document.querySelector(".popup").style.display = "block";
        document.querySelector(".popup-bg").style.display = "block";
    }

    function hidePopup() {
        document.querySelector(".popup").style.display = "none";
        document.querySelector(".popup-bg").style.display = "none";
    }

    window.addEventListener("click", function (event) {
        if (event.target === document.querySelector(".popup-bg")) {
            hidePopup();
        }
    });

    // document.addEventListener("DOMContentLoaded", function () {
    //     const data = [
    //         {
    //             imgSrc: "../assets/imgs/card-blog.png",
    //             title: "Strategic planning in healthcare organizations",
    //             startDate: "2024-07-01",
    //             endDate: "2024-07-10",
    //             location: "Istanbul",
    //         },
    //         {
    //             imgSrc: "../assets/imgs/card-blog.png",
    //             title: "Strategic planning in healthcare organizations",
    //             startDate: "2024-07-01",
    //             endDate: "2024-07-10",
    //             location: "Istanbul",
    //         },
    //         {
    //             imgSrc: "../assets/imgs/card-blog.png",
    //             title: "Strategic planning in healthcare organizations",
    //             startDate: "2024-07-01",
    //             endDate: "2024-07-10",
    //             location: "Istanbul",
    //         },
    //         {
    //             imgSrc: "../assets/imgs/card-blog.png",
    //             title: "Strategic planning in healthcare organizations",
    //             startDate: "2024-07-01",
    //             endDate: "2024-07-10",
    //             location: "Istanbul",
    //         },
    //     ];

    //     const cardContainer = document.querySelector(".card-container-courses");

    //     data.forEach((data) => {
    //         const card = document.createElement("a");
    //         card.href = "/course.html";
    //         card.classList.add("card");

    //         card.innerHTML = `
    //             <img src="${data.imgSrc}" alt="${data.title}">
    //             <div class="card-content">
    //                 <div class="card-title">${data.title}</div>
    //                 <div class="card-dates">
    //                   <img src="../assets/icons/calender2.svg" alt="" />
    //                   <span>${data.startDate} To ${data.endDate}</span>
    //                 </div>
    //                 <div class="card-location">
    //                   <img src="../assets/icons/location.svg" alt="" class="location-icon"  />
    //                   <span>${data.location}</span></div>
    //                 </div>
    //                 <div class="card-buttons">
    //                     <a href='/registration.html' class="btn-primary">Register Now</a>
    //                     <a href="course.html" class="btn-secondary">Learn more</a>
    //                 </div>
    //             </div>
    //         `;

    //         cardContainer.appendChild(card);
    //     });
});
function showPopup() {
    document.querySelector(".popup").style.display = "block";
    document.querySelector(".popup-bg").style.display = "block";
}
function hidePopup() {
    document.querySelector(".popup").style.display = "none";
    document.querySelector(".popup-bg").style.display = "none";
}
window.addEventListener("click", function (event) {
    if (event.target === document.querySelector(".popup-bg")) {
        hidePopup();
    }
});
