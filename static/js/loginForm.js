dept = document.forms['loginForm']['deptIn'];
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
    section.value = '';
    section.required = false;
  }
});
