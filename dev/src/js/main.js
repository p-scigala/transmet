'use strict';

import slickCall from './modules/slick';
import cf7FloatingLabels from './modules/cf7FloatingLabels';
import scrollAnim from './modules/scrollAnim';

jQuery(document).ready(function ($) {
  cf7FloatingLabels($);

  scrollAnim($);
  slickCall($);

  document.querySelectorAll('.accordion__trigger').forEach((trigger) => {
    trigger.addEventListener('click', () => {
      const content = trigger.nextElementSibling;
      trigger.parentElement.classList.toggle('active');
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
      } else {
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
  });

  const cartCount = document.querySelector('.header__cart-count-number');
  const cartCountText = cartCount.textContent.trim();
  if (cartCountText === '0') {
    cartCount.style.display = 'none';
  } else {
    cartCount.style.display = 'block';
  }

  const header = document.querySelector('.header');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 80) {
      header.classList.add('header--scrolled');
    } else {
      header.classList.remove('header--scrolled');
    }
  });

  const menuToggle = document.querySelector('.header__menu-toggle');
  const menu = document.querySelector('.header__menu');
  menuToggle.addEventListener('click', () => {
    menu.classList.toggle('header__menu--active');
    menuToggle.classList.toggle('header__menu-toggle--active');
    if (menu.classList.contains('header__menu--active')) {
      menu.style.display = 'block';
      setTimeout(() => {
        menu.style.opacity = '1';
      }, 10);
    } else {
      menu.style.opacity = '0';
      setTimeout(() => {
        menu.style.display = 'none';
      }, 300);
    }
  });
});
