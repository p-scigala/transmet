jQuery(document).ready(function ($) {
  $('body').on('click', '.product__add-to-cart a:not(.has-variants)', function (e) {
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
          modal(response.message || 'Error adding to cart');
          return;
        }

        if (response && !response.error) {
          modal("Product added to cart successfully!", `<a href="http://localhost:8080/orto4you/koszyk/" style="margin: auto;" class="added_to_cart wc-forward btn" title="Zobacz koszyk"><span>Zobacz koszyk</a>`);

          // modal(
          //   response.message || 'Product added to cart successfully!',
          //   response.fragments['div.widget_shopping_cart_content'] || null
          // );

          $.ajax({
            url: AjaxCart.ajax_url,
            type: 'POST',
            data: {
              action: 'get_cart_count',
            },
            success: function (response) {
              if (response.success && response.data) {
                $('.header__cart-count-number').text(response.data.count);
              }
            },
          });
        } else {
          console.log(response.message || 'Error adding to cart');
        }
      },
      error: function () {
        modal('AJAX error. Please try again.');
        button.removeClass('btn--loader');
        console.log('AJAX error.');
      },
    });
  });

  $('body').on('added_to_cart', function (event, fragments, cart_hash, $button) {
    // console.log('AJAX add to cart triggered!');
    // console.log('Cart fragments:', fragments); // DOM fragments to update cart contents
    // console.log('Cart hash:', cart_hash);     // Unique cart hash
    // console.log('Button clicked:', $button);  // The button that triggered the event

    modal("Product added to cart successfully!", `<a href="http://localhost:8080/orto4you/koszyk/" style="margin: auto;" class="added_to_cart wc-forward btn" title="Zobacz koszyk"><span>Zobacz koszyk</a>`);

    // modal("Product added to cart successfully!", fragments['div.widget_shopping_cart_content'] || null);
  });
});

function modal(message, content = null) {
  const wrapper = document.createElement('div');
  wrapper.classList.add('modal__wrapper');
  setTimeout(() => {
    wrapper.classList.add('modal__wrapper--active');
  }, 10);
  wrapper.addEventListener('click', (e) => {
    if (e.target === wrapper) {
      removeModal();
    }
  });

  const modal = document.createElement('div');
  modal.classList.add('modal');
  setTimeout(() => {
    modal.classList.add('modal--active');
  }, 10);

  const modalHeading = document.createElement('h2');
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
    removeModal();
  });
  modal.append(modalClose);

  wrapper.appendChild(modal);

  document.body.appendChild(wrapper);

  const removeModal = () => {
    wrapper.classList.remove('modal--active');
    setTimeout(() => {
      wrapper.classList.remove('modal__wrapper--active');
    }, 300);
    setTimeout(() => {
      document.body.removeChild(wrapper);
    }, 300);
  };
}