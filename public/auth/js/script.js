//////// Scripts ////////
$(document).ready(function() {
  //Validación para solo presionar enter y borrar
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  // flatpickr
  if ($('#birthday').length) {
    flatpickr(document.getElementById('birthday'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  // Inputmask
  $('#license').inputmask("CM-9999-999");
});