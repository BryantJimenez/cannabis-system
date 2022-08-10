$(document).ready(function(){
	// Login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				birthday: {
					required: true,
					date: false,
					time: false,
					step: false
				},

				license: {
					required: true,
					minlength: 11,
					pattern: '^[A-Z]{2}-[0-9]{4}-[0-9]{3,}$'
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				birthday: {
					required: "Seleccione una fecha."
				},

				license: {
					pattern: "Escribe un formato valido."
				},
				
				email: {
					remote: "Este correo ya esta en uso."
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Recovery Password
	$("button[action='recovery']").on("click",function(){
		$("#formRecovery").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='recovery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reset Password
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Profile
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Users
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				type: {
					required: true
				},

				state: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					remote: "Este correo ya esta en uso."
				},

				type: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='user']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Employees
	$("button[action='employee']").on("click",function(){
		$("#formEmployee").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				birthday: {
					required: true,
					date: false,
					time: false,
					step: false
				},

				license: {
					required: true,
					minlength: 11,
					pattern: '^[A-Z]{2}-[0-9]{4}-[0-9]{3,}$'
				},

				state: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					remote: "Este correo ya esta en uso."
				},

				birthday: {
					required: "Seleccione una fecha."
				},

				license: {
					pattern: "Escribe un formato valido."
				},

				state: {
					required: "Seleccione una opción."
				}
			},
			submitHandler: function(form) {
				$("button[action='employee']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Strains
	$("button[action='strain']").on("click",function(){
		$("#formStrain").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='strain']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Rooms
	$("button[action='room']").on("click",function(){
		$("#formRoom").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='room']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Containers
	$("button[action='container']").on("click",function(){
		$("#formContainer").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 1,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='container']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Harvests
	$("button[action='harvest']").on("click",function(){
		$("#formHarvest").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 4,
					pattern: '^[A-Z][0-9].[0-9]{1,}$'
				}
			},
			messages:
			{
				name: {
					pattern: "Escribe un formato valido."
				}
			},
			submitHandler: function(form) {
				$("button[action='harvest']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Stage Cured
	$("button[action='stage']").on("click",function(){
		if ($("#formStageCured").length) {
			$("#formStageCured").validate().destroy();
		}
		var container=$('#selectContainers option:selected').val();
		$(".duplicate-error").addClass('d-none');
		$("#formStageCured").validate({
			rules:
			{
				strain_id: {
					required: true
				},

				room_id: {
					required: true
				},

				harvest_id: {
					required: true
				},

				container_id: {
					required: true
				},

				'plants[0]': {
					required: true,
					minlength: 2,
					maxlength: 191,
					remote: {
						url: "/plantas/codigo/"+container,
						type: "get"
					}
				},

				'plants[]': {
					required: false,
					minlength: 2,
					maxlength: 191,
					remote: {
						url: "/plantas/codigo/"+container,
						type: "get"
					}
				},

				flower: {
					required: true,
					min: 0
				},

				flower_confirmation: {
					equalTo: "#flower",
					required: true,
					min: 0
				},

				waste: {
					required: true,
					min: 0
				},

				waste_confirmation: {
					equalTo: "#waste",
					required: true,
					min: 0
				},

				notes: {
					required: false,
					minlength: 1,
					maxlength: 1000
				}
			},
			messages:
			{
				strain_id: {
					required: "Seleccione una opción."
				},

				room_id: {
					required: "Seleccione una opción."
				},

				harvest_id: {
					required: "Seleccione una opción."
				},

				container_id: {
					required: "Seleccione una opción."
				},

				'plants[0]': {
					remote: "Esta planta esta duplicada."
				},

				'plants[]': {
					remote: "Esta planta esta duplicada."
				}
			},
			submitHandler: function(form) {
				var duplicate=false;
				$('input[name^="plants"]').each(function(index, el) {
					var current=$(this);
					console.log(current.val());
					$('input[name^="plants"]').each(function() {
						if ($(this).val()!='' && $(this).val()==current.val() && $(this).attr('id')!=current.attr('id')) {
							console.log($(this).val());
							$(".duplicate-error").removeClass('d-none');
							duplicate=true;
						}
					});
				});
				if (duplicate) {
					return false;
				}
				$("button[action='stage']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Stage Trimmed
	$("button[action='stage']").on("click",function(){
		$("#formStageTrimmed").validate({
			rules:
			{
				strain_id: {
					required: true
				},

				room_id: {
					required: true
				},

				harvest_id: {
					required: true
				},

				container_id: {
					required: true
				},

				flower: {
					required: true,
					min: 0
				},

				flower_confirmation: {
					equalTo: "#flower",
					required: true,
					min: 0
				},

				larf: {
					required: true,
					min: 0
				},

				larf_confirmation: {
					equalTo: "#larf",
					required: true,
					min: 0
				},

				trim: {
					required: true,
					min: 0
				},

				trim_confirmation: {
					equalTo: "#trim",
					required: true,
					min: 0
				},

				waste: {
					required: true,
					min: 0
				},

				waste_confirmation: {
					equalTo: "#waste",
					required: true,
					min: 0
				},

				notes: {
					required: false,
					minlength: 1,
					maxlength: 1000
				}
			},
			messages:
			{
				strain_id: {
					required: "Seleccione una opción."
				},

				room_id: {
					required: "Seleccione una opción."
				},

				harvest_id: {
					required: "Seleccione una opción."
				},

				container_id: {
					required: "Seleccione una opción."
				}
			},
			submitHandler: function(form) {
				$("button[action='stage']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Settings
	$("button[action='setting']").on("click",function(){
		$("#formSetting").validate({
			rules:
			{
				qty_plants: {
					required: true,
					min: 1,
					max: 6
				}
			},
			submitHandler: function(form) {
				$("button[action='setting']").attr('disabled', true);
				form.submit();
			}
		});
	});
});