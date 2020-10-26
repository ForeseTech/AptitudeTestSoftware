$(function () {
  $("form[name = 'feedbackForm']").validate({
    rules: {
      commentText: {
        required: true,
      },
    },
    messages: {
      commentText: 'We really would appreciate some constructive feedback about the test.',
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
