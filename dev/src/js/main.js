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
      console.log('Initializing WooCommerce variation forms...');
      $('.variations_form').each(function() {
        const $form = $(this);
        if (!$form.data('wc_variation_form')) {
          $form.wc_variation_form();
          console.log('Initialized variation form for product:', $form.data('product_id'));
        }
      });
    }
  }, 500);

  // Add manual variation check button for debugging
  if ($('.variations_form').length > 0) {
    const checkButton = $('<button type="button" style="margin:10px; padding:5px;" id="manual-variation-check">Manual Check Variations</button>');
    $('.variations_form').before(checkButton);
    
    checkButton.on('click', function() {
      const $form = $('.variations_form');
      console.log('Manual variation check triggered');
      
      // Get all selected values
      const selectedAttributes = {};
      $form.find('.variations select').each(function() {
        const $select = $(this);
        const value = $select.val();
        const name = $select.attr('name');
        selectedAttributes[name] = value;
        console.log('Attribute:', name, '=', value, 'selectedIndex:', $select[0].selectedIndex);
      });
      
      // Get available variations from form data
      const variationsData = $form.data('product_variations');
      console.log('Available variations:', variationsData);
      
      // Try to find matching variation manually
      if (variationsData && Array.isArray(variationsData)) {
        const matchingVariation = variationsData.find(variation => {
          console.log('Checking variation:', variation.variation_id, variation.attributes);
          
          // Check if all attributes match
          for (const attrName in selectedAttributes) {
            const selectedValue = selectedAttributes[attrName];
            const variationValue = variation.attributes[attrName];
            console.log(`  ${attrName}: selected="${selectedValue}" vs variation="${variationValue}"`);
            
            if (selectedValue !== variationValue) {
              return false;
            }
          }
          return true;
        });
        
        if (matchingVariation) {
          console.log('Found matching variation:', matchingVariation);
          // Manually set the variation ID
          $form.find('input[name="variation_id"]').val(matchingVariation.variation_id);
          const $button = $form.find('.single_add_to_cart_button');
          $button.removeClass('wc-variation-selection-needed disabled');
          $button.prop('disabled', false);
          console.log('Manually set variation ID:', matchingVariation.variation_id);
        } else {
          console.log('No matching variation found');
        }
      }
      
      // Force variation check
      $form.trigger('check_variations');
      if ($form.data('wc_variation_form')) {
        $form.data('wc_variation_form').check_variations();
      }
      
      setTimeout(() => {
        const variationId = $form.find('input[name="variation_id"]').val();
        console.log('Variation ID after manual check:', variationId);
        
        if (variationId && variationId !== '0') {
          const $button = $form.find('.single_add_to_cart_button');
          $button.removeClass('wc-variation-selection-needed disabled');
          $button.prop('disabled', false);
          console.log('Button manually enabled');
        }
      }, 200);
    });
  }

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

        const closeFilterButton = document.querySelector('.close-filter-button');

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