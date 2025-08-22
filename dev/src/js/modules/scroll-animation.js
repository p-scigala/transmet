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
        entry.target.classList.add('visible');
        setTimeout(() => {
          entry.target.classList.remove('visible');
          entry.target.classList.remove('animate');
          entry.target.classList.remove('delay-1');
          entry.target.classList.remove('delay-2');
          entry.target.classList.remove('delay-3');
          entry.target.classList.remove('delay-4');
          entry.target.classList.remove('delay-5');
          entry.target.classList.remove('delay-10');
          entry.target.classList.remove('delay-11');
          entry.target.classList.remove('delay-12');
          entry.target.classList.remove('delay-13');
          entry.target.classList.remove('delay-14');
          entry.target.classList.remove('delay-15');
        }, 2000);
      }
    });
  }, observerOptions);

  items.forEach((item) => observer.observe(item));
}

export default scrollAnimationInit;
