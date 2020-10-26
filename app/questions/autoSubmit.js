// Set the date and time we're counting down to (Auto Submit)
// This will auto-submit the test at the mentioned time regardless of the time the user started

let endTime = new Date('Sep 15, 2020 22:00:30').getTime();

// Update the count down every 1 second
const x = setInterval(() => {
  // Get current date and time
  let currentTime = new Date().getTime();

  // Find the time remaining between now and the end time
  let timeRemaining = endTime - currentTime;

  // Time calculations for minutes and seconds
  let timerMinute = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
  let timerSecond = Math.floor((timeRemaining % (1000 * 60)) / 1000);
  // Select the DOM element where you wish to place the timer
  let timer = document.querySelector('#timer');

  if (timerSecond >= 10) {
    if (timerMinute >= 10) {
      timer.innerHTML = timerMinute + ':' + timerSecond;
    } else {
      timer.innerHTML = '0' + timerMinute + ':' + timerSecond;
    }
  } else if (timerSecond < 10) {
    if (timerMinute >= 10) {
      timer.innerHTML = timerMinute + ':0' + timerSecond;
    } else {
      timer.innerHTML = '0' + timerMinute + ':0' + timerSecond;
    }
  }

  if (timerSecond == 0) {
    if (timerMinute == 0 && timerSecond == 0) {
      alert("Your time is up. Click 'OK' to see your scores!");
      calculateScore();
    }
    if (timerMinute == 1) {
      timer.style.color = 'red';
    }
  }

  if (timerMinute < 0) {
    calculateScore();
  }

  if (timeRemaining < 0) {
    clearInterval(x);
  }
}, 1000);
