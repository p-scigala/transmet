export default function customSelect(exceptions = []) {
  const selects = document.querySelectorAll('select');

  // Filtruj selects, które nie są w exceptions
  const realSelects = Array.from(selects).filter((select) => {
    return !exceptions.some((exception) => select.matches(exception));
  });

  realSelects.forEach((realSelect) => {
    const customSelect = document.createElement('div');
    customSelect.className = 'select';

    if (realSelect.classList.contains('select--secondary')) {
      customSelect.classList.add('select--secondary');
    }

    const selected = document.createElement('div');
    selected.className = 'select-selected';
    selected.textContent =
      realSelect.options[realSelect.selectedIndex].textContent;
    customSelect.appendChild(selected);

    const items = document.createElement('div');
    items.className = 'select-items';

    // Sprawdź czy to jest atrybut WooCommerce
    const isWooCommerceAttribute = realSelect.name && realSelect.name.startsWith('attribute_');
    const variationForm = realSelect.closest('.variations_form');

    Array.from(realSelect.options).forEach((option) => {
      const item = document.createElement('div');
      item.textContent = option.textContent;
      if (option.value) {
        item.addEventListener('click', () => {
          selected.textContent = option.textContent;
          realSelect.value = option.value;

          // Upewnij się, że option jest zaznaczony
          Array.from(realSelect.options).forEach(opt => opt.selected = false);
          option.selected = true;
          realSelect.selectedIndex = Array.from(realSelect.options).indexOf(option);

          // console.log('Custom select changed:', realSelect.name, 'to', option.value, 'index:', realSelect.selectedIndex);

          // Force change event in vanilla JS as well
          realSelect.dispatchEvent(new Event('change', { bubbles: true }));

          // WooCommerce specific handling
          if (isWooCommerceAttribute && variationForm && window.jQuery) {
            const $form = window.jQuery(variationForm);
            const $realSelect = window.jQuery(realSelect);

            // Najpierw trigger change event
            $realSelect.trigger('change');

            // Po krótkim opóźnieniu sprawdź i wywołaj check_variations
            setTimeout(() => {
              // Force trigger WooCommerce variation check
              $form.trigger('check_variations');
              $form.trigger('woocommerce_variation_select_change');

              if ($form.data('wc_variation_form')) {
                // console.log('Calling check_variations via wc_variation_form');
                $form.data('wc_variation_form').check_variations();
              }

              // Check current variation ID immediately
              const currentVariationId = $form.find('input[name="variation_id"]').val();
              // console.log('Variation ID after initial check:', currentVariationId);

              // Dodatkowe sprawdzenie czy wszystkie selects mają wartości
              setTimeout(() => {
                const allSelects = $form.find('.variations select');
                let allHaveValues = true;
                const selectedValues = {};

                allSelects.each(function () {
                  const selectValue = window.jQuery(this).val();
                  const selectName = window.jQuery(this).attr('name');
                  selectedValues[selectName] = selectValue;
                  if (!selectValue) {
                    allHaveValues = false;
                  }
                });

                const list = allSelects.prevObject[0].querySelectorAll("select");

                list.forEach((select) => {
                  const selectValue = select.value;
                  const selectName = select.name;
                  selectedValues[selectName] = selectValue;
                  if (!selectValue) {
                    allHaveValues = false;
                  }
                });

                // console.log('All attributes selected:', allHaveValues);
                // console.log('Selected attributes:', selectedValues);

                if (allHaveValues) {

                  // Sprawdź czy variation_id zostało ustawione
                  const variationId = $form.find('input[name="variation_id"]').val();
                  // console.log('Final variation ID check:', variationId);

                  if (variationId && variationId !== '0' && selectedValues.length > 0) {
                    // Usuń klasy blokujące przycisk
                    const $button = $form.find('.single_add_to_cart_button');
                    $button.removeClass('wc-variation-selection-needed disabled');
                    $button.prop('disabled', false);
                    // console.log('Button enabled, variation ID:', variationId);
                  } else {
                    // Jeśli variation_id nadal 0, wywołaj ponownie check_variations
                    // console.log('Variation ID still 0, retrying...');
                    $form.trigger('check_variations');
                    if ($form.data('wc_variation_form')) {
                      $form.data('wc_variation_form').check_variations();
                    }

                    // Final check after retry
                    setTimeout(() => {
                      const finalVariationId = $form.find('input[name="variation_id"]').val();

                      if (finalVariationId && finalVariationId !== '0') {
                        const $button = $form.find('.single_add_to_cart_button');
                        $button.removeClass('wc-variation-selection-needed disabled');
                        $button.prop('disabled', false);
                        // console.log('Button enabled after retry, variation ID:', finalVariationId);
                      } else {
                        // Last resort: try manual variation matching
                        // console.log('Attempting manual variation matching...');
                        const manualVariationId = findVariationManually($form, selectedValues);

                        if (manualVariationId) {
                          $form.find('input[name="variation_id"]').val(manualVariationId);
                          const $button = $form.find('.single_add_to_cart_button');
                          $button.removeClass('wc-variation-selection-needed disabled');
                          $button.prop('disabled', false);
                          // console.log('Manual variation match successful:', manualVariationId);
                        }
                      }

                      // display variation price
                      const variationPrice = document.querySelector('.woocommerce-variation-price');
                      const formData = $form.data('product_variations');

                      if (formData) {
                        let currentVariation = null;

                        formData.forEach(item => {
                          if (deepEqual(item.attributes, selectedValues)) {
                            currentVariation = item;
                          }
                        });
                        console.log(currentVariation)
                        $form.find('input[name="variation_id"]').val(currentVariation.variation_id);

                        let price = `<p class="price">`;

                        if (currentVariation.display_regular_price) {
                          price += `<del aria-hidden="true">
                            <span class="woocommerce-Price-amount amount">
                              <bdi>${currentVariation.display_regular_price}&nbsp;<span class="woocommerce-Price-currencySymbol">zł</span></bdi>
                            </span>
                          </del>
                          <span class="screen-reader-text">Pierwotna cena wynosiła: ${currentVariation.display_regular_price}&nbsp;zł.</span>`;
                        }

                        if (currentVariation.display_price) {
                          price += `<ins aria-hidden="true">
                            <span class="woocommerce-Price-amount amount">
                              <bdi>${currentVariation.display_price}&nbsp;<span class="woocommerce-Price-currencySymbol">zł</span></bdi>
                            </span>
                          </ins>
                          <span class="screen-reader-text">Aktualna cena wynosi: ${currentVariation.display_price}&nbsp;zł.</span>`
                        }

                        price += `</p>`;

                        variationPrice.innerHTML = price;

                        const lowest = `<div class="wc-price-history prior-price lowest">
                          Najniższa cena sprzed 30 dni:
                          <span class="wc-price-history prior-price-value ">
                            <span class="woocommerce-Price-amount amount">
                              <bdi>
                                <span class="wc-price-history-lowest-raw-value">${currentVariation._wc_price_history_lowest_price}</span>
                                <span class="woocommerce-Price-currencySymbol">zł</span>
                              </bdi>
                            </span>
                          </span>
                        </div>`;
                        variationPrice.insertAdjacentHTML('beforeend', lowest);

                        // variationPrice.innerHTML = `<span class="woocommerce-Price-amount amount"><bdi>${currentVariation.display_price} zł</bdi></span>`;
                        document.querySelector('.price-amount').style.display = 'none';
                      } else {
                        document.querySelector('.price-amount').style.display = '';
                      }
                    }, 100);
                  }
                }
              }, 200);
            }, 100);
          } else {
            // Dla nie-WooCommerce selectów
            const changeEvent = new Event('change', { bubbles: true });
            realSelect.dispatchEvent(changeEvent);
          }

          setTimeout(() => customSelect.classList.remove('active'), 0);

          // Jeśli select ma klasę form-submit-select, wyślij formularz
          if (realSelect.classList.contains('form-submit-select')) {
            const form = realSelect.closest('form');
            if (form) form.submit();
          }
        });
      } else {
        item.classList.add('select-placeholder');
      }
      items.appendChild(item);
    });

    customSelect.appendChild(items);
    realSelect.style.display = 'none'; // Ukryj oryginalny select
    realSelect.parentNode.insertBefore(customSelect, realSelect);

    const label = document.querySelector("[label='" + realSelect.id + "']");
    if (label) {
      label.classList.add('select-label');
      label.addEventListener('click', () => {
        customSelect.classList.toggle('active'); // Przełącz aktywność custom select
      });
    }

    customSelect.addEventListener('click', (e) => {
      e.stopPropagation(); // Zapobiegaj propagacji kliknięcia
      customSelect.classList.toggle('active');
    });

    document.addEventListener('click', () => {
      customSelect.classList.remove('active'); // Zamknij select, gdy klikniesz poza
    });
  });
}

