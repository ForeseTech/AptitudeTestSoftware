// Do not allow user to view rules once the test has started
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
