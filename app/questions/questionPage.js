// Disable right click on the page
document.addEventListener('contextmenu', (event) => event.preventDefault());

// questionNums stores an array of elements which have class name of questionOverview.
let questionNums = document.querySelectorAll('.questionOverview');

// Iterate over each of the elements having class name of questionOverview
for (i = 0; i < questionNums.length; i++) {
  questionNums[i].addEventListener('click', function () {
    // Display the question
    showInfo(parseInt(this.textContent));
  });
}

// Call calculateScore() once user presses the submit button
document.querySelector('#submitTest').addEventListener('click', function () {
  calculateScore();
});

const showInfo = (qNo) => {
  $.ajax({
    url: 'questionOutput.php?qno=' + qNo + '&checked=' + userAns[qNo - 1],
    success: function (responseText) {
      $('#current-question').html(responseText);
      $('#current-question')
        .find('script')
        .each(function (i) {
          eval($(this).text());
        });
    },
  });
};

// Show the first question when page is first loaded
showInfo(1);
