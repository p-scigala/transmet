jQuery(document).ready(function ($) {
  $('body').on('click', '.product__add-to-cart a:not(.has-variants), .single_add_to_cart_button', function (e) {
    e.preventDefault();

    let button = $(this);
    let product_id = button.data('product_id');
    let quantity = button.data('quantity') || 1;

    button.addClass('btn--loader');

    $.ajax({
      url: AjaxCart.ajax_url,
      type: 'POST',
      data: {
        action: 'add_to_cart',
        product_id: product_id,
        quantity: quantity,
        nonce: AjaxCart.nonce,
      },
      success: function (response) {
        button.removeClass('btn--loader');

        if (response && response.error) {
          modal(response.message || 'Wystąpił błąd podczas dodawania do koszyka.');
          return;
        }

        if (response && !response.error) {
          modal('Produkt został dodany do koszyka.', createModalContent(response.fragments['div.widget_shopping_cart_content']), 'side');

          const cartCount = document.querySelector('.header__cart-count-number');
          if (cartCount) {
            let cartQuantity = parseInt(cartCount.textContent) || 0;
            cartCount.textContent = cartQuantity + quantity;
          }

          $.ajax({
            url: AjaxCart.ajax_url,
            type: 'POST',
            data: {
              action: 'get_cart_count',
            },
            success: function (response) {
              if (response.success && response.data) {
                // check cart count from response
                cartCount.textContent = response.data.count;
              }
            },
          });
        } else {
          console.log(response.message || 'Wystąpił błąd podczas dodawania do koszyka.');
        }
      },
      error: function () {
        modal('Błąd zapytania: Nie udało się dodać produktu do koszyka.');
        button.removeClass('btn--loader');
        // console.log('AJAX error.');
      },
    });
  });

  $('body').on('added_to_cart', function (event, fragments, cart_hash, $button) {
    // console.log('AJAX add to cart triggered!');
    // console.log('Cart fragments:', fragments); // DOM fragments to update cart contents
    // console.log('Cart hash:', cart_hash);     // Unique cart hash
    // console.log('Button clicked:', $button);  // The button that triggered the event
    console.log(fragments)
    // modal('Produkt został dodany do koszyka.', createModalContent(fragments['div.widget_shopping_cart_content']), 'side');

    // modal("Produkt został dodany do koszyka.", `<a href="/orto4you/koszyk/" style="margin: auto;" class="added_to_cart wc-forward btn" title="Zobacz koszyk"><span>Zobacz koszyk</a>`);

    // modal("Produkt został dodany do koszyka.", fragments['div.widget_shopping_cart_content'] || null);
  });
});

function createModalContent(content) {
  const wrapper = document.createElement('div');
  wrapper.innerHTML = content;

  const items = wrapper.querySelectorAll('li.woocommerce-mini-cart-item.mini_cart_item');
  const itemContents = Array.from(items).map(item => item.outerHTML).join('');

  const buttons = `<div class="modal__custom-buttons">
        <button class="btn modal__custom-btn" onclick="closeModal()">
          <span>Kontynuuj zakupy</span>
        </button>
        <button href="koszyk/" class="added_to_cart wc-forward btn modal__custom-btn" title="Zobacz koszyk">
          <span>Zobacz koszyk</span>
        </button>
        <button class="btn modal__custom-btn" onclick="window.location.href='zamowienie/'">
          <span>Przejdź do zamówienia</span>
        </button>
      </div>`;

  const modalContent = document.createElement('div');
  modalContent.innerHTML = '<div class="modal__custom-items widget_shopping_cart_content">' + itemContents + '</div>' + buttons;
  return modalContent.innerHTML;
}

function modal(message, content = null, type = "standard") {
  const wrapper = document.createElement('div');
  wrapper.classList.add('modal');
  wrapper.classList.add('modal--' + type);
  setTimeout(() => {
    wrapper.classList.add('modal--active');
  }, 10);
  wrapper.addEventListener('click', (e) => {
    if (e.target === wrapper) {
      closeModal();
    }
  });

  const modal = document.createElement('div');
  modal.classList.add('modal__box');
  setTimeout(() => {
    modal.classList.add('modal__box--active');
  }, 10);

  const modalHeading = document.createElement('h2');
  modalHeading.classList.add('modal__heading');
  modalHeading.textContent = message;
  modal.append(modalHeading);

  if (content) {
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('modal__content');
    contentDiv.innerHTML = content;
    modal.append(contentDiv);
  }

  const modalClose = document.createElement('button');
  modalClose.classList.add('modal__close');
  modalClose.innerHTML = '&times;';
  modalClose.addEventListener('click', () => {
    closeModal();
  });
  modal.append(modalClose);

  wrapper.appendChild(modal);

  document.body.appendChild(wrapper);
};

function closeModal() {
  const wrapper = document.querySelector('.modal');
  wrapper.classList.remove('modal--active');
  setTimeout(() => {
    wrapper.classList.remove('modal__wrapper--active');
  }, 300);
  setTimeout(() => {
    document.body.removeChild(wrapper);
  }, 300);
};