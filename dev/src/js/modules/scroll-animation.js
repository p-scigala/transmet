const scrollAnimationInit = () => {
  const items = document.querySelectorAll('.animate');

  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1,
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        setVisibility(entry.target)
      }
    });
  }, observerOptions);

  items.forEach((item) => {
    const isInitial = item.classList.contains('animate-initial');
    if (isInitial) {
      setTimeout(() => {
        setVisibility(item);
      }, 1000);
    } else {
      observer.observe(item);
    }

  });

  function setVisibility(item) {
    item.classList.add('visible');

    setTimeout(() => {
      item.classList.remove('visible');
      item.classList.remove('animate');
      item.classList.remove('animate-initial');
      item.classList.remove('delay-1');
      item.classList.remove('delay-2');
      item.classList.remove('delay-3');
      item.classList.remove('delay-4');
      item.classList.remove('delay-5');
      item.classList.remove('delay-6');
      item.classList.remove('delay-7');
      item.classList.remove('delay-8');
      item.classList.remove('delay-9');
      item.classList.remove('delay-10');
      item.classList.remove('delay-11');
      item.classList.remove('delay-12');
      item.classList.remove('delay-13');
      item.classList.remove('delay-14');
      item.classList.remove('delay-15');
      // observer.disconnect();
    }, 2000);
  }
}

export default scrollAnimationInit;
