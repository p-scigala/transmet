let vw = document.body.clientWidth;
let vh = document.body.clientHeight;
let lastScrollTop = 0;
const currentDeviceAspect = vw >= 1024 ? 'desktop' : 'mobile';

window.addEventListener('resize', function () {
  if (document.body.clientWidth !== vw) {
    vw = document.body.clientWidth;
    vh = document.body.clientHeight;
  }

  // reload page if changed size from desktop to mobile or the other way around
  if (vw >= 1024 && currentDeviceAspect === 'mobile') {
    location.reload();
  } else if (vw < 1024 && currentDeviceAspect === 'desktop') {
    location.reload();
  }
});

const productsDisplay = localStorage.getItem("products_display") || "block";