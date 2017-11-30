export default {
  run() {
    const globe = document.getElementById('home-globe');
    const delay =
      parseInt(getComputedStyle(globe).transitionDuration, 10) * 1000;
    globe.classList.remove('is-zoomed');

    const homeNav = document.getElementById('home-nav');
    setTimeout(() => {
      homeNav.classList.add('fade-in');
    }, delay);
  }
};
