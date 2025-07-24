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

  // Initialize WooCommerce variation forms after custom selects are created
  setTimeout(() => {
    if ($('.variations_form').length > 0) {
      // console.log('Initializing WooCommerce variation forms...');
      $('.variations_form').each(function () {
        const $form = $(this);
        if (!$form.data('wc_variation_form')) {
          $form.wc_variation_form();
          // console.log('Initialized variation form for product:', $form.data('product_id'));
        }
      });
    }
  }, 500);

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

  const headerNav = document.querySelector('.header__nav');

  if (headerNav) {
    const menuItems = headerNav.querySelectorAll('.menu-item-has-children');

    if (menuItems) {
      menuItems.forEach((item) => {
        const btn = item.querySelector('.menu-arrow');

        if (btn) {
          btn.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
              e.preventDefault();
              const subMenu = item.querySelector('.sub-menu');
              subMenu.classList.toggle('active');
              item.classList.toggle('active');
            }
          });
        }
      });
    }
  }

  const filterToggle = document.querySelectorAll('.products__filters-toggle');
  if (filterToggle.length > 1) {
    filterToggle.forEach((toggle) => {
      if (toggle) {
        toggle.addEventListener('click', () => {
          const filters = document.querySelector('.products__filters');
          filters.classList.toggle('active');
          toggle.classList.toggle('active');
        });

        const closeFilterButton = document.querySelector(
          '.close-filter-button'
        );

        if (closeFilterButton) {
          closeFilterButton.addEventListener('click', () => {
            const filters = document.querySelector('.products__filters');
            filters.classList.remove('active');
            toggle.classList.remove('active');
          });
        }
      }
    });
  }

  /* display items with class "hidden-before-load" */
  const hiddenItems = document.querySelectorAll('.hidden-before-load');
  if (hiddenItems.length > 0) {
    console.log('Revealing hidden items...');
    hiddenItems.forEach((item) => {
      item.classList.remove('hidden-before-load');
      item.style.opacity = '';
      item.style.visibility = '';
    });
  }

  /* quantity change */
  const quantityInput = document.querySelectorAll("input[name='quantity']");

  quantityInput.forEach((input) => {
    const minusButton = input.previousElementSibling;
    const plusButton = input.nextElementSibling;

    minusButton.addEventListener('click', function () {
      let currentValue = parseInt(input.value, 10);
      if (currentValue > 1) {
        input.value = currentValue - 1;
      }
    });

    plusButton.addEventListener('click', function () {
      let currentValue = parseInt(input.value, 10);
      input.value = currentValue + 1;
    });
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
  const miniCartButtons = document.querySelectorAll(
    '.woocommerce-mini-cart__buttons a, .woocommerce-mini-cart__buttons button'
  );
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
