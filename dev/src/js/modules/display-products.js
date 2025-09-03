const displayProductsInit = () => {
  const btnsContainer = document.querySelectorAll('.products__display');
  const productsList = document.querySelector('.products__list');
  if (btnsContainer.length && productsList)
    productsList.classList.add(`products__list--${productsDisplay}`);

  btnsContainer.forEach(container => {
    const buttons = container.querySelectorAll('.products__display-button');

    buttons.forEach(button => {
      button.classList.remove('products__display-button--active');
      if (button.dataset.display === productsDisplay) {
        button.classList.add('products__display-button--active');
      }

      button.addEventListener('click', () => {
        buttons.forEach(btn => btn.classList.remove('products__display-button--active'));
        button.classList.add('products__display-button--active');
        productsList.classList = 'products__list'; // Reset classes
        productsList.classList.add(`products__list--${button.dataset.display}`);
        localStorage.setItem("products_display", button.dataset.display);
      });
    });
  });

  /* move info panels on product page for mobile */
  const infoPanel = document.querySelector('.single-product__info-panel-wrapper');
  const summary = document.querySelector('.single-product__summary');

  if (infoPanel && summary) {
    if (vw <= 1280) {
      summary.after(infoPanel);
    }
  }

}

export default displayProductsInit;
