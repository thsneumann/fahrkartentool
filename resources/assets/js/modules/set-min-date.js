// set date input to minimum value (for Firefox)

const dateInputEls = [...document.querySelectorAll('input[type="date"]')];
dateInputEls.forEach(dateInputEl => {
  dateInputEl.addEventListener('focus', () => {
    if (dateInputEl.type === 'text') return; // stop if browser doesn't support date input fields
    const min = dateInputEl.getAttribute('min');
    if (min === null) return;
    dateInputEl.value = min;
  });
});