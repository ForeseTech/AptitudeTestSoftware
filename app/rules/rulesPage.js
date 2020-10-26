// TODO : See if this can be optimized

if (localStorage.getItem('status') !== null) {
  bootbox.alert('You cannot go back once the test has started.', function () {
    window.location.href = '../questions/';
  });
}

document.querySelector('#redirectButton').addEventListener('click', function () {
  window.location.href = '../questions/';
});

document.querySelector('#redirectButton').addEventListener('touchstart', function () {
  window.location.href = '../questions/';
});
