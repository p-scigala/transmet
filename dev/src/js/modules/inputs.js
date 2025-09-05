const inputsInit = () => {
  const inputWrappers = document.querySelectorAll('.input-custom-wrapper, .form-row');

  if (inputWrappers.length > 0) {
    inputWrappers.forEach((wrapper) => {
      const field = wrapper.querySelector('input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="hidden"], textarea');
      const label = wrapper.querySelector('label');
      const select = wrapper.querySelector('.select');

      if (field && label) {
        if (field.tagName === 'TEXTAREA') {
          field.setAttribute('placeholder', "");
        }

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
}

export default inputsInit;