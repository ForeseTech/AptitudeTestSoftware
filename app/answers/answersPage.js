let answerLinks = document.querySelectorAll('a');
for (i = 0; i < answerLinks.length; i++) {
  answerLinks[i].addEventListener('click', (event) => {
    let linkData = this.textContent;

    event.preventDefault();
    document.title = linkData;

    $.ajax({
      url: 'getAnswerKeys.php?data=' + linkData,
      method: 'GET',
      success: function (response) {
        document.querySelector('body').innerHTML = response;
      },
    });
  });
}
