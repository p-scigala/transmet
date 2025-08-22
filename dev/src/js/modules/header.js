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
}

export default headerInit;