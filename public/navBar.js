const nav = document.querySelector("nav");
const brgureIcon = document.querySelector(".icon-burger");
const navLinksPhone = document.querySelector(".nav-links-phone");
const overlay = document.querySelector(".mobile-overlay");
const closeNav = document.querySelector(".close-nav");

// Function to handle scroll event
function handleScroll() {
  if (window.scrollY > 0) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
}
handleScroll();
document.addEventListener("DOMContentLoaded", function () {
  handleScroll();

  // Attach the scroll event listener
  window.addEventListener("scroll", handleScroll);
});

// menu phone
brgureIcon.addEventListener("click", function () {
  if (navLinksPhone.className.includes("showMobileNav")) {
    navLinksPhone.classList.remove("showMobileNav");
    overlay.style.display = "none";
  } else {
    navLinksPhone.classList.add("showMobileNav");
    overlay.style.display = "block";
  }
});
closeNav.addEventListener("click", function () {
  if (navLinksPhone.className.includes("showMobileNav")) {
    navLinksPhone.classList.remove("showMobileNav");
    overlay.style.display = "none";
  } else {
    navLinksPhone.classList.add("showMobileNav");
    overlay.style.display = "block";
  }
});
overlay.addEventListener("click", function () {
  if (navLinksPhone.className.includes("showMobileNav")) {
    navLinksPhone.classList.remove("showMobileNav");
    overlay.style.display = "none";
  } else {
    navLinksPhone.classList.add("showMobileNav");
    overlay.style.display = "block";
  }
});

const searchIcon = document.querySelector("#search-icon");
searchIcon.addEventListener("click", () => {
  document
    .querySelector(".search-container input")
    .classList.toggle("openSearch");
  console.log(document.querySelector(".search-container input"));
});
