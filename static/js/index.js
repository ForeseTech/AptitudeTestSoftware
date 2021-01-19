/* Timer JavaScript */
var timerMinute = 59;
var timerSecond = 60;

window.setInterval(changeTimer, 1000);

function changeTimer() {
  timerSecond -= 1;

  if (timerSecond >= 10) {
    if (timerMinute >= 10) {
      document.getElementById('timer').innerHTML = timerMinute + ':' + timerSecond;
    } else {
      document.getElementById('timer').innerHTML = '0' + timerMinute + ':' + timerSecond;
    }
  } else if (timerSecond < 10) {
    if (timerMinute >= 10) {
      document.getElementById('timer').innerHTML = timerMinute + ':0' + timerSecond;
    } else {
      document.getElementById('timer').innerHTML = '0' + timerMinute + ':0' + timerSecond;
    }
  }

  if (timerSecond == 0) {
    if (timerMinute == 0 && timerSecond == 0) {
      document.getElementById('quiz').submit();
    }
    if (timerMinute == 1) {
      document.getElementById('timer').style.color = 'red';
    }
    timerMinute -= 1;
    timerSecond = 60;
  }

  if (timerMinute < 0) {
    document.getElementById('quiz').submit();
  }
}
