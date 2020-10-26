if (questionNum != 63) {
  let questionOptions = document.querySelectorAll('.radio_ans');

  for (i = 0; i < questionOptions.length; i++) {
    questionOptions[i].addEventListener('click', function () {
      checkAns(questionNum);
    });
  }

  if (checkedOpt > 0) {
    questionOptions[checkedOpt - 1].checked = true;
  }

  // Show previous question on button click
  document.querySelector('#prevBtn').addEventListener('click', function () {
    showInfo(prevNum);
  });

  // Show next question on button click
  document.querySelector('#nextBtn').addEventListener('click', function () {
    showInfo(nextNum);
  });
} else {
  document.querySelector('#finishTestBtn').addEventListener('click', calculateScore);
}
