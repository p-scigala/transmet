const headerInit = () => {
  if (vw <= 1024) {
    const middle = document.querySelector('.header__middle');
    const topMenu = document.querySelector('.top-menu');
    const middleMenuWrapper = document.querySelector('.menu-menu-glowne-container');
    const nav = document.querySelector('.header__nav');
    const topContact = document.querySelector('.header__top-contact');
    const wrapper = middle.querySelector('.wrapper');
    const items = wrapper.children;

    wrapper.style.transitionDuration = '';

    setInterval(() => {
      const height = items[0].offsetHeight;
      wrapper.style.top = `-${height}px`;
      setTimeout(() => {
        wrapper.style.transitionDuration = '0s';
        wrapper.appendChild(items[0]);
        wrapper.style.top = '0px';
      }, 300);

      setInterval(() => {
        wrapper.style.transitionDuration = '';
      }, 600);

    }, 4000);

    // if mobile, move top menu to nav
    middleMenuWrapper.appendChild(topMenu);
    nav.appendChild(topContact);
  }

  const header = document.querySelector('.header');
  const body = document.body;

  //detect scroll direction
  window.addEventListener('scroll', () => {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (window.scrollY > 140) {
      body.classList.add('scrolled');
      header.classList.add('header--scrolled');
    } else {
      body.classList.remove('scrolled');
      header.classList.remove('header--scrolled');
    }
    // check if scrolling up
    if (currentScroll < lastScrollTop) {
      body.classList.add('scrolled-top');
      header.classList.add('header--scrolled-top');
    } else {
      body.classList.remove('scrolled-top');
      header.classList.remove('header--scrolled-top');
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // avoid negative
  });

  const menuToggle = document.querySelector('.header__menu-toggle');

  menuToggle.addEventListener('click', () => {
    header.classList.toggle('header--active');
    body.classList.toggle('header-active');
    menuToggle.classList.toggle('header__menu-toggle--active');
  });
}

export default headerInit;