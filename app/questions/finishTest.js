// TODO : Change time zone to IST
let numOfQuestions = 50;

// Empty Array for userAns.
let userAns = new Array(numOfQuestions).fill(0);
let correctAns;

fetch('./getAnswers.php')
  .then((res) => res.text())
  .then((response) => {
    correctAns = response.split('').map((item) => parseInt(item));
  });

const calculateScore = () => {
  let i = 0;

  let sec_1 = 0;
  let sec_2 = 0;
  let sec_3 = 0;
  let sec_4 = 0;

  while (i < numOfQuestions) {
    let correctAnswer = correctAns[i];
    let userAnswer = userAns[i];

    if (i < 20 && userAnswer == correctAnswer) {
      sec_1 += 1;
    } else if (i < 30 && userAnswer == correctAnswer) {
      sec_2 += 1;
    } else if (i < 40 && userAnswer == correctAnswer) {
      sec_3 += 1;
    } else if (i < 50 && userAnswer == correctAnswer) {
      sec_4 += 1;
    }
    i += 1;
  }
  window.location.href = '../finish/index?s1=' + sec_1 + '&s2=' + sec_2 + '&s3=' + sec_3 + '&s4=' + sec_4;
};

const checkAns = (qNo) => {
  if (document.querySelector('#opt_a').checked === true) {
    userAns[qNo - 1] = 1;
  } else if (document.querySelector('#opt_b').checked === true) {
    userAns[qNo - 1] = 2;
  } else if (document.querySelector('#opt_c').checked === true) {
    userAns[qNo - 1] = 3;
  } else if (document.querySelector('#opt_d').checked === true) {
    userAns[qNo - 1] = 4;
  }

  if (userAns[qNo - 1] > 0) {
    let xpath = '//div[text()=' + qNo + ']';
    let matchElement = document.evaluate(xpath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null)
      .singleNodeValue;
    matchElement.style.backgroundColor = 'yellow';
  }
};
