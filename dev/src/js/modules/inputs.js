const inputsInit = () => {
  const inputs = document.querySelectorAll('.input-custom-wrapper');

  if (inputs.length > 0) {
    inputs.forEach((input) => {
      const field = input.querySelector('input, textarea');

      field.addEventListener('focus', () => {
        input.classList.add('input--focused');
      });

      field.addEventListener('blur', () => {
        if (!field.value) {
          input.classList.remove('input--focused');
        }
      });
    });
  }
}

export default inputsInit;