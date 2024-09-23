// // Select
document.addEventListener("DOMContentLoaded", function () {
    const customSelectWrappers = document.querySelectorAll(
        ".custom-select-wrapper"
    );
    console.log(customSelectWrappers);
    customSelectWrappers.forEach((wrapper) => {
        const customSelect = wrapper.querySelector(".custom-select");
        const customSelectTrigger = customSelect.querySelector(
            ".custom-select-trigger"
        );
        const customOptions = customSelect.querySelector(".custom-options");
        const options = customOptions.querySelectorAll(".custom-option");

        customSelectTrigger.addEventListener("click", function () {
            const customSelect = customSelectTrigger.closest(".custom-select");
            document.querySelectorAll(".custom-select").forEach((el) => {
                if (el !== customSelect) {
                    el.classList.remove("open");
                }
            });
            customSelect.classList.toggle("open");
        });

        options.forEach((option) => {
            option.addEventListener("click", function () {
                customSelectTrigger.querySelector("span").textContent =
                    this.textContent;
                customSelect.classList.remove("open");
            });
        });
    });

    document.addEventListener("click", function (e) {
        const isClickInside = Array.from(customSelectWrappers).some((wrapper) =>
            wrapper.contains(e.target)
        );
        if (!isClickInside) {
            customSelectWrappers.forEach((wrapper) => {
                wrapper
                    .querySelector(".custom-select")
                    .classList.remove("open");
            });
        }
    });
});

// // Upcoming courses
// document.addEventListener("DOMContentLoaded", function () {
//     const cardContainer = document.querySelector(".card-container");

//     fetch("/api/upcoming-courses") // Replace with your actual API endpoint
//       .then((response) => response.json())
//       .then((data) => {
//         data.forEach((item) => {
//           const card = document.createElement("a");
//           card.href = `/course/${item.course_slug}`; // Dynamic link to the course detail page
//           card.classList.add("card");

//           card.innerHTML = `
//               <img src="${item.course_image}" alt="${item.image_alt}">
//               <div class="card-content">
//                   <div class="card-title">${item.course_title}</div>
//                   <div class="card-dates">
//                     <img src="./assets/icons/calender2.svg" alt="" />
//                     <span>${item.date_from} to ${item.date_to} ${new Date(item.date_from).getFullYear()}</span>
//                   </div>
//                 <div class="card-location">
//                   <img src="./assets/icons/location.svg" alt="" class="location-icon"  />
//                 <span>${item.city_title}</span></div>
//                   <div class="card-buttons">
//                       <a href='/register/${item.id}' class="btn-primary">Register Now</a>
//                       <a href="/course/${item.course_slug}" class="btn-secondary">Learn more</a>
//                   </div>
//               </div>
//           `;

//           cardContainer?.appendChild(card);
//         });
//       })
//       .catch((error) => console.error("Error fetching course data:", error));
//   });

// function changePage(slug) {
//     window.location.href = "/courses/" + slug;
// }

// FAQ
document.addEventListener("DOMContentLoaded", function () {
    const faqData = [
        {
            question: "What courses are available?",
            answer: "We offer a variety of courses including web development, data science, and digital marketing.",
        },
        {
            question: "How can I enroll in a course?",
            answer: "You can enroll in a course by visiting our website, selecting the course you are interested in, and clicking the enroll button.",
        },
        {
            question: "What is the duration of the courses?",
            answer: "Course durations vary. Most courses range from 4 weeks to 12 weeks.",
        },
        {
            question: "Are there any prerequisites?",
            answer: "Some courses have prerequisites, which are listed on the course description page.",
        },
        {
            question: "Do you offer certification?",
            answer: "Yes, we offer certificates upon successful completion of our courses.",
        },
        {
            question: "Can I get a refund if I am not satisfied?",
            answer: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempos Lorem ipsum dolor sitamet, consectetur adipiscing elit, sed do eiusmod temporLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempos Lorem ipsum dolor sitamet, consectetur adipiscing elit, sed do eiusmod temporLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempos Lorem ipsum dolor sitamet, consectetur adipiscing elit, sed do eiusmod temporLorem ipsum dolor ",
        },
    ];

    const faqContainer = document.querySelector(".faq-container");

    faqData.forEach((data) => {
        const faqItem = document.createElement("div");
        faqItem.classList.add("faq-item");

        faqItem.innerHTML = `
            <div class="faq-question">
                <span class="green-circle"></span>${data.question}
                <span class="faq-toggle">
                <svg width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.70312 9.54688L1.32812 3.17188C0.859375 2.70312 0.859375 2 1.32812 1.57812L2.35938 0.5C2.82812 0.078125 3.53125 0.078125 3.95312 0.5L8.45312 5.04688L13 0.5C13.4219 0.078125 14.125 0.078125 14.5938 0.5L15.625 1.57812C16.0938 2 16.0938 2.70312 15.625 3.17188L9.25 9.54688C8.82812 9.96875 8.125 9.96875 7.70312 9.54688Z" fill="#696984"/>
                </svg>
                </span>
            </div>
            <div class="faq-answer">${data.answer}</div>
        `;

        faqContainer?.appendChild(faqItem);

        const questionElement = faqItem.querySelector(".faq-question");
        questionElement.addEventListener("click", function () {
            document.querySelectorAll(".faq-item").forEach((el) => {
                if (el !== faqItem && el.classList.contains("open")) {
                    el.classList.remove("open");
                }
            });
            faqItem.classList.toggle("open");
        });
    });
});

// // Scroll
window.addEventListener("scroll", function () {
    const imageContainer = document.getElementsByClassName("whats-app");
    const heroSection = document.querySelector("#hero1");
    const heroHeight = heroSection?.offsetHeight;
    if (window.scrollY >= heroHeight) {
        imageContainer[0]?.classList.add("fixed");
    } else {
        imageContainer[0]?.classList.remove("fixed");
    }
});
