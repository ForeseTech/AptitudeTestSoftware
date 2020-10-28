// TODO : See if this can be optimized

if (localStorage.getItem('status') !== null) {
  bootbox.alert('You cannot go back once the test has started.', () => {
    window.location.href = '../questions/';
  });
}

const redirectBtn = document.querySelector('#redirectButton');

['click', 'touchstart'].forEach((evt) => {
  redirectBtn.addEventListener(evt, () => {
    (window.location.href = '../questions/'), false;
  });
});
