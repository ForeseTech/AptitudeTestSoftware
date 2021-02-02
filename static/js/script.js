document.addEventListener('contextmenu', (event) => event.preventDefault());

document.onkeydown = function (e) {
  if (e.altKey || e.ctrlKey || e.shiftKey || e.keyCode === 123) {
    return false;
  }
};
