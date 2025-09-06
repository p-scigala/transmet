const inputsInit = () => {
  const inputWrappers = document.querySelectorAll('.input-custom-wrapper, .form-row');

  if (inputWrappers.length > 0) {
    inputWrappers.forEach((wrapper) => {
      const field = wrapper.querySelector('input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="hidden"], textarea');
      const label = wrapper.querySelector('label');
      const select = wrapper.querySelector('.select');

      if (field && label) {
        field.setAttribute('placeholder', "");

        if (field.value) {
          wrapper.classList.add('input--focused');
        }

        field.addEventListener('focus', () => {
          wrapper.classList.add('input--focused');
        });

        field.addEventListener('blur', () => {
          if (!field.value) {
            wrapper.classList.remove('input--focused');
          }
        });
      }

      if (select && label) {
        wrapper.classList.add('input--focused');
      }
    });
  }

  /* fixes for product quantity */

  const productsPanels = document.querySelectorAll('li.product');

  if (productsPanels.length) {
    productsPanels.forEach((product) => {
      const quantityInput = product.querySelector('.input--quantity[type="number"]');
      const bottomBar = product.querySelector('.product__bottom');
      const cartButton = product.querySelector('.btn--add');
      const minusButton = quantityInput.previousElementSibling;
      const plusButton = quantityInput.nextElementSibling;

      minusButton.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value, 10);
        if (currentValue > 1) {
          quantityInput.value = currentValue - 1;
        }
        cartButton.setAttribute('data-quantity', quantityInput.value);
      });

      plusButton.addEventListener('click', function () {
        let currentValue = parseInt(quantityInput.value, 10);
        quantityInput.value = currentValue + 1;
        cartButton.setAttribute('data-quantity', quantityInput.value);
      });

      quantityInput.addEventListener('change', function () {
        cartButton.setAttribute('data-quantity', quantityInput.value);
      });

      quantityInput.addEventListener('focusout', function () {
        cartButton.setAttribute('data-quantity', quantityInput.value);
      });

      // cartButton.addEventListener('click', function () {
      //   setTimeout(() => {
      //     bottomBar.classList.add('product__bottom--disabled');
      //   }, 50);
      // });
    });
  }
}

export default inputsInit;