let vw = document.body.clientWidth;
let vh = document.body.clientHeight;
let lastScrollTop = 0;

window.addEventListener('resize', function () {
  if (document.body.clientWidth !== vw) {
    vw = document.body.clientWidth;
    vh = document.body.clientHeight;
  }
});

const productsDisplay = localStorage.getItem("products_display") || "block";