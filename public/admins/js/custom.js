/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
    */

    function multiCheck(tb_var) {
      tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
          a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
      }),
      tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
      })
    }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
function errorNotification() {
  Lobibox.notify('error', {
    title: 'Error',
    sound: true,
    msg: 'Ha ocurrido un problema, int??ntelo de nuevo.'
  });
}

$(document).ready(function() {
  //Validaci??n para introducir solo n??meros
  $('.number, #phone').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
  });
  //Validaci??n para introducir solo letras y espacios
  $('#name, #lastname, .only-letters').keypress(function() {
    return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
  });
  //Validaci??n para solo presionar enter y borrar
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  //select2
  if ($('.select2').length) {
    $('.select2').select2({
      language: "es",
      placeholder: "Seleccione",
      tags: true
    });
  }

  //Datatables normal
  if ($('.table-normal').length) {
    $('.table-normal').DataTable({
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ning??n resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  if ($('.table-export').length) {
    $('.table-export').DataTable({
      dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
      buttons: {
        buttons: [
        { extend: 'copy', className: 'btn' },
        { extend: 'csv', className: 'btn' },
        { extend: 'excel', className: 'btn' },
        { extend: 'print', className: 'btn' }
        ]
      },
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ning??n resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "print": "Imprimir"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  // dropify para input file m??s personalizado
  if ($('.dropify').length) {
    $('.dropify').dropify({
      messages: {
        default: 'Arrastre y suelte una imagen o da click para seleccionarla',
        replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
        remove: 'Remover',
        error: 'Lo sentimos, el archivo es demasiado grande'
      },
      error: {
        'fileSize': 'El tama??o del archivo es demasiado grande ({{ value }} m??ximo).',
        'minWidth': 'El ancho de la imagen es demasiado peque??o ({{ value }}}px m??nimo).',
        'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px m??ximo).',
        'minHeight': 'La altura de la imagen es demasiado peque??a ({{ value }}}px m??nimo).',
        'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px m??ximo).',
        'imageFormat': 'El formato de imagen no est?? permitido (Debe ser {{ value }}).'
      }
    });
  }

  // datepicker material
  if ($('.dateMaterial').length) {
    $('.dateMaterial').bootstrapMaterialDatePicker({
      lang : 'es',
      time: false,
      cancelText: 'Cancelar',
      clearText: 'Limpiar',
      format: 'DD-MM-YYYY',
      maxDate : new Date()
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  if ($('#startDateSearchFlatpickr').length && $('#endDateSearchFlatpickr').length) {
    var startFlatpickr=flatpickr(document.getElementById('startDateSearchFlatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      time_24hr: false,
      onChange: function(selectedDates, dateStr, instance) {
        endFlatpickr.set("minDate", $("#startDateSearchFlatpickr").val());
      }
    });

    var endFlatpickr=flatpickr(document.getElementById('endDateSearchFlatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      time_24hr: false,
      onChange: function(selectedDates, dateStr, instance) {
        startFlatpickr.set("maxDate", $("#endDateSearchFlatpickr").val());
      }
    });
  }

  // Inputmask
  if ($('#maskLicense').length) {
    $('#maskLicense').inputmask("CM-9999-999");
  }

  if ($('#maskHarvest').length) {
    $('#maskHarvest').inputmask("H9{1,2}.9");
  }

  // touchspin
  if ($('.min-decimal-grams').length) {
    $(".min-decimal-grams").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.01,
      decimals: 2,
      postfix: 'g',
      buttondown_class: 'btn btn-primary rounded-0 h-100 mr-0',
      buttonup_class: 'btn btn-primary rounded-0 h-100 mr-0',
      postfix_extraclass: "d-flex align-items-center bg-light-gray px-2"
    });
  }

  if ($('.qty-plants').length) {
    $(".qty-plants").TouchSpin({
      min: 1,
      max: 100,
      buttondown_class: 'btn btn-primary rounded-0 h-100 mr-0',
      buttonup_class: 'btn btn-primary rounded-0 h-100 mr-0'
    });
  }
});

// funcion para cambiar el input hidden al cambiar el switch de estado
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

//funciones para desactivar y activar
function deactiveUser(slug) {
  $("#deactiveUser").modal();
  $('#formDeactiveUser').attr('action', '/admin/usuarios/' + slug + '/desactivar');
}

function activeUser(slug) {
  $("#activeUser").modal();
  $('#formActiveUser').attr('action', '/admin/usuarios/' + slug + '/activar');
}

function deactiveEmployee(slug) {
  $("#deactiveEmployee").modal();
  $('#formDeactiveEmployee').attr('action', '/admin/trabajadores/' + slug + '/desactivar');
}

function activeEmployee(slug) {
  $("#activeEmployee").modal();
  $('#formActiveEmployee').attr('action', '/admin/trabajadores/' + slug + '/activar');
}

function deactiveStrain(slug) {
  $("#deactiveStrain").modal();
  $('#formDeactiveStrain').attr('action', '/admin/cepas/' + slug + '/desactivar');
}

function activeStrain(slug) {
  $("#activeStrain").modal();
  $('#formActiveStrain').attr('action', '/admin/cepas/' + slug + '/activar');
}

function deactiveRoom(slug) {
  $("#deactiveRoom").modal();
  $('#formDeactiveRoom').attr('action', '/admin/cuartos/' + slug + '/desactivar');
}

function activeRoom(slug) {
  $("#activeRoom").modal();
  $('#formActiveRoom').attr('action', '/admin/cuartos/' + slug + '/activar');
}

function deactiveContainer(slug) {
  $("#deactiveContainer").modal();
  $('#formDeactiveContainer').attr('action', '/admin/compartimentos/' + slug + '/desactivar');
}

function activeContainer(slug) {
  $("#activeContainer").modal();
  $('#formActiveContainer').attr('action', '/admin/compartimentos/' + slug + '/activar');
}

function deactiveHarvest(slug) {
  $("#deactiveHarvest").modal();
  $('#formDeactiveHarvest').attr('action', '/admin/cosechas/' + slug + '/desactivar');
}

function activeHarvest(slug) {
  $("#activeHarvest").modal();
  $('#formActiveHarvest').attr('action', '/admin/cosechas/' + slug + '/activar');
}

function emptyContainer(id) {
  $("#emptyContainer").modal();
  $('#formEmptyContainer').attr('action', '/admin/etapas/trimmiado/' + id + '/vaciar');
}

//funciones para preguntar al eliminar
function deleteUser(slug) {
  $("#deleteUser").modal();
  $('#formDeleteUser').attr('action', '/admin/usuarios/' + slug);
}

function deleteEmployee(slug) {
  $("#deleteEmployee").modal();
  $('#formDeleteEmployee').attr('action', '/admin/trabajadores/' + slug);
}

function deleteStrain(slug) {
  $("#deleteStrain").modal();
  $('#formDeleteStrain').attr('action', '/admin/cepas/' + slug);
}

function deleteRoom(slug) {
  $("#deleteRoom").modal();
  $('#formDeleteRoom').attr('action', '/admin/cuartos/' + slug);
}

function deleteContainer(slug) {
  $("#deleteContainer").modal();
  $('#formDeleteContainer').attr('action', '/admin/compartimentos/' + slug);
}

function deleteHarvest(slug) {
  $("#deleteHarvest").modal();
  $('#formDeleteHarvest').attr('action', '/admin/cosechas/' + slug);
}

function deleteStageCured(id) {
  $("#deleteStageCured").modal();
  $('#formDeleteStageCured').attr('action', '/admin/etapas/curado/' + id);
}

function deleteStageTrimmed(id) {
  $("#deleteStageTrimmed").modal();
  $('#formDeleteStageTrimmed').attr('action', '/admin/etapas/trimmiado/' + id);
}

function deleteLog(id) {
  $("#deleteLog").modal();
  $('#formDeleteLog').attr('action', '/admin/bitacora/' + id);
}

// Button search clear
$('#btnSearchClear').click(function(event) {
  $('.form input, .form select').val('');
  $('.selectpicker').selectpicker('refresh');
});

// Agregar compartimentos en select
$('#selectStrains, #selectRooms, #selectHarvests').change(function() {
  var strain=$('#selectStrains option:selected').val(), room=$('#selectRooms option:selected').val(), harvest=$('#selectHarvests option:selected').val();
  $('#selectContainers option').remove();
  $('#selectContainers').append($('<option>', {
    value: '',
    text: 'Seleccione'
  }));
  if (strain!="" && room!="" && harvest!="") {
    $.ajax({
      url: '/compartimentos/curados',
      type: 'POST',
      dataType: 'json',
      data: {strain: strain, room: room, harvest: harvest},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      if (obj.state) {
        $('#selectContainers option[value!=""]').remove();
        for (var i=obj.data.length-1; i>=0; i--) {
          $('#selectContainers').append($('<option>', {
            value: obj.data[i].slug,
            text: obj.data[i].name+' (Uso: '+obj.data[i].use+'/'+obj.setting.qty_plants+')'
          }));
        }
      } else {
        errorNotification();
      }
    })
    .fail(function() {
      errorNotification();
    });
  }
});

// Obtener datos de un recipiente
$('#selectContainers').change(function() {
  $('#divPlants div').remove();
  $('.plants_error').addClass('d-none');
  var container=$('#selectContainers option:selected').val(), use=parseInt($('#selectContainers option:selected').attr('use'));
  if (container!="") {
    $.ajax({
      url: '/compartimentos/curados',
      type: 'GET',
      dataType: 'json',
      data: {container: container}
    })
    .done(function(obj) {
      if (obj.state) {
        $('#divPlants div').remove();

        for (var i=0; i<=obj.setting.qty_plants-obj.count_plants-1; i++) {
          if (i==0) {
            $('#divPlants').append($('<div>', {
              class: "form-group col-lg-6 col-md-6 col-12"
            }).append($('<label>', {
              class: "col-form-label",
              text: "Planta "+(i+1)
            }).append($('<b>', {
              class: "text-danger",
              text: "*"
            }))).append($('<input>', {
              class: "form-control",
              type: "text",
              name: "plants["+i+"]",
              required: "required",
              placeholder: "Introduzca el c??digo de la planta",
              id: "plants_"+i
            })));
          } else {
            $('#divPlants').append($('<div>', {
              class: "form-group col-lg-6 col-md-6 col-12"
            }).append($('<label>', {
              class: "col-form-label",
              text: "Planta "+(i+1)+" (Opcional)"
            })).append($('<input>', {
              class: "form-control",
              type: "text",
              name: "plants["+i+"]",
              placeholder: "Introduzca el c??digo de la planta",
              id: "plants_"+i
            })));
          }
        }
      } else {
        errorNotification();
      }
    })
    .fail(function() {
      errorNotification();
    });
  }
});