// Initialize Swiper 1
var swiper1 = new Swiper(".mySwiper", {
  loop: true,
  pagination: {
    el: ".swiper-pagination",
  },
  autoplay: {
    delay: 6000,
    disableOnInteraction: false,
    waitForTransition: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  speed: 1000,
});

// Initialize Swiper 2
var swiper2 = new Swiper(".mySwiper2", {
  slidesPerView: 1,
  spaceBetween: 8,
  loop: true,
  autoplay: {
    delay: 500,
    // disableOnInteraction: false,
  },
  speed: 1000,
  pagination: {
    el: ".swiper-pagination2",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 15,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    1100: {
      slidesPerView: 5,
      spaceBetween: 20,
    },
  },
});

// Initialize Swiper 3
var swiper3 = new Swiper(".mySwiper-about", {
  loop: true,
  slidesPerView: 6,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoplay: {
    delay: 0,
  },
  speed: 4000,
  breakpoints: {
    320: {
      slidesPerView: 1.5,
    },
    640: {
      slidesPerView: 3,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});
