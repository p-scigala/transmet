jQuery(document).ready(function ($) {
  $('body').on('click', '.product__add-to-cart a', function (e) {
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

        if (response && !response.error) {
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
        button.removeClass('btn--loader');
        console.log('AJAX error.');
      },
    });
  });
});
