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
    if (wrapper) {
      document.body.removeChild(wrapper);
    }
  }, 300);
};