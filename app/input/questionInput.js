const mandatoryMessage = 'This field is mandatory.';

$(function () {
  $("form[name='questionInputForm']").validate({
    rules: {
      questionInput: {
        required: true,
      },
      topicInput: {
        required: true,
      },
      optA: {
        required: true,
      },
      optB: {
        required: true,
      },
      optC: {
        required: true,
      },
      optD: {
        required: true,
      },
      correctOpt: {
        required: true,
      },
    },
    messages: {
      questionInput: mandatoryMessage,
      topicInput: mandatoryMessage,
      optA: mandatoryMessage,
      optB: mandatoryMessage,
      optC: mandatoryMessage,
      optD: mandatoryMessage,
      correctOpt: mandatoryMessage,
    },
    submitHandler: function () {
      submitForm();
    },
  });
});

function submitForm() {
  let formData = $('[name=questionInputForm]').serialize();
  $.ajax({
    type: 'POST',
    url: 'questionInput.php',
    data: formData,
    success: function () {
      bootbox.alert('Question submitted successfully.', function () {
        window.location.href = '../input/';
      });
    },
  });
}
