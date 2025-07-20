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

    Array.from(realSelect.options).forEach((option) => {
      const item = document.createElement('div');
      item.textContent = option.textContent;
      if (option.value) {
        item.addEventListener('click', () => {
          selected.textContent = option.textContent;
          realSelect.value = option.value;
          setTimeout(() => customSelect.classList.remove('active'), 0); // Zamknij select po wyborze

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
