// document.getElementById('animateButton').addEventListener('click', function() {
//     document.getElementById('droped-down').classList.toggle('animated');
// });

let currentIndex = 0;
const slides = document.querySelectorAll(".slide");
const totalSlides = slides.length;
const carouselSlides = document.querySelector(".carousel-slides");

// Clone the first and last slide
const firstSlideClone = slides[0].cloneNode(true);
const lastSlideClone = slides[totalSlides - 1].cloneNode(true);

carouselSlides.appendChild(firstSlideClone);
carouselSlides.insertBefore(lastSlideClone, slides[0]);

carouselSlides.style.transform = `translateX(-100%)`;

function showSlide(index) {
  if (index >= totalSlides) {
    currentIndex = 0;
  } else if (index < 0) {
    currentIndex = totalSlides - 1;
  } else {
    currentIndex = index;
  }

  const offset = -(currentIndex + 1) * 100;
  carouselSlides.style.transform = `translateX(${offset}%)`;
  carouselSlides.classList.add("transition");
}

function nextSlide() {
  showSlide(currentIndex + 1);
  if (currentIndex === 0) {
    setTimeout(() => {
      carouselSlides.classList.remove("transition");
      carouselSlides.style.transform = `translateX(-100%)`;
    }, 500);
  }
}

function prevSlide() {
  showSlide(currentIndex - 1);
  if (currentIndex === totalSlides - 1) {
    setTimeout(() => {
      carouselSlides.classList.remove("transition");
      carouselSlides.style.transform = `translateX(-${totalSlides * 100}%)`;
    }, 500);
  }
}

// Initialize the first slide
showSlide(currentIndex);

// Automatically move to the next slide every 3 seconds
setInterval(nextSlide, 3000);

function toggleMenu() {
  const navLinks = document.getElementById("nav-links");
  const overlay = document.getElementById("overlay");

  if (navLinks.style.right === "0px") {
    navLinks.style.right = "-100%";
    overlay.style.display = "none";
  } else {
    navLinks.style.right = "0";
    overlay.style.display = "block";
  }
}

function closeMenu() {
  const navLinks = document.getElementById("nav-links");
  const overlay = document.getElementById("overlay");

  navLinks.style.right = "-100%";
  overlay.style.display = "none";
}

// // news article slider
// const cardContainer = document.querySelector(".card-container");
// const arrowArticleBtn = document.querySelectorAll(".slider-nav span");
// const fisrtCardWidth = cardContainer.querySelector(".card").offsetWidth;
// // let isDraging = false;

// arrowArticleBtn.forEach((btn) => {
//   btn.addEventListener("click", () => {
//     cardContainer.scrollLeft +=
//       btn.id === "left" ? -fisrtCardWidth : fisrtCardWidth;
//   });
// });


// news article slider
const cardContainer = document.querySelector(".card-container");
const arrowArticleBtn = document.querySelectorAll(".slider-nav span");

const fisrtCardWidth = cardContainer.querySelector(".card").offsetWidth;

// Automatic sliding every 3 seconds
let autoSlideInterval;

const startAutoSlide = () => {
  autoSlideInterval = setInterval(() => {
    cardContainer.scrollLeft += fisrtCardWidth;
    
    // Check if the end is reached and reset to start
    if (cardContainer.scrollLeft >= cardContainer.scrollWidth - cardContainer.clientWidth) {
      cardContainer.scrollLeft = 0;
    }
  }, 3000); // 3000ms = 3 seconds
};

const stopAutoSlide = () => {
  clearInterval(autoSlideInterval);
};

arrowArticleBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    cardContainer.scrollLeft += btn.id === "left" ? -fisrtCardWidth : fisrtCardWidth;

    // Stop auto sliding when manually sliding
    stopAutoSlide();
    startAutoSlide();
  });
});

startAutoSlide();