// Helper function to manually find matching variation
function findVariationManually($form, selectedAttributes) {
  const variationsData = $form.data('product_variations');

  if (!variationsData || !Array.isArray(variationsData)) {
    // console.log('No variations data available');
    return null;
  }

  // console.log('Manual search in variations:', variationsData.length, 'variations');
  // console.log('Looking for attributes:', selectedAttributes);

  for (let i = 0; i < variationsData.length; i++) {
    const variation = variationsData[i];
    let matches = true;

    // console.log(`Checking variation ${variation.variation_id}:`, variation.attributes);

    // Check if all selected attributes match this variation
    for (const attrName in selectedAttributes) {
      const selectedValue = selectedAttributes[attrName];
      const variationValue = variation.attributes[attrName];

      // console.log(`  ${attrName}: "${selectedValue}" === "${variationValue}" ?`, selectedValue === variationValue);

      if (selectedValue !== variationValue) {
        matches = false;
        break;
      }
    }

    if (matches) {
      // console.log('Found matching variation:', variation.variation_id);
      return variation.variation_id;
    }
  }

  // console.log('No matching variation found');
  return null;
}

function deepEqual(a, b) {
  if (a === b) return true;

  if (typeof a !== "object" || typeof b !== "object" || a == null || b == null) {
    return false;
  }

  const keysA = Object.keys(a);
  const keysB = Object.keys(b);

  if (keysA.length !== keysB.length) return false;

  return keysA.every(key => deepEqual(a[key], b[key]));
}
