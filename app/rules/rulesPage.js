// TODO : See if this can be optimized

if (localStorage.getItem('status') !== null) {
  bootbox.alert('You cannot go back once the test has started.', function () {
    window.location.href = '../questions/';
  });
}

const redirectBtn = document.querySelector('#redirectButton');

['click', 'touchstart'].forEach((evt) => {
  redirectBtn.addEventListener(evt, function () {
    (window.location.href = '../questions/'), false;
  });
});
