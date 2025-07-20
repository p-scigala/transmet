'use strict';

import slickCall from './modules/slick';
import cf7FloatingLabels from './modules/cf7FloatingLabels';
import scrollAnim from './modules/scrollAnim';
import customSelect from './modules/customSelect';
// import addToCart from './modules/add-to-cart';

jQuery(document).ready(function ($) {
  cf7FloatingLabels($);

  scrollAnim($);
  slickCall($);
  customSelect(['.woof_acf_select']);
  // addToCart($);

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

  menuToggle.addEventListener('click', () => {
    header.classList.toggle('header--active');
    menuToggle.classList.toggle('header__menu-toggle--active');
  });

  const filtersCategories = document.querySelectorAll(
    'li.products__filters-category'
  );

  filtersCategories.forEach((category) => {
    const trigger = category.querySelector('.categories-collapse');
    const subItems = category.querySelector(
      '.archive-products__category-second'
    );

    if (trigger && subItems) {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        trigger.classList.toggle('active');
        subItems.classList.toggle('show');
      });
    }
  });
});

function updateCheckoutButton() {
  const checkoutButtons = document.querySelectorAll(
    '.wc-block-cart__submit-button, .wc-block-components-button'
  );

  if (checkoutButtons.length) {
    checkoutButtons.forEach((checkoutButton) => {
      if (!checkoutButton.classList.contains('btn')) {
        checkoutButton.classList.add('btn');
        if (checkoutButton.textContent) {
          checkoutButton.innerHTML =
            '<span>' + checkoutButton.textContent + '</span>';
        }
      }
    });
  }
}

function addClassToMiniCartButtons() {
  const miniCartButtons = document.querySelectorAll('.woocommerce-mini-cart__buttons a, .woocommerce-mini-cart__buttons button');
  miniCartButtons.forEach((btn) => {
    btn.classList.add('btn');
    if (btn.textContent) {
      btn.innerHTML = '<span>' + btn.textContent + '</span>';
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  updateCheckoutButton();
  addClassToMiniCartButtons();

  // Obserwuj zmiany w DOM, aby wykryć pojawienie się przycisku
  const observer = new MutationObserver(() => {
    updateCheckoutButton();
    addClassToMiniCartButtons();
    // observer.disconnect();
  });

  observer.observe(document.body, { childList: true, subtree: true });
});
