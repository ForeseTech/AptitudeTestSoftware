// Delete the remaining time from the previous test present in the user's local storage
localStorage.removeItem('savedCountdown');
localStorage.removeItem('status');

dept = document.forms['loginForm']['deptInput'];
section = document.forms['loginForm']['sectionInput'];

deptsWithTwoSections = ['CHE', 'EEE', 'INT', 'MEC'];
deptsWithThreeSections = ['CSE', 'ECE'];

dept.addEventListener('change', function () {
  if (deptsWithThreeSections.includes(this.value)) {
    section.classList.remove('d-none');
    section.options[3].classList.remove('d-none');
    section.required = true;
  } else if (deptsWithTwoSections.includes(this.value)) {
    section.classList.remove('d-none');
    section.options[3].classList.add('d-none');
    section.required = true;
  } else {
    section.classList.add('d-none');
  }
});

jQuery.validator.addMethod('regex', function (value, element) {
  return this.optional(element) || /^18(01|02|03|04|05|06|07|08|09|10)\d{5}$/g.test(value);
});

jQuery.validator.addMethod('svceEmail', function (value, element) {
  return this.optional(element) || /^2018(aut|bio|che|ce|cse|eee|ece|it|mec)\d{4}@svce\.ac\.in$/g.test(value);
});

const mandatoryMessage = 'This field is mandatory.';

$(function () {
  $("form[name = 'loginForm']").validate({
    rules: {
      nameInput: {
        required: true,
      },
      regNum: {
        required: true,
        regex: true,
      },
      deptInput: {
        required: true,
      },
      emailInput: {
        required: true,
        svceEmail: true,
      },
    },
    messages: {
      nameInput: mandatoryMessage,
      regNum: {
        required: mandatoryMessage,
        regex: 'Please enter a valid registration number.',
      },
      deptInput: mandatoryMessage,
      emailInput: {
        required: mandatoryMessage,
        svceEmail: 'Please enter a valid email address.',
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
